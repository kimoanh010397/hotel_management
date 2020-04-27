<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ChartJs;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Model\Booking_detail;
use App\Model\Customer;
use App\Model\Room;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        $data = [];
        $rooms = Room::paginate(5);
        $data['rooms'] = $rooms;
        return view('admin.rooms.index',$data);
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(RoomRequest $request)
    {
        $params = $request->all();
        $get_image = '';
        if($request->hasFile('image')){
            //Hàm kiểm tra dữ liệu
            $this->validate($request,
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            //Lưu hình ảnh vào thư mục public/image_room
            $img = $request->file('image');
//            $get_image = time().'_'.$img->getClientOriginalName();
            $get_image = $img->getClientOriginalName();
            $destinationPath = public_path('image_room');
//            dd($destinationPath);
            $img->move($destinationPath, $get_image);
        }

//        dd($get_image);
        $dataInsert = [
            'room_number' => $params['number'],
            'description' => $params['description'],
            'price' => $params['price'],
            'image' => $get_image,
        ];
        try {
            DB::beginTransaction();

            Room::insert($dataInsert);

            DB::commit();

            return redirect(route('admin.room.index'))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('admin.room.index'))->with('error', 'thêm mới thất bại.');
        }
    }

    public function show(Request $request,$id)
    {
        $data = [];
        $params = $request->all();
        //trường hợp detail tại search_room
        if (!empty($params))
        {
            $dataInsert = [
                'time_from' => $params['time_from'],
                'time_to' => $params['time_to'],
            ];
            $data['date'] = $dataInsert;
        }
        $slider = Slider::select('filename')->where('room_id',$id)->get();
        $room = Room::findOrFail($id);
        $data['room'] = $room;
        $data['slider'] = $slider;
        return view('admin.rooms.show',$data);
    }

    public function edit($id)
    {
        $data = [];
        $room = Room::findOrFail($id);
        $data['room'] = $room;
        return view('admin.rooms.edit',$data);
    }

    public function update(RoomRequest $request, $id)
    {
        $params = $request->all();
        //Thực hiện lưu thay đổi hình thẻ khi có file
        if($request->hasFile('image')){
            $this->validate($request,
                [
                    'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );
            //Xóa file hình thẻ cũ
            $get_image = Room::select('image')->where('id',$request->id)->get();
//            dd($getHT[0]->image);
            if(!empty($get_image[0]->image) && file_exists(public_path('image_room/'.$get_image[0]->image)))
            {
                unlink(public_path('image_room/'.$get_image[0]->image));
            }
            //Lưu file hình thẻ mới
            $image = $request->file('image');
            $getImg = $image->getClientOriginalName();
            $destinationPath = public_path('image_room');
            $image->move($destinationPath, $getImg);
        }
        else
        {
            $getImg = $params['old_img'];
        }

        $dataUpdate = [
            'room_number' => $params['number'],
            'description' => $params['description'],
            'price' => $params['price'],
            'image' => $getImg,
        ];
        try {
            DB::beginTransaction();
            Room::where('id',$id)->update($dataUpdate);
            DB::commit();
            return redirect()->route('admin.room.index')->with('success','Update successful.');
        }catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.room.index')->with('error','Update fail.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Room::findOrFail($id)->delete();
            DB::commit();

            return response()->json([
                'success' => 'Delete successful.'
            ]);
        }catch (\Exception $exception){
            DB::rollBack();

            return response()->json([
                'error' => 'Delete fail.'
            ]);
        }
    }

    public function report(Request $request)
    {
        $data = [];
        $time_from = $request->input('from');
        $time_to = $request->input('to');

        $rooms = Room::all();
        foreach ($rooms as $value)
            $idRoom[] = $value->id;

        foreach ($idRoom as $key => $value)
        {
            if (!empty($time_to and  $time_from))
                $bookingDetails = Booking_detail::where('room_id',$value)->whereBetween('time_from',[$time_from,$time_to])->get();
            else
                $bookingDetails = Booking_detail::where('room_id',$value)->get();

            if (!empty($bookingDetails) and count($bookingDetails) != 0) {
                foreach ($bookingDetails as $value) {
                    $customer_name[$key][] = Customer::findOrFail($value->Booking->customer_id)->full_name;
                    $room_number[] = $value->room->room_number;

                    $from[$key][] = $value->time_from;
                    $to[$key][] = $value->time_to;

                    $start_date = Carbon::parse($value->time_from);
                    $end_date = Carbon::parse($value->time_to);
                    $diff_in_days = $start_date->diffInDays($end_date);

                    $usedTime[$key][] = $diff_in_days + 1;
                    $money[$key][] = ($diff_in_days + 1) * $value->room->price;
                }
            }
        }
        if (empty($room_number))
            return redirect()->back()->with('error', 'Data not found');

        $room_number = array_unique($room_number);
        $key = 0;
        foreach ($room_number as $value)
        {
            $room[] = $value;
            $totalMoney[] = array_sum($money[$key]);
            $key += 1;
        }

        $chart1 = new ChartJs;
        $chart1->labels($room);
        $chart1->dataset('Report by room', 'line', $totalMoney)->options([
            'borderColor' => 'red',
        ]);

        $data['chart1'] = $chart1;


        $data['time_from'] = $time_from;
        $data['time_to'] = $time_to;
        $data['roomName'] = $room;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['usedTime'] = $usedTime;
        $data['customer'] = $customer_name;
        $data['money'] = $money;
        $data['totalMoney'] = $totalMoney;
       return view('admin.bookingdetails.report',$data);
    }
}
