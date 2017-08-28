<?php

namespace App;

use App\BaseModel;

use Laravel\Scout\Searchable;
use PhpParser\Builder;

//默认=>posts
class Post extends BaseModel
{
    use Searchable;

    public function searchableAs()
    {
        return "post";
    }
    public function toSearchableArray()
    {
        return[
          'title'=>$this->title,
            'content'=>$this->content,
        ];
    }


    //关联用户
    public function user(){
        //一对一hasOne
        //一对多hasMany
        //一对多反向belongsTo
        //多对对belongsToMany
        //远程一对多hasManyThrough
        //多态关联morphMany
        //多台多对多 morphToMany

        return $this->belongsTo('App\User','user_id','id');
    }

    //评论模型
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    //和用户关联
    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    //文章的所有赞
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }


    //属于某个作者的文章
    public function scopeAuthorBy(Builder $query,$user_id){
        return $query->where('user_id',$user_id);
    }

    //
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class,'post_id','id');
    }

    //不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query,$topic_id){
            return $query->doesntHave('postTopics','and',function ($q) use($topic_id){
                $q->where('topic_id',$topic_id);
            });
    }

}
