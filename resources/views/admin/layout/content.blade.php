<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('admin.layout.css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <!-- Main Sidebar Container -->
        @include('admin.layout.header')
        @yield('content')
{{--        @include('admin.layout.footer')--}}
        @include('admin.layout.js')
    </div>

</body>
</html>
