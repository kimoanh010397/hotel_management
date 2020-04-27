
@extends('layout.content')

@section('content')

    {{--<div id="page">--}}

    <!--end-->
    <section class="image-head-wrapper" style=" background-image: url({{asset('/images/hoinghi.jpg')}});">
        <div class="inner-wrapper">
            <h1>Conferences</h1>
        </div>
    </section>


    <!--gallery block--->
    <div class="font-1">
        <h1 style="text-align:center; font-size: 100px; color: #761c19">Conferences</h1><br>
    </div>
    <div class="container">
        <div class="note">
            <p>International Convention Palace (ICP) with a large conference room accommodating up to 1,000 guests and more than 10 auxiliary function rooms ranging from 50 to 300 guests equipped with modern facilities, equipment, is an ideal venue for MICE delegations to organize conferences, seminars and events.</p><br><br>
            <p>The outdoor space on the beach or on the Lagoon Lake in the middle of a dense jungle, filled with air, water and light can fly with every creative idea of ​​unique themed parties or team-building activities. inspire or engage the community. The heliport is located right on the beach, along with two adjacent 18-hole golf courses, with culinary services, spa, entertainment combined with high-class resorts providing more choices for organizers and guests. corporate goods affirmed its position, leaving a good impression in the hearts of partners and customers.</p>
        </div>
    </div>
    <section class="blog-block">
        <div class="container">
            <div class="row offspace-45">
                <div class="view-set-block">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="event-blog-image">
                            <img alt="image" style="width: 550px;height: 300px;" src="{{asset('images/hoinghi2.jpg')}}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 side-in-image">
                        <div class="event-blog-details">
                            <h3 class="font-1"><a href=""><b style="color: #c01b21;">THIS  WORLD  CLASS  RESORT</b></a></h3>
                            <p>Overlooking the long stretch of wide white sand on Danang Beach, Furama Resort Danang is a gateway to three World Heritage Sites of Hoi An (20 minutes), My Son (90 minutes) and Hue (2 hours). The 198 rooms and suites plus 70 two to four bedroom pool villas feature tasteful décor, designed with traditional Vietnamese style and a touch of French colonial architecture and guarantee the Vietnam’s the most prestigious resort -counting royalty, presidents, movie stars and international business leaders among its celebrity guests.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!--back to top--->
    <a style="display: none;" href="javascript:void(0);" class="scrollTop back-to-top" id="back-to-top">
        <span><i aria-hidden="true" class="fa fa-angle-up fa-lg"></i></span>
        <span>Top</span>
    </a>

    {{--</div>--}}
@endsection


