<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = [
        'user_id',
        'post_title',
        'post',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User','user_id');
    }
    //likeモデルとのリレーション
    public function likes(){
    return $this->hasMany(Like::class, 'like_post_id');
}
    public function postComments(){
        return $this->hasMany('App\Models\Posts\PostComment', 'post_id');
    }
    //コメント数のカウント
    public function commentCounts($post_id){
    return Post::with('postComments')->find($post_id)->postComments;
}

//サブカテゴリーとのリレーション
    public function subCategories(){
        // リレーションの定義（多対多）
        return $this->belongsToMany('App\Models\Categories\SubCategory', 'post_sub_categories', 'post_id', 'sub_category_id');
    }
}
