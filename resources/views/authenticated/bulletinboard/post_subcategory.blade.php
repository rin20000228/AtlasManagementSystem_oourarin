@extends('layouts.sidebar')
@section('content')

<div class="post_view w-75 mt-5">
  <p class="w-75 m-auto">サブカテゴリー投稿一覧</p>
  @foreach($posts as $post)
  <div class="post_area border w-75 m-auto p-3">
    <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
    <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
    <div class="post_bottom_area d-flex">

    </div>
  </div>
  @endforeach
</div>

@endsection
