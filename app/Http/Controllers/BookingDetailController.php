<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Model\Booking;
use App\Model\Booking_detail;
use App\Model\Customer;
use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $bookingDetails = Booking_detail::with('Room')->paginate(10);

        foreach ($bookingDetails as $value) {
            $customer_name[] = Customer::findOrFail($value->Booking->customer_id)->full_name;
        }
        $data['customer_name'] = $customer_name;
        $data['bookingDetail'] = $bookingDetails;
        return view('bookingdetails.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //kiểm tra đã login chưa => rồi thì lấy ra thông tin customer
        if (!Auth::guard('customer')->check())
            return view('login.login');


        $customer = Auth::guard('customer')->user();

        $params = $request->all();
        $dataInsert = [
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
        ];

        $data = [];

        //kiểm tra session đã có chưa ( tức là customer đã chọn phòng chưa )
        if($request->session()->has('rooms'))
        {
            foreach (session('rooms') as $value)
            {
                $rooms = Room::findOrFail($value);
                $data['rooms'][] = $rooms;
                //            dd($rooms);
            }
        }

//        dd($data);

        //tính số ngày
        $start_date = Carbon::parse($params['time_from']);
        $end_date = Carbon::parse($params['time_to']);
        $diff_in_days = $start_date->diffInDays($end_date);


        $data['total_date'] = $diff_in_days;
        $data['customers'] = $customer;
        $data['date'] = $dataInsert;
        return view('bookingdetails.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();

        //xử lý card
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'http://127.0.0.1:3000/api/card/info', [
                'form_params' => [
                    'name' => $params['cardName'],
                    'card_number' => $params['cardNumber'],
                    'expiration_date' => $params['cardExpiry'],
                    'cvv' => $params['cardCVC'],
                    'money' => $params['money'],
                ]
            ]);
            $body = json_decode($response->getBody(),true);

            if ($body['status'] == 'error card')
                return redirect()->back()->with('error', 'Wrong card information');
            if ($body['status'] == 'error date')
                return redirect()->back()->with('error', 'Card expired');
            if ($body['status'] == 'error money')
                return redirect()->back()->with('error', 'Money on the card is not enough');

        } catch (RequestException $e) {
            echo $e->getRequest() . "\n";
            if ($e->hasResponse()) {
                echo $e->getResponse() . "\n";
            }
        }

        //xử lý booking
        try {

            //insert vào Bookings và lấy booking_id
            $customerId = [
                'customer_id' => $params['name']
            ];

            $bookingId = Booking::insertGetId($customerId);
//        dd($bookingId);


            //insert vào booking_details
            $dataBooking = [];
            $timefrom = $params['time_from'];
            $timeto = $params['time_to'];
            if($request->session()->has('rooms'))
            {
                $start_date = Carbon::parse($params['time_from']);
                $end_date = Carbon::parse($params['time_to']);
                $diff_in_days = $start_date->diffInDays($end_date);

                foreach (session('rooms') as $value)
                {
                    $dataBooking[] = [
                        'time_from' => $timefrom,
                        'time_to' => $timeto,
                        'room_id' => $value,
                        'booking_id' => $bookingId
                    ];

                    //send mail for customer
                    $rooms = Room::findOrFail($value);
                    $data[] = [
                        'time_from' => $timefrom,
                        'time_to' => $timeto,
                        'room_name' => $rooms->room_number,
                        'price' => ($diff_in_days + 1) * ($rooms->price),
                    ];
                }
            }


            DB::beginTransaction();

            Booking_detail::insert($dataBooking);
            //send mail
            Mail::to(Auth::guard('customer')->user()->email)->send(new WelcomeMail($data));
            //xóa session sau khi booking xong
            $request->session()->forget('rooms');

            DB::commit();

            return redirect(route('booking_detail.show',$bookingId))->with('success', 'Booking thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('search-room.find_rooms',['time_from' =>$params['time_from'],'time_to' => $params['time_to']]))->with('error', 'thêm mới thất bại.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $bookingDetail = Booking_detail::with('Room')->where('booking_id',$id)->paginate(5);
//        dd($bookingDetail);

        $booking = Booking::findOrFail($id);
        $customer = Customer::findOrFail($booking->customer_id)->full_name;
//        dd($customer);

        $data['name'] = $customer;
        $data['bookingDetail'] = $bookingDetail;
        return view('bookingdetails.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
