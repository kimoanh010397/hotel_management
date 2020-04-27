<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ChartJs;
use App\Http\Controllers\Controller;
use App\Model\Booking;
use App\Model\Booking_detail;
use App\Model\Customer;
use Carbon\CarbonInterval;
use DatePeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingDetailController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $time_from = $request->input('from');
        $time_to = $request->input('to');


        if(!empty($time_from and $time_to))
        {
            $bookingDetails = Booking_detail::with('Room')->whereBetween('time_from',[$time_from,$time_to])->paginate(15);
            if (empty($bookingDetails))
                return redirect()->back()->with('error', 'Data not found');
        }
        else
            $bookingDetails = Booking_detail::with('Room')->paginate(15);


        if (!empty($bookingDetails) and count($bookingDetails) != 0)
        {
            foreach ($bookingDetails as $value) {
                $customer_name[] = Customer::findOrFail($value->Booking->customer_id)->full_name;

                $time[] = $value->time_from;
                $start_date = Carbon::parse($value->time_from);
                $end_date = Carbon::parse($value->time_to);
                $diff_in_days = $start_date->diffInDays($end_date);
                $money[] = ($diff_in_days + 1) * $value->room->price;
            }

            $moneytotal = array_sum($money);
            $data['moneytotal'] = $moneytotal;
            $chart1 = new ChartJs;
            $chart1->labels($time);

            $chart1->dataset('Report by room', 'line', $money)->options([
                'borderColor' => 'red',
            ]);
            $data['chart1'] = $chart1;


            $data['money'] = $money;

            $data['customer_name'] = $customer_name;
            $data['bookingDetail'] = $bookingDetails;
        }



        $data['time_from'] = $time_from;
        $data['time_to'] = $time_to;
        return view('admin.bookingdetails.index',$data);
    }

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
        return view('admin.bookingdetails.show',$data);
    }
}
