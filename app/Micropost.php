<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ["content", "user_id"];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function favorites_users(){
        return $this->belongsToMany(User::class, "favorites", "favorite_post_id", "user_id");
    }
}
