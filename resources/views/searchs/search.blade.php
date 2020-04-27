@extends('layout.content')
@section('content')
    <div class='container'>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="search">
            <div class="form-group">
                <form action="{{ route('search-room.find_rooms')}}" method='get'>
                    <div class='form-search'>
                        <label style="color: white">Time from *</label>
                        <input type="date" class="form-control" name="time_from" required
                                   value="{{ old('time_from',$time_from) }}">
                    </div>
                    <div class="form-search">
                        <label style="color: white">Time to *</label>
                        <input type="date" class="form-control" name="time_to" required
                                   value="{{ old('time_to',$time_to) }}">
                    </div>
                    <button type="submit" class="book-now-btn text-center" style="margin-top: 20px; margin-left: 100px; float: left;">Check availibity</button>
                    </form>
                </div>
            <div class="col-md-1" style="margin-top: 20px; margin-left: 70px;"><a href="{{ route('booking_detail.create',['time_from' => $time_from, 'time_to' => $time_to]) }}" class="btn btn-warning" ><span  style="width:30px;">BOOKING NOW</span></a></div>

        </div>
                <div class='form-group'>
                    @if (!empty($room))
                        @foreach($room as $value)
                            <div class="search_booking" >
                                {{--                        <div class="col-md-8">--}}
                                <div class="col-md-7 col-sm-8 col-xs-12">
                                    <div class="event-blog-image">
                                        <img alt="image" style="height: 300px; width: 550px;margin:10px; border-radius: 5px;" src="{{asset('/image_room/'  . $value->image )}}" alt="{{ $value->image }}">
                                    </div>
                                </div>
                                <div class=" side-in-image">
                                    <div class="event-blog-details" style="margin-top: 30px;">
                                        <h3 class="font-1"  style=" color: #ff4157; font-size: 25px;" ><b>{{ $value->room_number }}</b></h3>
                                        <p><b>Acreage: </b> {{ $value->acreage }}</p>
                                        <p><b>Price: </b>{{ number_format($value->price) . ' / ngày' }}</p>
                                        {{--                        <p><b>Acreage: </b>  {{ $room->	acreage }}</p>--}}
                                    </div>
                                    {{--                                <button class="booking"><a style="color: #fff; font-size: 30px;"> BOOKING </a></button>--}}
                                    <p class="dangnhap"><a href="{{ route('room.show',['id' => $value->id,'time_from' => $time_from, 'time_to' => $time_to])}}" style="color: #ff4157">Detail Room</a></p>
                                    <p>
                                        <a href="{{ route('select-room.index',['id' => $value->id,'time_from' => $time_from, 'time_to' => $time_to]) }}" class="btn btn-primary" style="margin-top: 30px;margin-left: 50px;">Booking room</a>
                                    </p>
{{--                                    <a href="{{ route('booking_detail.create',['time_from' => $time_from, 'time_to' => $time_to]) }}" class="btn btn-success" style="margin-left: 250px; margin-top: 10px;">Booking now</a>--}}

                                </div>
                                {{--                        </div>--}}
                            </div>

                        @endforeach
                    @endif
                    <div class="text-center">
                {{ $room->appends(request()->all())->links() }}

                </div>
            </div>

{{--            <div class="search_booking col-md-4 col-sm-4 col-xs-12" style="width: 460px; height: auto;">--}}
{{--                <h5 style="text-align: center;"><b>BOOKING INFORMATION</b></h5>--}}
{{--                <div>--}}

{{--                    <table class="table">--}}
{{--                        <tr>--}}
{{--                            <th>Room name</th>--}}
{{--                            <th>Time from</th>--}}
{{--                            <th>Time to</th>--}}
{{--                            <th>Price</th>--}}
{{--                            <th>Money</th>--}}
{{--                        </tr>--}}
{{--                        @php--}}
{{--                            $money = 0;--}}
{{--                        @endphp--}}
{{--                    @if(!empty($roomSession))--}}
{{--                            @foreach ($roomSession as $value)--}}
{{--                                @php--}}
{{--                                    $money += ($value->price);--}}
{{--                                @endphp--}}
{{--                                <tr>--}}

{{--                                    <td>{{$value['room_number']}}</td>--}}
{{--                                    <td>{{$time_from}}</td>--}}
{{--                                    <td>{{$time_to}}</td>--}}
{{--                                    <td>{{number_format($value->price)}}</td>--}}
{{--                                    <td>{{number_format($value->price *($total_date + 1))}}</td>--}}
{{--                                </tr>--}}
{{--                        @endforeach--}}
{{--                        @endif--}}
{{--                        <tr >--}}
{{--                            <th colspan="3" class="text-center">TOTAL : </th>--}}
{{--                            <td>{{ number_format($money * ($total_date + 1)) }}</td>--}}
{{--                        </tr>--}}

{{--                    </table>--}}

{{--                </div>--}}

{{--        </div>--}}

    </div>

@endsection
