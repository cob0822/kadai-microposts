<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',"profile",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts(){
        return $this->hasMany(Micropost::class);
    }
    
    public function followings(){
        return $this->belongsToMany(User::class, "user_follow", "user_id", "follow_id")->withTimestamps();
    }
    
    public function followers(){
        return $this->belongsToMany(User::class, "user_follow", "follow_id", "user_id")->withTimestamps();
    }
    
    public function follow($userId){
        $exist = $this->is_following($userId);
        
        $its_me = $this->id == $userId;
        if($exist || $its_me){
            return false;
        }else{
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId){
        $exist = $this->is_following($userId);
        
        $its_me = $this->id == $userId;
        
        if($exist && !$its_me){
            $this->followings()->detach($userId);
            return true;
        }else{
            return false;
        }
    }
    
    public function is_following($userId){
        return $this->followings()->where("follow_id", $userId)->exists();
    }
    
    //タイムライン用のマイクロポスト（= フォローしているユーザーのマイクロポスト一覧）を取得 
    public function feed_microposts(){
        $follow_user_ids = $this->followings()->pluck("users.id")->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn("user_id", $follow_user_ids);
    }
    
    public function favoritesPosts(){
        return $this->belongsToMany(Micropost::class, "favorites", "user_id", "favorite_post_id")->withTimestamps();
    }
    
    public function favorites($postId){
        //既にお気に入りしているかの確認
        $exist = $this->is_favorite($postId);
        
        if($exist){
            return false;
        }else{
            $this->favoritesPosts()->attach($postId);
            return true;
        }
        
        //自分のつぶやきでないか確認 今回の仕様では不要
        /*
        $its_mine = false;
        $my_posts[] = $this->microposts()->id;
        
        foreach($my_posts as $myPost){
            if($postId == $myPost){
                $its_mine = true;
            }
        }
        
        if($exist || $its_mine){
            return false;
        }else{
            $this->favoritesPosts()->attach($postId);
            return true;
        }
        */
    }
    
    public function unfavorites($postId){
        //既にお気に入りしているかの確認
        $exist = $this->is_favorite($postId);
        
        if($exist){
            $this->favoritesPosts()->detach($postId);
            return true;
        }else{
            return false;
        }
        
        //自分のつぶやきでないか確認 今回の仕様では不要
        /*
        $its_mine = false;
        $my_posts[] = $this->microposts()->id;
        
        foreach($my_posts as $myPost){
            if($postId == $myPost){
                $its_mine = true;
            }
        }
        
        if($exist && !$its_mine){
            $this->favoritesPosts()->detach($postId);
            return true;
        }else{
            return false;
        }
        */
    }
    
    public function is_favorite($postId){
        return $this->favoritesPosts()->where("favorite_post_id", $postId)->exists();
    }
}
