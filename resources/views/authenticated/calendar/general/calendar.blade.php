@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="border w-75 m-auto pt-5 pb-5 calendar_reserve" style="border-radius:5px;">
    <div class="calender_reserve_container w-75 m-auto border" style="border-radius:5px;">

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
            <div class="modal-reserve">
              <p name="setting_reserve" class="modal-reserve"></p>
              <!-- キャンセル機能に必要な日付を送る -->
              <input type="hidden" class="modal-reserve" name="hide_setting_reserve" value="">
            </div>
            <!-- 予約部数 -->
            <div class="modal-reserve-part">
              <p name="reservePart" class="modal-reserve-part"></p>
              <!-- キャンセル機能に必要な部数を送る -->
              <input type="hidden" class="modal-reserve-part" name="setting_part">
            </div>
            <p>上記の予約をキャンセルしてもよろしいですか？</p>
            <!-- 閉じるボタン-->
            <div class="w-50 m-auto edit-modal-btn d-flex">
              <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
              <!-- キャンセルボタン　-->
              <input type="submit" class="btn btn-primary d-block" value="キャンセル">
            </div>
          </div>
          {{ csrf_field() }}
        </form>
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="cancel_submit btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
@endsection
