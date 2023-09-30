@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <span>{{ $date }}日</span>
    <span class="ml-3">{{ $part }}部</span></p>
    <div class="reserve_detail_cnotent border">
      <table class="">
        <tr class="detail_titles text-center">
          <th class="detail_title">ID</th>
          <th class="detail_title">名前</th>
          <th class="detail_title">場所</th>
          </tr>
            @foreach($reservePersons as $reservePerson)
            @foreach($reservePerson->users as $user)
            <tr class="reserve_user text-center">
            <th>{{ $user->id }}</th>
            <th>{{ $user->over_name }}{{ $user->under_name }}
            </th>
            <th>リモート</th>
            </tr>
            @endforeach
            @endforeach

        <tr class="text-center">
          <td class="w-25"></td>
          <td class="w-25"></td>
        </tr>

      </table>
    </div>
  </div>
</div>
@endsection
