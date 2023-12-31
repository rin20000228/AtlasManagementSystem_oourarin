@extends('layouts.sidebar')
@section('content')
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container">
      <div class="post_detail_container">
        <!-- 投稿の編集・削除ボタン -->
        @if(Auth::user()->id == $post->user_id)
        <div class="detail_inner_head">
          <div>
            @if($errors->first('comment'))
            <p class="error_message">{{ $errors->first('comment') }}</p>
            @endif
          </div>
          <div class="detail_flex">
            @foreach($post->subCategories as $sub_category)
            <p class="post_sub_category" sub_category_id="{{ $sub_category->id }}"><span class="sub_category_tag">{{ $sub_category->sub_category }}</span></p>
            @endforeach
            <span class="btn_edit">
            <p class="edit-modal-open" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</p></span>
            <p class="btn_delete">
              <a class="post-delete-modal" href="{{ route('post.delete', ['id' => $post->id]) }}" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
            </p>
          </div>
        </div>
        @endif
        <div class="contributor d-flex">
          <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <ul>
        @if ($errors->has('post_title'))
        <li>{{ $errors->first('post_title') }}</li>
        @endif
        </ul>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <ul>
          @if ($errors->has('post_body'))
        <li>{{ $errors->first('post_body') }}</li>
        @endif
        </ul>
        <div class="mt-3 detsail_post">{{ $post->post }}</div>

      </div>
      <div class="comment_box">
        <div class="comment_container">
          <span class="comment_text">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <p>{{ $comment->comment }}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50">
    <div class="comment_container border m-5">
      <div class="comment_area">
        @if($errors->first('comment'))
        <p class="error_message">{{ $errors->first('comment') }}</p>
        @endif
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<!-- 編集モーダルの中身 -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <!-- 編集ボタン -->
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection
