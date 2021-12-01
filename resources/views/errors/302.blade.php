<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico')}}">

    <title>SleAgro</title>
  
    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css')}}">
      
    <!-- Style-->  
    <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css')}}">   
<style type="text/css">
    .view_parent_image1{
  position: fixed;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background: url({{ asset('backend/images/background.jpg')}}) no-repeat center center fixed;
  background-size: cover;
}

</style>
</head>
<body class="view_parent_image1">
    
    <section class="error-page h-p100 ">
        <div class="container h-p100">
          <div class="row h-p100 align-items-center justify-content-center text-center">
              <div class="col-lg-6 col-md-8 col-12">
                  <div class="b-double border-white rounded30 bg-dark">
                      <h1 class="text-warning font-size-180 font-weight-bold error-page-title"> 302</h1>
                      <h1 class="text-white">Page Not Found !</h1>
                      <h3 class="text-info">looks like, page doesn't exist</h3>
                      <div class="my-30"><a href="{{ route('dashboard') }}" class="btn btn-danger btn-rounded">Back to home</a></div>               
                  </div>
              </div>                
          </div>
        </div>
    </section>


    <!-- Vendor JS -->
    <script src="{{ asset('backend/js/vendors.min.js')}}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js')}}"></script>    


</body>
</html>