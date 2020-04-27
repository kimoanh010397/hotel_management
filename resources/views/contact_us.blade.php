@extends('layout.content')

@section('content')

    <!--end-->
    <section class="image-head-wrapper" style="background-image: url({{asset('images/banner4.jpg')}});">
        <div class="inner-wrapper">
            <h1>Contact Us</h1>
        </div>
    </section>
    <div class="clearfix"></div>


    <section class="contact-block">
        <div class="container">
            <div class="col-md-6 contact-left-block">
                <h3><span>Contact </span>Us</h3>
                <p class="text-left">Nulla pharetra eleifend tellus in molestie. In vel neque sit amet urna gravida blandit nec id massa. Phasellus eu aliquet augue. Quisque fringilla urna quam.</p>
                <p class="text-right">92 Quang Trung, Da nang <i class="fa fa-map-marker fa-lg"></i></p>
                <p class="text-right"><a href=""> 0236 3888 279 <i class="fa fa-phone fa-lg"></i></a></p>
                <p class="text-right"><a href=""> contact@ivitech.com <i class="fa fa-envelope"></i></a></p>
            </div>
            <div class="col-md-6 contact-form">
                <h3>Send a <span>Message</span></h3>
                <form action="#" method="post">
                    <input type="text" class="form-control" name="Name" placeholder="Name" required="">
                    <input type="email" class="form-control" name="Email" placeholder="Email" required="">
                    <textarea class="form-control" name="Message" placeholder="Message Here...." required=""></textarea>
                    <input type="submit" class="submit-btn" value="Submit">
                </form>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    <br><br>

    <!---map--->
    <section class="offspace-70">
        <div class="map">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61345.633134674754!2d108.17686128204154!3d16.060192237562692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219b5c59ecec1%3A0xfd2900156004319!2zSOG6o2kgQ2jDonUsIMSQw6AgTuG6tW5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1584929140248!5m2!1svi!2s" width="1150" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </section>
    <!---footer--->
    <

    <!--back to top--->
    <a style="display: none;" href="javascript:void(0);" class="scrollTop back-to-top" id="back-to-top">
        <span><i aria-hidden="true" class="fa fa-angle-up fa-lg"></i></span>
        <span>Top</span>
    </a>
@endsection

