<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    //
    public function myMemo($user_id){
       $tag = \Request::query('tag');
       if(empty($tag)){
           return $this::select('memos.*')->where('user_id', $user_id)->where('status', 1)->get();
       }else{
           $memos = $this::select('memos.*')
                ->leftJoin('tags', 'tags.id', '=', 'memos.tag_id')
                ->where('tags.name', $tag)
                ->where('tags.user_id', $user_id)
                ->where('memos.user_id', $user_id)
                ->where('status', 1)
                ->get();
            return $memos;
       }
    }
}
