<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $data = [];
        $booking = Booking::with('Customer')->paginate(10);
        $data['booking'] = $booking;
        return view('admin.bookings.index',$data);
    }
}
