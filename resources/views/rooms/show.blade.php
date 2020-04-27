@extends('layout.content')

@section('content')
    <div id="page">

<div class="container">
            <div class="row offspace-45">
                <div class="view-set-block">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="event-blog-image">
                            <img alt="image" style="height: 380px; width: 560px; border-radius: 10px;" src="{{ asset('/image_room/' . $room->image)}}" alt="{{$room->image}}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-7 col-xs-12 side-in-image">
                        <div class="event-blog-details">
                            <h3 class="font-1" style=" color: #ff4157; font-size: 30px; " >{{ $room->room_number }}</h3>
                            <p><b>Price: </b>{{ number_format($room->price) . ' / day' }}</p>
                            {{--                        <p><b>Acreage: </b>  {{ $room->	acreage }}</p>--}}
                            <p><b>Capacity:</b>The majority of 2 adults and 1 child</p>
                            <p>{{$room->description}}</p>
                        </div>
{{--                        <button class="booking"><a style="color: #fff; font-size: 30px;"> BOOKING </a></button>--}}
                    </div>
                </div>
            </div>


    <div class="col-md-6 col-sm-12 col-xs-12 ">
        <div class="contact-form" style="margin-top: 30px;">
            <h3>Com<span>ment</span></h3>
            @if (count($errors) >0)
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-danger"> {{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (session('status'))
                <ul>
                    <li class="text-danger"> {{ session('status') }}</li>
                </ul>
            @endif
            <form action="{{route('comment.comment',['id' => $room->id])}}" method="post">
                @csrf
                <div class="col-md-10  col-xs-12 ">
                    <textarea class="form-control" name="content" placeholder="Message Here...." required=""></textarea>
                </div>

                <div><button class="btn btn-primary" style="margin-top: 50px; margin-left:30px;">Send</button></div>

            </form>
        </div>

        @if(!empty($comment))
            @foreach($comment as $value)
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                    <div class="col-md-2 col-sm-12 col-xs-12">
                        <img style="width: 45px; height: 45px;" src="{{ asset('/images/icons/avatar.png')}}">
                    </div>
                    <div style="float: left;" >
                    <p><b>{{$value->customer->full_name}}<b></p>
                    <p style="font-size:12px; margin-top:8px;">{{ $value->content }}</p>

                    </div>
                </div>

            @endforeach
        @endif

{{--                    <div class="form-group">--}}
{{--                        <label>Content</label>--}}
{{--                        <textarea id="summernote" name="content" rows="5" class="form-control" ></textarea>--}}
{{--                    </div>--}}



            </div>


            <div class="col-md-6 col-sm-7">
                <section class="service-block" style=" margin-top: 60px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 ">
                                <div class="service-details text-center">
                                    <div class="service-image">
                                        <img alt="image" class="img-responsive" src="{{ asset('images/icons/key.png') }}">
                                    </div>
                                    <h4><a>free wifi</a></h4>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-1 col-xs-6 ">
                                <div class="service-details text-center">
                                    <div class="service-image">
                                        <img alt="image" class="img-responsive" src="{{ asset('images/icons/wifi.png') }}">
                                    </div>
                                    <h4><a>room service</a></h4>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-6 ">
                                <div class="service-details text-center">
                                    <div class="service-image">
                                        <img alt="image" class="img-responsive" src="{{ asset('images/icons/car.png') }}">
                                    </div>
                                    <h4><a>free parking</a></h4>
                                </div>
                            </div>
{{--                            <div class="col-md-2 col-sm-2 col-xs-6 ">--}}
{{--                                <div class="service-details text-center">--}}
{{--                                    <div class="service-image">--}}
{{--                                        <img alt="image" class="img-responsive" src="{{ asset('images/icons/user.png') }}">--}}
{{--                                    </div>--}}
{{--                                    <h4><a>customer support</a></h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </section>
            </div>
</div>


        </div>
{{--<script >--}}
{{--    $(document).ready(function () {--}}
{{--    $('#send_comment').click(function () {--}}
{{--        var content = $('#content').val();--}}
{{--        var id = "{{$room->id}}";--}}

{{--        var data = {id :id,--}}
{{--                    content:content,--}}
{{--                    _token:"{{csrf_token()}}",--}}
{{--        };--}}
{{--        $.ajax({--}}
{{--            url:"{{route('comment.storeCommentAjax')}}",--}}
{{--            type:"POST",--}}
{{--            data:data,--}}
{{--            success:function(data){--}}
{{--               alert('Them thanh cong')--}}

{{--            },--}}
{{--            error:function(){--}}
{{--                alert('Them that bai')--}}
{{--            }--}}
{{--        })--}}
{{--    })--}}
{{--    });--}}
{{--</script>--}}





    <!--back to top--->
    <a style="display: none;" href="javascript:void(0);" class="scrollTop back-to-top" id="back-to-top">
        <span><i aria-hidden="true" class="fa fa-angle-up fa-lg"></i></span>
        <span>Top</span>
    </a>

@endsection
