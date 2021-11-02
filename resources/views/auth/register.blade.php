<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico')}}">

    <title>Sl e-Agro Registration</title>
  
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
    
    <div class="container h-p100">
        <div class="row align-items-center justify-content-md-center h-p100">
            
            <div class="col-12">
                <div class="row justify-content-center no-gutters">
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="content-top-agile p-10 rounded30 b-2 b-dashed bg-dark">
                            <h1 class="text-warning" style="font-family: 'Times New Roman, Times, serif'">SL e-Agro</h1>
                            <b><h4 class="text-white">Agriculutural Product Disrtibution Management System</h4></b>                        
                        </div>
                        <div class="p-30 rounded30 box-shadowed b-2 b-dashed bg-dark">
                            <form method="POST" action="{{ route('register') }}">
                            @csrf
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" id="name" name="name" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Full Name" value="{{old('name')}}">

                                    </div>
                                    <span class="text-warning">@error('name'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-white"><i class="ti-email"></i></span>
                                        </div>
                                        <input type="email" id="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Email" value="{{old('email')}}">
                                    </div>
                                    <span class="text-warning">@error('email'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" id="password" name="password"class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-white"><i class="ti-lock"></i></span>
                                        </div>
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Retype Password">
                                    </div>
                                    <span class="text-warning">@error('password'){{$message}}@enderror</span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                                        </div>
                                    
                                        <select name="role" id="role" class="form-control pl-15 bg-transparent text-white">
                                           <option value="" class="bg-dark" disabled="" selected="">Select User Type</option>
                                           <option {{ old('role') == "Farmer" ? "selected" : "" }} value="Farmer" class="bg-dark">Farmer Account</option>
                                            <option {{ old('role') == "Buyer" ? "selected" : "" }} value="Buyer" class="bg-dark">Buyer Account</option>
                                            <option {{ old('role') == "Farmer-Buyer" ? "selected" : "" }} value="Farmer-Buyer" class="bg-dark">Farmer & Buyer Multi Account</option>

                                           </select>
                                        
                                    </div>
                                    <span class="text-warning">@error('role'){{$message}}@enderror</span>
                                </div>
                                  <div class="row">
                                    <div class="col-12">
                                      <div class="checkbox text-white">
                                        <input type="checkbox" >
                                        <label for="basic_checkbox_1">I agree to the <a href="#" class="text-warning"><b>Terms & condition</b></a></label>
                                      </div>
                                      <span class="text-danger">@error('terms'){{$message}}@enderror</span>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-12 text-center">
                                      <button type="submit" class="btn btn-info btn-rounded margin-top-10">Register</button>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                            </form>                                                 

{{--                             <div class="text-center text-white">
                              <p class="mt-20">- Register With -</p>
                              <p class="gap-items-2 mb-20">
                                  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>
                                  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>
                                  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>
                                  <a class="btn btn-social-icon btn-round btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>
                                </p>    
                            </div> --}}

                            <div class="text-center">
                                <p class="mt-15 mb-0 text-white">Already have an account?<a href="{{ route('login')}}" class="text-warning ml-5"> Login</a></p>
                                <p class="mt-15 mb-0 text-white">Go to home page? <a href="{{ route('home') }}" class="text-warning ml-5">Home</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>


    <!-- Vendor JS -->
    <script src="{{ asset('backend/js/vendors.min.js')}}"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js')}}"></script>    
    
    
</body>
</html>