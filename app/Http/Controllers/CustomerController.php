<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\PasswordRequest;
use App\Model\Customer;
use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $customers = Customer::paginate(5);
        $data['customers'] = $customers;
        return view('customers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $params = $request->all();
        if(strcmp($request->get('pass'), $request->get('pass01')) != 0){
            return redirect()->back()->with("error","New passwords are not the same. Please choose a different password.");
        }
        $dataInsert = [
            'full_name' => $params['name'],
            'address' => $params['address'],
            'phone' => $params['phone'],
            'email' => $params['email'],
            'password' => bcrypt($params['pass']),
        ];
//        dd($dataInsert);
        try {
            DB::beginTransaction();

            Customer::insert($dataInsert);

            DB::commit();

            return redirect(route('show-login'))->with('success', 'Create Account Success.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('customer.create'))->with('error', 'Please try again.');
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
        $customer = Customer::findOrFail($id);
        $data['customer'] = $customer;
        return view('customers.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = [];
        if (!Auth::guard('customer')->check())
            return view('login.login');
        $customer = Auth::guard('customer')->user()->id;
        $data['id'] = $customer;
        return view('customers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $params = $request->all();

        //kiểm tra pass cũ
        if (!Hash::check($request->current_password,$customer['password'])) {
            return redirect()->back()->with('error', 'old password invalid');
        }

        //kiếm tra pass cũ và mới
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        //kiếm tra 2 pass mới
        if(strcmp($request->get('new_password'), $request->get('new_password_confirmation')) != 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New passwords are not the same. Please choose a different password.");
        }

        $dataInsert = [
            'password' => bcrypt($params['new_password']),
        ];

        try {
            DB::beginTransaction();
            Customer::where('id',$id)->update($dataInsert);
            DB::commit();
            return redirect()->back()->with("success","Password changed successfully !");
        }catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with("success","Password has not been changed !");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Customer::findOrFail($id)->delete();
            DB::commit();

            return response()->json([
                'success' => 'Delete successful.'
            ]);
        }catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                'error' => 'Delete fail.'
            ]);
        }
    }
}
