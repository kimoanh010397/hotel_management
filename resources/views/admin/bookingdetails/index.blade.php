@extends('admin.layout.content')

@section('content')
    <div class="container">
        <div class="form-group text-center">
            <h1 class="fa">List Booking Details</h1>
        </div>


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

        <div class="form-group">
            <form action="{{ route('admin.booking_detail.index') }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Time From</label>
                            <input type="date" class="form-control" name="from" value="{{ old('from',$time_from)}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Time To</label>
                            <input type="date" class="form-control" name="to" value="{{ old('to',$time_to) }}">
                        </div>
                    </div>
                </div>
                <input type="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
        @if(!empty($chart1))
            <div class="flex pt-8">
                {!! $chart1->container() !!}
                {!! $chart1->script() !!}
            </div>
            <h1 style="text-align: center;font-size: 22px;margin: 10px 20px 30px 20px;"><b>Report Booking</b></h1>
        @endif

        @if(empty($bookingDetail))
                <p>Not found data</p>
        @else
            <table class="text-center table table-bordered table-striped">
                <tr class="table-success">
                    <th>ID</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Customer</th>
                    <th>Room Number</th>
                    <th>Money (VND)</th>
                </tr>

                @foreach($bookingDetail as $key => $value)
                    <tr class="table-info">
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->time_from }}</td>
                        <td>{{ $value->time_to }}</td>
                        <td>{{ $customer_name[$key] }}</td>
                        <td>{{ $value->room->room_number }}</td>
                        <td>{{ number_format($money[$key]) }}</td>
                    </tr>
                @endforeach
                <tr class="table-danger">
                    <th colspan="5">Total Money (VND) </th>
                    <td >{{ number_format($moneytotal) }}</td>
                </tr>
            </table>
            <div class="text-center">
                {{ $bookingDetail->appends(request()->all())->links() }}
            </div>
        @endif
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/room.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/room.js') }}"></script>
@endpush
