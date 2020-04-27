@extends('layouts.content')

@section('content')
    <div class="container">
        <h1>List Booking</h1>

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

        @if(empty($booking))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th colspan='2'>Action</th>
                </tr>
                @foreach($booking as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->customer->full_name }}</td>
                        <td><a href="{{ route('booking_detail.show',$value->id)}}" class="btn btn-success">Detail Booking</a></td>
{{--                        <td>--}}
{{--                            <form action="{{ route('booking_detail.destroy',$value->id)}}" method='post'>--}}
{{--                                @csrf--}}
{{--                                <button type='button' class="btn btn-danger" onclick="confirmDelete(this)">Delete</button>--}}
{{--                            </form>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach

            </table>
            <div class="text-center">
                {{ $booking->appends(request()->all())->links() }}
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
