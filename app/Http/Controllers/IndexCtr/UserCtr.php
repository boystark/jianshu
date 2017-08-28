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
Use App\User;

class UserCtr extends Controller
{
    //个人中心
    public function index(User $user){
        //这个人的信息 关注/粉丝/文章数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);
        //文章（前十条）
        $posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();
        //关注人的信息，包含关注对象的    /关注/粉丝/文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

        //这个人的粉丝用户,包含粉丝用户的  关注/粉丝/文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('IndexView/user/user',compact('user','posts','susers','fusers'));
    }
    //个人设置页面
    public function setting(){
        return view('IndexView/user/setting');
    }
    public function settingStore(){
        echo '个人设置页面保存';
    }
    //关注用户
    public function fan(User $user){
        $me = \Auth::user();
        $me->doFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }
    //取消关注
    public function unfan(User $user){
        $me = \Auth::user();
        $me->doUnFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }

}