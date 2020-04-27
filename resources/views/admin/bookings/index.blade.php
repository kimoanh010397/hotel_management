@extends('admin.layout.content')

@section('content')
    <div class="container">
        <div class="form-group text-center">
            <h1 class="fa">List Booking</h1>
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

        @if(empty($booking))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr class="table-success">
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th colspan='2'>Action</th>
                </tr>
                @foreach($booking as $value)
                    <tr class="table-info">
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->customer->full_name }}</td>
                        <td class="project-actions text-left">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.booking_detail.show',$value->id)}}">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                        </td>

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
    <link rel="stylesheet" href="{{ asset('assets/admin/room.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/room.js') }}"></script>
@endpush
