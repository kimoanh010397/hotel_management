<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\CheckRequest;
use App\Mail\MailNotify;
use App\Mail\WelcomeMail;
use App\Model\Customer;
use App\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('customer')->check())
        {
            return redirect('/');
        }

        else
            return view('login.login');
    }


    public function handleLogin(CheckRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->pass,
        ];
        if (Auth::guard('customer')->attempt($login)) {
            $url = url()->previous();
//            dd($url);
            return redirect($url);
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }

    }


    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->forget('rooms'); //xóa session nếu customer booking chưa thanh toán đã logout
        return redirect()->route('home');
    }


    public function reset()
    {
        return view('emails.emailResetPassword');
    }


    public function validatePasswordRequest(Request $request)
    {

//You can add validation login here
        $user = DB::table('customers')->where('email', '=', $request->email)
            ->first();

//Check if the user exists
        if (empty($user)) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist')]);
        }

//Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token'=>Str::random(60) ,
            'created_at' => Carbon::now()
        ]);

//Get the token just created above (Nhận mã thông báo vừa tạo ở trên)
        $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->back()->with('status', trans('A reset link has been sent to your email address.'));
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }


    private function sendResetEmail($email, $token)
    {
//Retrieve the user from the database
        $user = DB::table('customers')->where('email', $email)->select('full_name', 'email')->first();
//Generate, the password reset link. The token generated is embedded in the link
        $data = url('resetPassword') . '/' . $token . '?email=' . urlencode($user->email);

        try {
            Mail::to($email)->send(new MailNotify($data));
            //Here send the link with CURL with an external email API
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function resetPassword(Request $request)
    {
        // Check token valid or not
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();

        $data['token'] = $tokenData->token;

        if($tokenData){
            return view('emails.newPass', $data);
        } else {
            echo 'This link is expired';
        }
    }

    public function newPassword(Request $request)
    {
        // Check password confirm
        if(strcmp($request->get('password'), $request->get('confirm')) == 0){
            // Check email with token
            $result = DB::table('password_resets')->where('token', $request->token)->first();

            // Update new password
            Customer::where('email', $result->email)->update(['password'=>bcrypt($request->password)]);

            // Delete token
            $result = DB::table('password_resets')->where('token', $request->token)->delete();

            return redirect()->route('show-login');
        } else {
            return redirect()->back()->with("error","New passwords are not the same. Please choose a different password.");
        }
    }
}
