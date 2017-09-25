<?php
/**
 * Created by PhpStorm.
 * User: kang
 * Date: 2017/9/25
 * Time: 11:33
 */

namespace App\Http\Controllers\IndexCtr;


class NoticeCtr
{
    public function index(){
        return view('IndexView/notice/notices',compact('posts'));
    }
}