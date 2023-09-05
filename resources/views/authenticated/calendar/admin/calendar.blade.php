@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto">
  <div class="w-100">
    <p>{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
</div>
<!-- キャンセルモーダルの中身　-->
<div class="modal js-modal-cancel">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('deleteParts') }}" method="post">
      <div class="w-100">
        <!-- 予約日 -->
        <div class="modal-reserve">
          <input type="submit" class="" name="setting_reserve" value="">
          <!-- 機能に必要な日付を送る -->
          <input type="hidden" name="hide_setting_reserve" value="">
        </div>
        <!-- 予約部数 -->
        <div class="modal-reserve-part">
          <input type="submit" name="reservePart">
          <!-- 機能に必要な部数を送る -->
          <input type="hidden" name="setting_part">
        </div>
        <!-- 閉じるボタン-->
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="modal-hidden" name="user_id" value="">
          <!-- キャンセルボタン　-->
          <input type="submit" class="btn btn-primary d-block" value="キャンセル">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>

@endsection
