<?php

namespace App;

use App\BaseModel;;

class Comment extends BaseModel
{
    //评论所属文章
    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }

    //评论所属用户
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

}
