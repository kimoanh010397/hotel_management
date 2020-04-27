<?php

namespace App\Http\Controllers;

use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SearchRoomController extends Controller
{
    public function index(Request $request)
    {
//        lấy ra những phòng đã booking ==> show ra những phòng còn lại (chưa đc booking)


        $data = [];
        $time_from = $request->input('time_from');
        $time_to = $request->input('time_to');

        if(!empty($time_from and $time_to))
        {
//            kiểm tra những phòng có thời gian Booking ( tức là đã có booking)
//            DB::enableQueryLog(); //dùng để lấy câu lệnh SQL
            $rooms = Room::with('Booking_detail');
            $rooms = $rooms->whereHas('Booking_detail', function ($temp) use ($time_from, $time_to) {
                $temp->whereBetween('time_from', [$time_from, $time_to])
                    ->orWhereBetween('time_to', [$time_from, $time_to]);
            })->get();
//            dd($rooms);
            if (count($rooms) == 0) //không có booking
                $room = Room::paginate(2);
            else //đã có booking
            {
                foreach ($rooms as $value)
                {
                    $idroom[] = $value->id;
//                    dd($idroom);
                }
                $room = Room::whereNotIn('id', $idroom)->paginate(2);
            }
//            dd(DB::getQueryLog());
            $data['room'] = $room;

            //tính số ngày (dùng cho menu nhỏ bên cạnh ->đã bỏ)
//            $start_date = Carbon::parse($time_from);
//            $end_date = Carbon::parse($time_to);
//            $diff_in_days = $start_date->diffInDays($end_date);
//
//
//            $data['total_date'] = $diff_in_days;
        }
//        dd($data['room']);


        //(dùng cho menu nhỏ bên cạnh ->đã bỏ)
//        if($request->session()->has('rooms'))
//        {
//            foreach (session('rooms') as $value)
//            {
//                $rooms = Room::findOrFail($value);
//                $data['roomSession'][] = $rooms;
//                //            dd($rooms);
//            }
//        }




        $data['time_from'] = $time_from;
        $data['time_to'] = $time_to;
        return view('searchs.search',$data);
        //hiển thị room đã chọn

    }
}
