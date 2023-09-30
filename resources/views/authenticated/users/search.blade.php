@extends('layouts.sidebar')

@section('content')
<p>ユーザー検索</p>
<div class="search_content w-100 border d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span class="bold">{{ $user->id }}</span>
      </div>
      <div><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span class="bold">({{ $user->over_name_kana }}</span>
        <span class="bold">{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span class="bold">男</span>
        @else
        <span>性別 : </span><span class="bold">女</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span class="bold">{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span class="bold">教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span class="bold">教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span class="bold">講師(英語)</span>
        @else
        <span>権限 : </span><span class="bold">生徒</span>
        @endif
      </div>
      <div>
        @if($user->role == 4)
        <span>選択科目:
        @foreach($user->subjects as $subject)
          <span class="bold">{{ $subject->subject }}</span></span>
        @endforeach
        @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25 border">
    <div class="search_container">
      <div class="search_word">
        <p>検索</p>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div class="search_category">
        <lavel>カテゴリ</lavel>
        <select form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div class="search_category">
        <label>並び替え</label>
        <select name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="add_search">
        <p class="m-0 search_conditions"><span class="search_border">検索条件の追加
          <i class="fa fa-chevron-down"></i>
        </span></p>
        <div class="search_conditions_inner">
          <div>
            <label>性別</label>
            <p>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span class="search_sex">女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            </p>
          </div>
          <div class="search_role">
            <label>権限</label>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer"></div>
          <label>選択科目</label>
          <div>
            @foreach($allSubjects as $subject)
            <div class="select_subject">
              <label class="subject_flex">{{ $subject->subject }}
                <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}" form="userSearchRequest">
              </label>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="search_submit">
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="search_reset">
        <input type="reset" value="リセット" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
