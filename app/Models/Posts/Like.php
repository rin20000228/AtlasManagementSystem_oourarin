<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    const UPDATED_AT = null;

    protected $fillable = [
        'like_user_id',
        'like_post_id'
    ];

    public function posts(){
    return $this->belongsTo(Post::class);
  }

  public function users(){
    return $this->belongsTo(User::class);
  }

//いいね数のカウント
    public function likeCounts($post_id){
        return $this->where('like_post_id', $post_id)->get()->count();
    }
}
