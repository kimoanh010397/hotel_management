<div class="top-header">
    <div class="container">
        <div class="row">
                <div class="social-grid">
                    <ul class="list-unstyled text-right">
                        <li><a><i class="fa fa-facebook"></i></a></li>
                        <li><a><i class="fa fa-twitter"></i></a></li>
                        <li><a><i class="fa fa-instagram"></i></a></li>
                        @if (!Illuminate\Support\Facades\Auth::guard('customer')->check())
                        <li class="dropdown">
                            <a class="fa btn btn-secondary" data-toggle="dropdown" >Member</a>

                            <div class="dropdown-menu" >
                                <a class="fa " href="{{ route('show-login') }}" style="color:blue; margin:10px 20px;  ">Sign In</a><br>
                                <a class="fa" href="{{ route('customer.create') }}" style="color:blue; margin:10px 20px;">Sign Up</a><br>
                            </div>
                        </li>
                        @else
                            <li class="dropdown">
                                <a class="fa btn btn-secondary" data-toggle="dropdown" > Welcome : {{ Illuminate\Support\Facades\Auth::guard('customer')->user()->full_name }}</a>

                                <div class="dropdown-menu">
                                    <a class="fa" href="{{ route('customer.edit') }}" style="color:blue; margin:10px 20px;">Change password</a><br>
                                    <a class="fa" href="{{ route('logout') }}" style="color:blue; margin:10px 20px;">Log out</a>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
        </div>
    </div>
</div>
<!--header--->

    <div class="container">
        <div class="top-row">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div id="logo">
                        <a href="{{ route('home') }}"><span class="font-1" style="font-size: 70px;">vacay</span>home</a>
                    </div>
                </div>
                <div class="col-md-7 col-sm-10 col-xs-12">
                    <nav class="nav navbar-default">
{{--                        <div class="navbar-header page-scroll">--}}
{{--                            <button data-target=".navbar-ex1-collapse" data-toggle="collapse" class="navbar-toggle" type="button">--}}
{{--                                <span class="sr-only">Toggle navigation</span>--}}
{{--                                <span class="icon-bar"></span>--}}
{{--                                <span class="icon-bar"></span>--}}
{{--                                <span class="icon-bar"></span>--}}
{{--                            </button>--}}

{{--                        </div>--}}
                        <div class="collapse navigation navbar-collapse remove-space">
                            <ul class="list-unstyled nav1 cl-effect-10">
                                <li><a  data-hover="Home" href="{{route('home')}}" class="active"><span>Home</span></a></li>
                                <li><a data-hover="Cuisine"  href="{{route('total.cuisine')}}"><span>Cuisine</span></a></li>
                                <li><a data-hover="Rooms"  href="{{ route('room.index') }}"><span>Rooms</span></a></li>
                                <li><a data-hover="Conferences"  href="{{route('total.conferences')}}"><span>Conferences</span></a></li>
                                <li><a data-hover="Spa" href="{{route('total.spa')}}"><span>Spa</span></a></li>
                                <li><a data-hover="Contact Us" href="{{route('total.contact_us')}}"><span>contact Us</span></a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

