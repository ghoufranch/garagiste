<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage Shop</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    
    <link rel="stylesheet" href="{{asset('user-assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('user-assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('user-assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{asset('user-assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('user-assets/css/style.min.css')}}">
    
    <!-- icheck bootstrap -->
    
    <!-- Theme style -->
    
</head>
<body>
    <div class="container-fluid text-center">
        @yield('content')
    </div>

 
   

  
    <script src="{{ asset('user-assets/js/jquery-3.6.0.min.js') }}"></script>
    @yield('customJs')
    <script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
   

    
    <script src="{{ asset('user-assets/js/slick.min.js') }}"></script>
    
    
</body>
</html>
