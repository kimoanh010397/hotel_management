@extends('admin.layout.content')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="fa">Customer List</h1>
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

        @if(empty($customers))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr class="table-success">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Mail</th>
                </tr>
                @foreach($customers as $value)
                    <tr class="table-info">
                        <td>{{ $value->id}}</td>
                        <td>{{ $value->full_name }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->email }}</td>
                    </tr>
                @endforeach
            </table>

            {{--            paginate--}}

            <div class="text-center">
                {{ $customers->appends(request()->all())->links() }}
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
