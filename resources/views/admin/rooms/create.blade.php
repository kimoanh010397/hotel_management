@extends('admin.layout.content');
@section('content')
    <div class='container'>
        <div class="text-center">
            <h1 class="fa">Create New Room</h1>
        </div>



        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.room.store')}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class='form-group'>
                <label>Room Number</label>
                <input type="text" class='form-control' name='number'>
            </div>

            <div class='form-group'>
                <label>Description</label>
                <input type="text" class='form-control' name='description'>
            </div>

            <div class='form-group'>
                <label>Price</label>
                <input type="text" class='form-control' name='price'>
            </div>

            <div class='form-group'>
                <label>Image</label>
                <input type="file" class='form-control' name='image'>
            </div>

            <div class='form-group'>
                <button type="submit" class="btn btn-info float-left"><i class="fas fa-plus"></i> Create</button>
            </div>
        </form>
    </div>
@endsection
