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
    <link rel="stylesheet" href="{{asset('css/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsiveAdmin.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datatables-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
    
    <style>.pagination .page-item.active .page-link{background:#ff3547!important }</style>
</head>
<body class="fix-header fix-sidebar">



@include('admin.layout.menu')



@yield('content')



</div>
</div>
<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>

<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/sidebarmenu.js')}}"></script>
<script src="{{asset('js/sticky-kit.min.js')}}"></script>
<script src="{{asset('js/custom.min-2.js')}}"></script>
<script src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{asset('js/datatables-select.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
<script src="{{asset('js/custom_admin.js')}}"></script>

<script>


const notifier = ()=>{
    Swal.fire({
        title: 'Do you want to Log out?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText:'No',
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            axios.post("{{url('/admin/logout')}}")
            .then(function(response){
                if(response.status ==200){
                    window.location.href="{{url('/admin/login')}}";
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Logout failed!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
            .catch(response=>{
                Swal.fire({
                    icon: 'error',
                    title: 'Logout failed!!',
                    showConfirmButton: false,
                    timer: 1500
                })
            })
        }
    })
}


$("#logout").on('click',function(event){
    event.preventDefault();
    notifier();

})

</script>
</body>
</html>