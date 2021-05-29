<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="{{asset('js/sweetalert2@11.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">

    
</head>
<body>




<div class="container">
	<div class="col-md-5 offset-md-3">
		@yield('content')
	</div>
</div>



</div>
</div>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>

@yield('script')


</body>
</html>