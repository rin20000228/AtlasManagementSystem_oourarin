@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
    <div class="w-75 m-auto border" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="">
        {!! $calendar->render() !!}
      </div>
    </div>
    <!-- キャンセルモーダルの中身　-->
    <div class="modal js-modal-cancel">
      <div class="modal__bg js-modal-close"></div>
      <div class="modal__content">
        <form action="{{ route('deleteParts') }}" method="post">
          <div class="w-100">
            <!-- 予約日 -->
            <div class="modal-reserve w-50 m-auto">
              <p name="setting_reserve" class=""></p>
              <!-- 機能に必要な日付を送る -->
              <input type="hidden" name="hide_setting_reserve" value="">
            </div>
            <!-- 予約部数 -->
            <div class="modal-reserve-part">
              <p name="reservePart" class=""></p>
              <!-- 機能に必要な部数を送る -->
              <input type="hidden" name="setting_part">
            </div>
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
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
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
@endsection
