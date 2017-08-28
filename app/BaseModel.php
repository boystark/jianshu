<?php
/**
 * Created by PhpStorm.
 * User: kang
 * Date: 2017/8/25
 * Time: 2:22
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

//默认=>posts
class BaseModel extends Model
{
    protected $guarded;//不可以注入的字段
    protected $fillable = ['title','content','user_id','post_id','name'];//可以注入的数组
}