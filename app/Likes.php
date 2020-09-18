<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
 public function likes(){
    return $this->belongsTo('App\Comment');
 }
}
