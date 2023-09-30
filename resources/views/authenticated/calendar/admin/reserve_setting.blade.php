@extends('layouts.sidebar')
@section('content')
<div class="w-100">
<div class="calender_setting_container w-70 d-flex" style="align-items:center; justify-content:center;">
  <div class="setting_content w-100 vh-20 border p-5">
    <p class="calender_title">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary setting_submit" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection
