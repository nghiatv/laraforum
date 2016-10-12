<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['from_user','on_post','body'];

    public function post(){
        return $this->belongsTo('App\Post','on_post');
    }
    public function user(){
        return $this->belongsTo('App\User','from_user');
    }
}
