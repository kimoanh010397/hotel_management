@extends('layout.content')

@section('content')
<div id="page">
    <!---header top---->


    <!--end-->
    <div id="myCarousel1" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

{{--        <ol class="carousel-indicators">--}}
{{--            <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>--}}
{{--            <li data-target="#myCarousel1" data-slide-to="1"></li>--}}
{{--            <li data-target="#myCarousel1" data-slide-to="2"></li>--}}
{{--        </ol>--}}

{{--    <div class="container">--}}


        <div class="carousel-inner">{{--bt--}}
            <div class="item active"> <img src="images/banner.png" style="width:100%; height: 550px" alt="First slide">
                <div class="carousel-caption">
{{--                    carousel-caption duyệt các phần tử xoay vòng như một slideshow--}}
                    <h1>vacayhome<br> spa & Resort</h1>
                </div>
            </div>
            <div class="item"> <img src="images/banner2.png" style="width:100%; height: 500px" alt="Second slide">
                <div class="carousel-caption">
                    <h1>vacayhome<br> spa & Resort</h1>
                </div>
            </div>
            <div class="item"> <img src="images/banner3.png" style="width:100%; height: 500px" alt="Third slide">
                <div class="carousel-caption">
                    <h1>vacayhome<br> spa & Resort</h1>
                </div>
            </div>

        </div>
        <a class="left carousel-control" href="#myCarousel1" data-slide="prev"> <img src="images/icons/left-arrow.png" onmouseover="this.src = 'images/icons/left-arrow-hover.png'" onmouseout="this.src = 'images/icons/left-arrow.png'" alt="left"></a>
        <a class="right carousel-control" href="#myCarousel1" data-slide="next"><img src="images/icons/right-arrow.png" onmouseover="this.src = 'images/icons/right-arrow-hover.png'" onmouseout="this.src = 'images/icons/right-arrow.png'" alt="left"></a>

{{--    </div>--}}
    </div>

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
                        <label style="color: white">Time to *</label>
                        <input type="date" class="form-control" name="time_to" required
                               value="">
                    </div>

                   <button type="submit" class="book-now-btn text-center" style="margin-top: 20px; margin-left: 100px; float: left;">Check availibity</button>
                </form>
            </div>
        </div>
    </div>



<!--offer block-->

    <!--End-->

    <!----resort-overview--->
    <section class="resort-overview-block">
{{--        style--}}
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="side-A">
{{--                        <div class="product-thumb">--}}
                            <div class="image">
                                <a><img src="images/category1.png" class="img-responsive" alt="image"></a>
                            </div>
{{--                        </div>--}}
                    </div>
                    <div class="side-B">
                        <div class="product-desc-side">
                            <h3>luxury spa</h3>
                            <p>Various methods, outstanding organic products and a delightful boutique give Furama Spa its reputation for excellence.  Whenever your idea of spa travel means a long soak in the bath or escaping to a luxury spa destination, Spa is your best choice in healthy living and renewal.</p>
                        </div>
                    </div>
                </div>
{{--                <div class="clear"></div>--}}
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="side-A">
{{--                        <div class="product-thumb">--}}
                            <div class="image">
                                <a><img alt="image" class="img-responsive" src="images/category2.png"></a>
                            </div>
{{--                        </div>--}}
                    </div>
                    <div class="side-B">
                        <div class="product-desc-side">
                            <h3>Selective cuisine</h3>
                            <p>After hours of visiting the scenery, swimming in Da Nang, the charming dishes of the people here will help you fully satisfied with your trip. If you are still wondering what to eat in Da Nang, let us review the interesting dishes and culinary features of Danang that you should not miss when you come to this wonderful city.</p>
                        </div>
                    </div>
                </div>
                <div class="clear" ></div>
                <div class="col-md-6 col-sm-12 col-xs-12 ">
                    <div class="side-A">
                        <div class="product-desc-side">
                            <h3>luxury room</h3>
                            <p>All 198 rooms & suites have polished timber floors, natural fabrics, comfortable cane furniture, plantation style shutters and ceiling fans. Each room also has its own balcony or spacious terrace providing complete privacy and with a superb view of the ocean, the tropical garden or the freshwater swimming lagoon pool.</p>
                        </div>
                    </div>

                    <div class="side-B">
{{--                        <div class="product-thumb">--}}
                            <div class="image txt-rgt">
                                <a class="arrow-left"><img src="images/category3.png" class="img-responsive" alt="imaga"></a>
                            </div>
{{--                        </div>--}}
                    </div>
                </div>
                <div class="clear"></div>
                <div class="col-md-6 col-sm-12 col-xs-12 remove-padd-left">
                    <div class="side-A">
                        <div class="product-desc-side">
                            <h3>Relaxing space</h3>
                            <p>Resort is a place to awaken your senses, engage your mind, emerge big ideas and also grow your imagination. Our conference and meeting rooms have seen and hosted many international congress, conventions and special banquets that link between thinkers in business, government and uniquely tailored event to suit every need…</p>
                        </div>
                    </div>

                    <div class="side-B">
{{--                        <div class="product-thumb txt-rgt">--}}
                            <div class="image">
                                <a class="arrow-left"><img src="images/category4.png" class="img-responsive" alt="imaga"></a>
                            </div>
{{--                        </div>--}}
                    </div>
                </div>
                <div class="clearfix"></div>

            </div>
        </div>
    </section>


<!---blog block--->
    <section class="blog-block">
        <div class="container">
            <div class="row ">
{{--                <div class="view-set-block">--}}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="event-blog-image">
                            <img alt="image" class="img-responsive" src="images/blog1.jpg">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 side-in-image">
                        <div class="event-blog-details">
                            <h3 class="font-1"><a href=""><b style="color: #c01b21;">THIS  WORLD  CLASS  RESORT</b></a></h3>
                            <p>Overlooking the long stretch of wide white sand on Danang Beach, Furama Resort Danang is a gateway to three World Heritage Sites of Hoi An (20 minutes), My Son (90 minutes) and Hue (2 hours). The 198 rooms and suites plus 70 two to four bedroom pool villas feature tasteful décor, designed with traditional Vietnamese style and a touch of French colonial architecture and guarantee the Vietnam’s the most prestigious resort -counting royalty, presidents, movie stars and international business leaders among its celebrity guests.</p>
                        </div>
                    </div>
{{--                </div>--}}
            </div>
            <div class="row offspace-45">
                <div class="view-set-block">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="event-blog-image">
                            <img alt="image" class="img-responsive" src="images/blog2.jpg">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="event-blog-details">
                            <h3 class="font-1"><a href=""><b style="color: #c01b21;">RECRETION</b></a></h3>
                            <p>A full range of Water Sports will keep you busy. Stop by the Water Sport House where our experienced staff are waiting to assist or train you in the use of any of our equipment.</p>

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

</div>

@endsection

