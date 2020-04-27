<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SelectRoomController extends Controller
{
    public function index(Request $request)
    {
//        $request->session()->forget('rooms');
//        dd(session()->all());
        $rooms = [];
        $params = $request->all();
//        dd($params);
        //kiểm tra : chưa có session thì tạo session , có rồi thì thêm vào
        if($request->session()->has('rooms'))
        {
//            dd('thien 1');
//            dd(session('rooms'));
//            kiểm tra trùng , chọn 2 lần 1 rooms
            if (!in_array($params['id'],session('rooms')))
            {
                $rooms = session('rooms');
//            dd($rooms);
                $rooms[] = $params['id'];
//            dd($rooms);
                session(['rooms' => $rooms]);
//            dd(session('rooms'));
            }
        }
        else
        {
//            dd('thien 2');
            $rooms[] = $params['id'];
            session(['rooms' => $rooms]);//tạo session
//            dd(session('rooms'));
        }
//        dd(session()->get('rooms'));
        return redirect()->route('search-room.find_rooms',['time_from' => $params['time_from'],'time_to' => $params['time_to']]);


    }


    public function destroy(Request $request)
    {
//        $request->session()->forget('rooms');
        $params = $request->all();
        $dataInsert = [
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
            'id' => $params['id']
        ];

        $room = session('rooms');
        //lấy ra vị trị tại($key) tại giá trị ($value) id
        $keyId = array_search($params['id'],$room);
//        dd($keyId);
        unset($room[$keyId]);
        session(['rooms' => $room]);
        return redirect()->route('booking_detail.create',['time_from' => $dataInsert['time_from'], 'time_to' => $dataInsert['time_to']]);
    }
}
