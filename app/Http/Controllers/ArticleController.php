<?php

namespace App\Http\Controllers;

use App\Models\Memory;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class
ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderByDesc('updated_at')->paginate(6);
        $blogtag = "bloggidéer";
        $blogideas = Memory::where(function ($q) use ($blogtag) {
            $q->whereHas('tags', function ($query) use ($blogtag) {
                $query->where('name', 'LIKE', '%'.$blogtag.'%');
            });
        })->orderByDesc('updated_at')->limit(2)->get();

        return view('articles.list')->with('articles',$articles)->with('blogideas',$blogideas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all()->sortBy('name');

        return view('articles.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = request()->validate([

            'heading' => 'required | min:3',
            'body' => 'required | min:5',
            'published' => 'required',
            'category_id' => 'required'
        ]);

        Article::create($attributes);

        if($request['published'] == "yes") {
            return redirect('blog');
        }
        else{
            return redirect('articles');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        if(!auth()->user()) {
            $visitingnumber = file_get_contents("../counter.txt");
            $visitingnumber = (int)$visitingnumber + 1;
            file_put_contents("../counter.txt", $visitingnumber);
        }

        return view('articles.show')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all()->sortBy('name');

        return view('articles.edit')->with('article',$article)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if($request['delete'] === 'delete') {
            $this->destroy($article);
            return redirect('/articles');
        }

        $attributes = request()->validate([
            'heading' => 'required | min:3',
            'body' => 'required | min:5',
            'published' => 'required',
            'category_id' => 'required'
        ]);

        $article->update(request(['heading','body','published','category_id',]));

        if($request['published'] == "yes") {
            return redirect('blog');
        }
        else{
            return redirect('articles');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
    }
}
