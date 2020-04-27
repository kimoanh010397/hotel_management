<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register VacayHome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- LINEARICONS -->
    <link rel="stylesheet" href="{{ asset('assets/form-signup/fonts/linearicons/style.css') }}">

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('assets/form-signup/css/style.css')}}">
</head>

<body>
<div class="container">
    <div class="wrapper">
        <div class="inner">
            {{--show message success--}}
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            {{--show message fail--}}
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <img src="{{ asset('assets/form-signup/images/image-1.png') }}" alt="" class="image-1">
            <form action="{{ route('customer.store')}}" method='post'>
                @csrf
                <h3>New Account?</h3>
                <div class="form-holder">
                    <span class="lnr lnr-user"></span>
                    <input type="text" class="form-control" placeholder="Full name" name="name">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-phone-handset"></span>
                    <input type="text" class="form-control" placeholder="Phone Number" name="phone">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-envelope"></span>
                    <input type="email" class="form-control" placeholder="Mail" name="email">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-apartment"></span>
                    <input type="text" class="form-control" placeholder="Address" name="address">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <input type="password" class="form-control" placeholder="Password" name="pass">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="pass01">
                </div>
                <button>
                    <span>Register</span>
                </button>
                <div style="margin-top: 20px;" class="form-holder">
                    <p class="form-control">Already Registered?<a href="{{ route('show-login') }}">Login here</a></p>
                </div>

            </form>
            <img src="{{ asset('assets/form-signup/images/image-2.png') }}" alt="" class="image-2">
        </div>

    </div>
</div>


<script src="{{ asset('assets/form-signup/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/form-signup/js/main.js') }}"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
