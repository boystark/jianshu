<?php
/**
 * Created by PhpStorm.
 * User: kang
 * Date: 2017/8/25
 * Time: 21:13
 */

namespace App\Http\Controllers\IndexCtr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginCtr extends Controller
{
    public function index(){
        $posts = \App\Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        $topics = \App\Topic::all();
        return view('IndexView/nologin/index',compact('posts','topics'));
    }
    public function show(\App\Post $post){
        $post->load('comments');
        $topics = \App\Topic::all();
        return view('IndexView/nologin/show',compact('post','topics'));
    }

    public function log(){
        return view('IndexView/login/login');
    }
    public function login(){
        //验证
        $this->validate(\request(),[
            'email'=>'required|email',
            'password'=>'required|min:6|max:12',
            'is_remember'=>'integer'
        ]);
        //逻辑
        $user = \request(['email','password']);
        $is_remember = boolval(\request('is_remember'));
        if(Auth::attempt($user,$is_remember)){
            return redirect('/posts');
        }

//        return redirect()->back()->withErrors('邮箱密码不匹配！');
        return \Redirect::back()->withErrors('邮箱密码不匹配！');
    }
    public function logout(){
        \Auth::logout();
        return redirect('/login');
    }

}