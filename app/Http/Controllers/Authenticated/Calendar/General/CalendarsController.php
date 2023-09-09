<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        //time()で現在時刻を取得し今月のカレンダーを表示
        $calendar = new CalendarView(time());
        //dd($calendar);
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    //予約機能
    public function reserve(Request $request){
        //トランザクション
        DB::beginTransaction();
        try{
            //予約の際に送っている内容
            $getPart = $request->getPart;
            $getDate = $request->getData;
            //1つの変数にする
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            //dd($reserveDays);
            //DBの処理(予約は複数予約することが可能なのでループ処理が必要)
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                //予約すると予約可能人数が減る
                $reserve_settings->decrement('limit_users');
                //テーブルにuserのidを保存
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
    //予約のキャンセル
    public function delete(Request $request){
        //dd($request);
        DB::beginTransaction();
        try {
            //キャンセルする予約情報の取得
            //キャンセルは一度に複数のキャンセルができないのでループ処理不要
            $reserveDate = $request->hide_setting_reserve;
            //dd($reserveDate);
            $reservePart = $request->setting_part;
            //dd($reservePart);
             $reserve_settings = ReserveSettings::where('setting_reserve', $reserveDate)->where('setting_part', $reservePart)->first();
             //dd($reserve_settings);
            //予約可能人数を増やす
            $reserve_settings->increment('limit_users');
            //テーブルから該当ユーザーの予約を削除
            $reserve_settings->users()->detach(Auth::id());

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

    }
