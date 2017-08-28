<?php
/**
 * Created by PhpStorm.
 * User: kang
 * Date: 2017/8/25
 * Time: 21:12
 */
namespace App\Http\Controllers\IndexCtr;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Topic;

class TopicCtr extends Controller
{
   public function show(Topic $topic){
        //带文章数的专题
       $topic = Topic::withCount('postTopics')->find($topic->id);

       //专题的文章列表，按照创建时间倒序排列，前10
       $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
        //属于我的文章 但是没有投稿
      // $myposts = \App\Post::AuthorBy(\Auth::id())->TopicNotBy($topic->id)->get();
       // return view('IndexView/topic/show',compact('topic','posts','myposts'));
       return view('IndexView/topic/show',compact('topic','posts'));
   }
   public function submit(Topic $topic){


   }
}