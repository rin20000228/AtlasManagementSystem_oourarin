<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Http\Requests\SubCategoryRequest;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;
use App\Http\Requests\BulletinBoard\PostEditRequest;
use App\Http\Requests\BulletinBoard\PostFormRequest;
use App\Http\Requests\CommentRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        //モデルのクラス名を指定して投稿と一緒にテーブルの情報を取得する
        $posts = Post::with('user', 'postComments', 'subCategories')->get();
        //dd($posts);
        $categories = MainCategory::with('subCategories')->get();
        //dd($categories);
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
        }else if($request->category_word){
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')->get();
        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        $main_categories = MainCategory::get();
        //$main_categories = MainCategory::with('sub_categories')->get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        //dd($request);
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
        //attach：中間テーブルへ
        $post->subCategories()->attach($request->post_category_id);
        return redirect()->route('post.show');
    }
    //投稿の編集
    public function postEdit(PostEditRequest $request){
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    //メインカテゴリーの追加
    public function mainCategoryCreate(MainCategoryRequest $request){
        MainCategory::create(['main_category' => $request->main_category_name]);
        return redirect()->route('post.input');
    }
    // サブカテゴリーの追加
    public function subCategoryCreate(SubCategoryRequest $request){
        //メインカテゴリーidを取得
    $mainCategoryId = $request->input('main_category_id');
    $subCategoryName = $request->input('sub_category_name');

    $subCategory = new SubCategory();
    $subCategory->main_category_id = $mainCategoryId;
    $subCategory->sub_category = $subCategoryName;
    $subCategory->save();
    return redirect()->route('post.input');
}

//投稿のコメント
    public function commentCreate(CommentRequest $request){
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);
        //dd($request);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }
    //自分の投稿一覧
    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }
    //いいねした投稿一覧
    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }
    //サブカテゴリーの投稿
    public function subcategoryPosts($sub_category_id) {
        //dd($sub_category_id);
        $subcategory = Subcategory::find($sub_category_id);
        $posts = $subcategory->posts;
        return view('authenticated.bulletinboard.post_subcategory', compact('posts', 'subcategory'));
}
//いいね機能
    //ユーザーidと投稿idを受け取り、Likeモデルを使用して新しいいいねのレコードを追加する
    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }
    //いいねの解除
    //Likeモデルを使用して、該当のいいねレコードを削除する
    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }


}
