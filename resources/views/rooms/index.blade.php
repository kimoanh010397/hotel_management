
@extends('layout.content')

@section('content')

    <div id="page">

    <!--end-->
    <section class="image-head-wrapper" style="background-image: url({{asset('images/banner.jpg')}});">
        <div class="inner-wrapper">
            <h1>Rooms</h1>
        </div>
    </section>
    <div class="container">
    <div class="search">
            <div class="form-group">
                <form action="{{ route('search-room.find_rooms')}}" method='get'>
                    <div class='form-search'>
                        <label style="color: white;">Time from *</label>
                        <input type="date" class="form-control" name="time_from" required
                               value="">
                    </div>
                    <div class="form-search">
                        <label style="color: white;">Time to *</label>
                        <input type="date" class="form-control" name="time_to" required
                               value="">
                    </div>

                   <button type="submit" class="book-now-btn text-center" style="margin-top: 20px; margin-left: 100px; float: left;">Check availibity</button>
                </form>
            </div>
        </div>

    <!--gallery block--->
    <section class="gallery-block gallery-front">

            <div class="row" >
                @if(empty($rooms))
                    <p>Not found data</p>
                @else
                    @foreach($rooms as $value)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="gallery-image">
                                <img class="thumb" src="{{ asset('/image_room/' . $value->image)}}">
                                <div class="overlay">
                                    <p><a>Booking</a></p>
                                </div>
                            </div>
                            <p class="room_name" ><a style="color: #CC3300" href="{{ route('room.show', $value->id) }}">{{ $value->room_number }}</a></p><br>
                            <div class="detail_room">
                                <div style="width: 290px; float: left; ">
                                    <p><b>Acreage: </b>{{ $value->acreage }}</p>
                                </div>
                                <div style=" width:50px; float:right; ">
                                    <a href="{{ route('room.show', $value->id) }}">
                                        <p style=" font-size: 15px; color: #ff4157;text-decoration: underline;">Details</p></a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                    <div class="text-center">
                        {{ $rooms->appends(request()->all())->links() }}
                    </div>
                @endif


            </div>

    </section>
    </div>
    <!--back to top--->
    <a style="display: none;" href="javascript:void(0);" class="scrollTop back-to-top" id="back-to-top">
        <span><i aria-hidden="true" class="fa fa-angle-up fa-lg"></i></span>
        <span>Top</span>
    </a>

    </div>
@endsection

