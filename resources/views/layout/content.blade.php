<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('images/icons/favicon.png')}}"/>
    <title>vacayhome</title>
    @include('layout.css')
    @include('layout.js')

</head>
<body style="">
<!--start-home-->
@include('layout.header')
@yield('content')
@include('layout.footer')
</body>
</html>
