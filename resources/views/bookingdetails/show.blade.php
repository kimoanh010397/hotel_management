@extends('layout.content')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Booking Details</h1>
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

        <div class="text-center">
           <h3>{{ $name }}</h3>
        </div>
        @if(empty($bookingDetail))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
{{--                    <th>ID</th>--}}
                    <th>Time From</th>
                    <th>Time To</th>
                    <th>Room Number</th>
                </tr>
                @foreach($bookingDetail as $value)
                    <tr>
{{--                        <td>{{ $value->id }}</td>--}}
                        <td>{{ $value->time_from }}</td>
                        <td>{{ $value->time_to }}</td>
                        <td>{{ $value->room->room_number }}</td>
                    </tr>
                @endforeach

            </table>
{{--            <div class='form-group'>--}}
{{--                <a href="{{ route('booking.index') }}" class='btn btn-dark'>Back</a>--}}
{{--            </div>--}}
            <div class="text-center">
                {{ $bookingDetail->appends(request()->all())->links() }}
            </div>
        @endif
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/room.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/room.js') }}"></script>
@endpush
