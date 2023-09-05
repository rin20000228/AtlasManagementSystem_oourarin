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
        //dd($request);
        DB::beginTransaction();
        try{
            //予約の際に送っている内容
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                //予約すると予約可能人数が減る
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
    //予約の解除
    public function reserveDelete(Request $request){

    }
}
