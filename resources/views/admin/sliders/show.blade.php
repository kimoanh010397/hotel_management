@extends('admin.layout.content')

@section('content')
    <div class="container">
        <h1>Room Slider</h1>

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
        @if(empty($room))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Room Number</th>
                    <th>Image</th>
                    <th colspan="3">Action</th>
                </tr>
                <tr>
                    <td>{{ $room->id}}</td>
                    <td>{{ $room->room_number }}</td>
                    <td><img src="{{ asset('/image_room/' . $room->image)}}" alt="{{$room->image}}" width="150px" height="150px"></td>
                    <td><a href="{{ route('admin.slider.create', $room->id) }}" class="btn btn-success">Add Slider</a></td>
                    <td><a href="{{ route('admin.slider.edit', $room->id) }}" class="btn btn-primary">Edit Slider</a></td>
                    <td>
                        <form action="{{ route('admin.slider.destroy', $room->id) }}" method="post">
                            @csrf
                            <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">Delete</button>
                        </form>
                    </td>
                </tr>
            </table>
{{--            <div class="text-center">--}}
{{--                {{ $room->appends(request()->all())->links() }}--}}
{{--            </div>--}}
        @endif
    </div>

@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/room.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/room.js') }}"></script>
@endpush

