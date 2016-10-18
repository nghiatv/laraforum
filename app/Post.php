<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = ['author_id','title','slug','body','active','category_id'];

    public function user(){
        return $this->belongsTo('App\User','author_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Comment','on_post');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
