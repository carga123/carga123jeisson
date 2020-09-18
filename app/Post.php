<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable =['title','content','url_img','id_user'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Likes');
    }



}
