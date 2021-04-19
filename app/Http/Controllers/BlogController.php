<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Session;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $searchterm = $request['search'];
        $codedsearchterm = htmlentities($searchterm);
        $requestcid = $request->cid;
        if(!$searchterm) {
            if (isset($requestcid) && $request->cid != "allcat") {
                $articles = Article::where('published', 'yes')->where('category_id',
                    $request->cid)->orderByDesc('updated_at')->paginate(5);
            } else {
                $articles = Article::where('published', 'yes')->orderByDesc('updated_at')->paginate(5);
            }
        }
        else {
            $articles = Article::
            where('body', 'LIKE', '%'.$codedsearchterm.'%')
                ->orWhere('heading', 'LIKE', '%'.$searchterm.'%')
                ->orderByDesc('updated_at')->paginate(5);
        }

        $categories = Category::all();
        $categories->each(function($category, $articles){
            $numcat = Article::where('category_id',$category->id)->where('published', 'yes')->count();
            $category['numcat'] = $numcat;
        });
        //$comments = Comment::where('published', 'yes');
        $articles->each(function($article, $key) {
            $category = Category::where('id',$article->category_id)->first();
            $article['catname'] = $category['name'];
            $comments = Comment::where('published','yes')->where('article_id',$article->id)->get();
            $article['comments']  = $comments;
        });
        $allart = Article::where('published','yes')->count();
        $thanks = Session::get('thanks');

        if(!auth()->user()) {
            $visitingnumber = file_get_contents("../counter.txt");
            $visitingnumber = (int)$visitingnumber + 1;
            file_put_contents("../counter.txt", $visitingnumber);
        }
        return view('blog')->with('articles',$articles)->with('categories', $categories)->with('requestcid',$requestcid)->with('allart', $allart)->with('searchterm', $searchterm)->with('thanks', $thanks);
    }
}
