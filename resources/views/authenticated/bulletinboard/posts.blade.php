@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto"></p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto">
      <p class="post_name"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p class="post_title"><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      <span class="button-flex">
       @foreach($post->subCategories as $sub_category)
       <p class="sub_category" sub_category_id="{{ $sub_category->id }}"><span class="sub_category_tag">{{ $sub_category->sub_category }}</span>
       @endforeach
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span>{{ $post->postComments->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span></p>
            @endif
            </span>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area border w-25">
    <div class="border m-4">
      <div class="post_btn"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="keyword_search">
        <span class="search_container">
        <input class="text_box" type="text" placeholder="キーワードを入力" name="keyword" form="postSearchRequest">
        <input class="keyword-btn" type="submit" value="検索" form="postSearchRequest"></span>
      </div>
      <div class="btn_flex">
      <span class="post_like"><input type="submit" name="like_posts" class=" category_btn" value="いいねした投稿" form="postSearchRequest"></span>
      <span class="my_post">
      <input type="submit" name="my_posts" class="category_btn" value="自分の投稿" form="postSearchRequest"></span>
      </div>
        <div class="accordion_container">
          <ul class="menu_items">
            <p class="category_items">カテゴリー検索</p>
            @foreach($categories as $category)
            <div class="category-container">
              <div class="accordion-push-js" data-target="{{ $category->id }}">

              <div class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}</span></div>
              <div class="accordion-push" data-target="{{ $category->id }}"></div>

              </div>

              <ul class="sub_categories" data-category="{{ $category->id }}">
                @foreach($category->subCategories as $sub_category)
                <li class="sub_category" sub_category_id="{{ $sub_category->id }}">
                  <input type="submit" name="category_word" class="category_btn" value="{{ $sub_category->sub_category }}" form="postSearchRequest">
                </li>
                @endforeach
              </ul>
            </div>
            @endforeach
          </ul>
        </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
@endsection
