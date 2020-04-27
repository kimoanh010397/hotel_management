@extends('admin.layout.content')

@section('content')
    <div class="container">
        <div class="form-group text-center">
            <h1 class="fa">Report By Room</h1>
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
            <form action="{{ route('admin.room.report') }}">
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
            <h1 style="text-align: center;font-size: 22px;margin: 10px 20px 30px 20px;"><b>Report Room</b></h1>
        @endif
        @if(empty($from))
            <p>Not found data</p>
        @else
            <table class="text-center table table-bordered table-striped">
                <tr class="table-success">
                    <th>Room</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>User Time(day)</th>
                    <th>Customer</th>
                    <th>Money (VND)</th>
                </tr>
                @for($i = 0;$i < count($roomName); $i++)
                    <tr class="table-info">
                        <td>{{$roomName[$i]}}</td>
                    </tr>
                    @foreach($from[$i] as $key => $value)
                        <tr class="table-info">
                            <td></td>
                            <td>{{ $from[$i][$key] }}</td>
                            <td>{{ $to[$i][$key] }}</td>
                            <td>{{ $usedTime[$i][$key] }}</td>
                            <td>{{ $customer[$i][$key] }}</td>

                            <td>{{ number_format($money[$i][$key]) }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-danger">
                        <th colspan="5">Total Money (VND) </th>
                        <td >{{ number_format($totalMoney[$i]) }}</td>
                    </tr>
                @endfor

            </table>

        @endif
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/room.css') }}">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/room.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush
