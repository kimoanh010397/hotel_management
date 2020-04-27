@extends('layouts.content')

@section('content')
    <div class="container">
        <h1>Customer Details</h1>

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

        @if(empty($customer))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Mail</th>
                </tr>
                <tr>
                    <td>{{ $customer['full_name'] }}</td>
                    <td>{{  $customer['address'] }}</td>
                    <td>{{  $customer['phone'] }}</td>
                    <td>{{  $customer['email'] }}</td>
                </tr>
            </table>

        @endif
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/room.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/room.js') }}"></script>
@endpush
