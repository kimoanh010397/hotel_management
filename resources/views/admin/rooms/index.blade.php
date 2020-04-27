@extends('admin.layout.content')

@section('content')
    <div class="container">
        <div class="form-group text-center">
            <h1 class="fa">List all rooms</h1>
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

        @if(empty($rooms))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr class="table-success">
                    <th>ID</th>
                    <th>Number</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th colspan="4">Action</th>
                </tr>

                @foreach($rooms as $value)
                    <tr class="table-info">
                        <td>{{ $value->id}}</td>
                        <td>{{ $value->room_number }}</td>
                        <td>{{ $value->description }}</td>
                        <td>{{ ($value->status == 0) ? 'sử dụng' : 'hỏng' }}</td>
                        <td>{{ number_format($value->price) . ' / ngày' }}</td>
                        <td><img onclick="MymodalImage(this);" src="{{ asset('/image_room/' . $value->image)}}" alt="{{$value->image}}" width="150px" height="150px"></td>
                        <td>
                            <a href="{{ route('admin.room.show', $value->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-folder">
                                </i>
                                Detail
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.room.edit', $value->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.room.destroy', $value->id) }}" method="post">
                                @csrf
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this)">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.slider.show',$value->id) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-folder">
                                </i>
                                Slider
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="text-center">
                {{ $rooms->appends(request()->all())->links() }}
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

