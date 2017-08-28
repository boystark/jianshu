<?php

namespace App\Http\Controllers\IndexCtr;

use App\Zan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticleCtr extends Controller
{
    //列表页面
    public function index(){

        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        return view('IndexView/Post/index',compact('posts'));
    }
    //文章详情页面
    public function show(Post $post){

        //预加载，在view中不会再去查找
        $post->load('comments');

        return view('IndexView/Post/show',compact('post'));
    }
    //文章添加
    public function add(){
        return view('IndexView/Post/add');
    }
    public function store(){
//        $post = new Post();
//        $post->title = \request('title');
//        $post->content = \request('content');
//        $post->save();
        //验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:20',
        ],[
            'title.min'=>'文章标题太短了',
        ]);
        //逻辑
        $user_id = \Auth::id();
        $params = array_merge(\request(['title','content']),compact('user_id'));

        Post::create($params);
        //渲染
        return redirect("/posts");
    }
    //文章编辑
    public function edit(Post $post){
        return view('IndexView/Post/edit',compact('post'));
    }
    public function update(Post $post){
       //验证
        $this->validate(request(),[
            'title'=>'required|string|max:100|min:5',
            'content'=>'required|string|min:20',
        ]);
        //权限
        $this->authorize('update',$post);
        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        //渲染
        return redirect("/posts/{$post->id}");
    }
    //文章删除
    public function del(Post $post){

        $this->authorize('delete',$post);
        $post->delete();
        return redirect('/posts');
    }

    //图片上传
    public function imageUpload(){
        //图片上传
        $request = request();
        $path = $request->file('kangEditorFile')->storePublicly(md5(time()));

        $str = ['url'=>  'http://'.$_SERVER['SERVER_NAME'].'/storage/'.$path];
        return json_encode($str);
    }

    //评论提交
    public function comment(Post $post){
        //验证
        $this->validate(request(),[
            'content'=>'required|min:10'
        ]);
        //逻辑
        $comment = new \App\Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = request('post_id');;
        $comment->content = \request('content');
        $post->comments()->save($comment);
        //渲染
        return back();
    }

    //是否赞
    public function zan(Post $post){
            $param = [
                'user_id'=> \Auth::id(),
                'post_id'=> $post->id,
            ];
            Zan::firstOrCreate($param);
            return back();
    }

    //取消赞
    public function unzan(Post $post){
            $post->zan(\Auth::id())->delete();
            return back();
    }

    //搜索页面
    public function search(){
        //验证
        $this->validate(request(),[
            'query'=>'required'
        ]);

        //逻辑
        $query = \request('query');
        $posts = \App\Post::search($query)->paginate(2);

        //渲染
        return view('IndexView/Post/search',compact('posts','query'));
    }

}
