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
use App\User;

class RegisterCtr extends Controller
{
    public function index(){
       return view('IndexView/register/register');
    }
    public function register(){
        //验证
        $this->validate(\request(),[
            'name'=>'required|min:3|unique:users,name',
            'email'=>'required|unique:users,email|email',
            'password'=>'required|min:6|max:12|confirmed'
        ]);
        //逻辑
        $name = \request('name');
        $email = \request('email');
        $password = bcrypt(\request('password'));
        $user = User::create(compact('name','email','password'));


        //渲染
        return redirect('/login');
    }
}