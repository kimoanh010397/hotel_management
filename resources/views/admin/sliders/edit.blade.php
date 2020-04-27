@extends('admin.layout.content')
@section('content')
    <div class='container'>
        <h1>Slider Room Edit</h1>

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

        {{--        kiểm tra lỗi không thỏa điều kiện validate--}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

{{--        <form action="{{ route('slider.store') }}" method='post' enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <div class="form-group">--}}
{{--                <label>Room Number</label>--}}
{{--                @if(!empty($room))--}}
{{--                    <select name="room_id" class="form-control">--}}
{{--                        <option value="{{$room->id}}">{{$room->room_number}}</option>--}}
{{--                    </select>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class='form-group'>--}}
{{--                <label>Image</label>--}}
{{--                <input type="file" class='form-control' name='images[]' multiple>--}}
{{--            </div>--}}
{{--        <form action="{{ route('slider.show',$room->id) }}" method='get' >--}}

            <div class='form-group'>
                <label>Room Number</label>
                <input type="text" class='form-control' name='room_id' value="{{$room->room_number}}">
            </div>

            @if(!empty(count($slider)))
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Image</th>
                        <th>File name</th>
{{--                        <th>Room Number</th>--}}
                        <th colspan="2">Action</th>
                    </tr>

                    @foreach($slider as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td><img src="{{ asset('/slide_room/' . $value->filename)}}" alt="{{ $value->filename}}}" width="150px" height="150px"></td>
                            <td>{{ $value->filename}}</td>
                            <td>
                                <form action="{{ route('admin.slider.destroyimg',$value->id) }}" method="post">
                                    @csrf
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </table>
            @endif


{{--            <div class='form-group'>--}}
{{--                <button type='submit' class='btn btn-primary'>Update</button>--}}
{{--            </div>--}}
        <a href="{{ route('admin.slider.show',$room->id) }}" class='btn btn-primary'>Update</a>
{{--        </form>--}}
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/room.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/admin/room.js') }}"></script>
@endpush
