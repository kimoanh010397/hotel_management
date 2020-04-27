@extends('layout.content')
@section('content')
    <div class='container'>
        <h1 class="font-1" style="margin: 30px auto; text-align: center;"><b>Booking Room</b></h1>


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


        <form action="{{ route('booking_detail.store')}}" method='post'>
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label>Check In *</label>
                            <input type="text" class="form-control" name="time_from" value="{{ old('time_from',$date['time_from']) }}" readonly>
                        </div>
                        <div class='form-group'>
                            <label>Customer Name</label>
                            @if($customers)
                                <select name="name" class="form-control">
                                    <option value="{{ $customers->id }}" selected>{{ old('name',$customers->full_name) }}</option>
                                </select>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class='form-group'>
                            <label>Check out *</label>
                            <input type="text" class='form-control' name='time_to' value="{{ old('time_to',$date['time_to']) }}" readonly>
                        </div>
                        <div class='form-group'>
                            <label>Email</label>
                            <input type="text" class='form-control' name='email' value="{{ old('email',$customers->email) }}" readonly>
                        </div>
                    </div>
                </div>
                @if(empty($rooms))
                    <h3 >Vui lòng chọn Room !</h3>
                    <a href="{{ route('search-room.find_rooms', ['time_from' => $date['time_from'], 'time_to' => $date['time_to']]) }}"
                       class="btn btn-danger">Back</a>
                @else
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Room Number</th>
                            <th>Price</th>
                            <th>Money</th>
                            <th colspan="1">Action</th>
                        </tr>
                        @php
                            $moneySum = 0;
                        @endphp

                        @foreach($rooms as $value)
                            @php
                                $money = ($total_date + 1) * $value['price'];
                            @endphp
                            <tr>
                                <td>{{ $value['room_number'] }}</td>
                                <td>{{ number_format($value['price']) . ' / ngày' }}</td>
                                <td>{{ number_format($money)}}</td>
                                <td>
                                    <a href="{{ route('select-room.destroy', ['id' => $value['id'],'time_from' => $date['time_from'], 'time_to' => $date['time_to']]) }}"
                                       class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @php
                                $moneySum += $money;
                            @endphp
                        @endforeach

                        <tr>
                            <td colspan="3" style="text-align: center"><strong>Total Money (*VND)</strong></td>
                            <td>{{ number_format($moneySum) }}</td>
                            <input type="hidden" name="money" value="{{$moneySum}}">
                        </tr>
                    </table>
                    <div class="text-right">
                        <a href="{{ route('search-room.find_rooms',['time_from' => $date['time_from'],'time_to' => $date['time_to']]) }}" class="btn btn-success">Add Room</a>
                    </div>
            </div>


            <div class="container">
                <div class="row">
                    <!-- You can make it whatever width you want. I'm making it full width
                    on <= small devices and 4/12 page width on >= medium devices -->
                    <div class="col-xs-12 col-md-4"></div>


                    <div class="col-xs-12 col-md-4">

                        <!-- CREDIT CARD FORM STARTS HERE -->
                        <div class="panel panel-default credit-card-box">
                            <div class="panel-heading display-table" >
                                <div class="row display-tr" >
                                    <h3 class="panel-title display-td" >Payment Details</h3>
                                    <div class="display-td" >
                                        <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="couponCode">NAME ON CARD</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="cardName" placeholder="Full name (on the card)" required autofocus/>
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label for="cardNumber">CARD NUMBER</label>
                                            <div class="input-group">
                                                <input
                                                    type="tel"
                                                    class="form-control"
                                                    name="cardNumber"
                                                    placeholder="Valid Card Number"
                                                    autocomplete="cc-number"
                                                />
                                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                                            <input
                                                type="tel"
                                                class="form-control"
                                                name="cardExpiry"
                                                placeholder="MM / YY"
                                                autocomplete="cc-exp"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-xs-5 col-md-5 pull-right">
                                        <div class="form-group">
                                            <label for="cardCVC">CV CODE</label>
                                            <input
                                                type="tel"
                                                class="form-control"
                                                name="cardCVC"
                                                placeholder="CVC"
                                                autocomplete="cc-csc"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="display:none;">
                                    <div class="col-xs-12">
                                        <p class="payment-errors"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-md-4"></div>


                </div>
            </div>

            <div class='text-center'>
                <button type='submit' class='btn btn-primary'>Booking Room</button>
            </div>
            @endif
        </form>
    </div>
@endsection
