<?php

namespace App\Htto\Traits;

use App\Tag;
use DB;
use Illuminate\Http\Request;


trait DeleteTagTrait {

    public function deleteUnusedTags() {

        $userid = auth()->user()['id'];
        $tags = Tag::all()->where('user_id',$userid);
        $tags->each(function($item, $key) {
            $query = DB::table('memory_tag')->where('tag_id', $item['id'])->exists();;
            if(!$query){
                $item->delete();
            }
        });
    }

}
