<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $data = [];
        $customers = Customer::paginate(5);
        $data['customers'] = $customers;
        return view('admin.customers.index',$data);
    }
}
