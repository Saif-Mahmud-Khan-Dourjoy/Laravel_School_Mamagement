<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin')}}/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin')}}/img/favicon-final.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>Gulesta Hafiz Memorial Institute </title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet"/>
    
    

    <!-- for jQuery     -->
    <script src="{{asset('admin/js/jquery.min.js')}}" type="text/javascript"></script>
    
    <script type="text/javascript" src="{{asset('plugins/js/jquery.toaster.js')}}"></script>
    <!-- Animation library for notifications   -->
    <link href="{{asset('admin/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('admin/css/paper-dashboard.css')}}" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('admin/css/themify-icons.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/datatables.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/css/datetimepicker.min.css') }}">

    <!--  Multiple select     -->

    <!--  style.css --> 
    <link href="{{asset('admin')}}/css/style.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script type="text/javascript" src="<?php echo url('/');?>/js/jsUtlt.js"></script>
    <script>
        jsUtlt["siteUrl"] = function(addr){
            addr = typeof addr != "undefined" ? addr : "";
            return "<?php echo url('/');?>"+addr;
        };
    </script>

    <style>
        .navbar-new-bottom{
            background-color: #f7f7f7;
            box-shadow: 0 5px 6px -2px rgba(0,0,0,.3);
            border-top: 1px solid #e0e0e0;
        }
     
        #slideshow > div { 
            position: absolute; 
            top: 10px; 
            left: 10px; 
            right: 10px; 
            bottom: 10px; 
        }
        
        .icon{
            font-size: 30px;
            color:#0000FF;
        }
        .title{
            color: #00008B;
        }
        
        .slider-section{
            margin: 0 auto;
            text-align: center;
            width:100%;
        }
        .mySlides{
            margin: 0 auto;
            text-align: center;
        }
        .slider-container{
            margin: 0 auto;
            text-align: center;

        }
        .hr-title{
            border-top: 1px solid blue;
        }
        .rounded{
            border-radius: 50%;
        }
        .text-section{
            text-align: justify;
            text-justify: inter-word;
        }
        
    </style>

</head>

<body>
    <nav class="navbar navbar-new-bottom">
        <div class="row">
            <div class="col-md-12">
                <a href="/" class="navbar-brand"><img src="#" alt=""/>Gulesta Hafiz Memorial Institute</a>

                @if (Route::has('login'))
                    <div class="text-right">
                        @auth
                        <a class="btn" href="{{ url('/home') }}">Home</a>
                        @else
                        <a class="btn" href="{{ route('login') }}">Login</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    
<div class="container">
    <!-- ======= Slider Section ======= -->
    <div class="row text-center title">
        <h3>Welcome To <span>Gulesta Hafiz Memorial Institute</span><span>(School and College)</span></h3>
    </div>
    <div class="slider-section row pt-4">
        <div class="text-center slider-container" style="max-width:800px">
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/O9olhgBddDLgVgxogDO9pVxXpz8xCXmO3MTtgm3e.jpeg" style="width:100%">
                <h3 class="pt-1">???????????? ???????????????????????????</h3>
            </div>
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/AtBMAfKKuPKaHuKtAqr22RiIBdDCbTUw1ITyg1lT.jpeg" style="width:100%">
                <h3 class="pt-1">?????????????????????????????? ?????????????????? ?????????</h3>
            </div>
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/OjYrQkFeQ4WXQK1gOx5pFcAdkgmIYYW9PHa8fIfA.jpeg" style="width:100%">
                <h3 class="pt-1">?????????????????? ??????????????????????????????</h3>
            </div>
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/XrkL0WTWHS7PqWFkxkuErporhpOVw6ZaODY5fdwU.jpeg" style="width:100%">
                <h3 class="pt-1">?????????????????? ?????????????????? ??????????????????????????????</h3>
            </div>
        </div>
    </div>
    <!-- ======= End Slider Section ======= -->
        <h3 class="pt-3 text-center title">??????????????????????????? ????????????</h3>
        <hr class="hr-title">
    <div class="row text-section">
        
        <div class="col-md-4 text-center">
            <img src="http://www.ghmi.edu.bd/storage/app/avatar/wcqtNlTX24J71gLY8bzDFFgouIPPNz5Qm8Lrs5CL.jpeg" class="rounded" alt="">
        </div>
        <div class="col-md-8">
            <p>????????????????????? ??????????????? ?????????????????? ????????????????????? ??????????????????????????? ???????????? ?????? ??????????????????????????? ?????????????????? ????????????????????? ????????????????????????-??????????????? ??????????????????????????? ?????????????????????????????? (??????????????? ???????????? ????????????)??? ?????????????????? ?????????????????????, ???????????????????????????????????? ?????????????????????????????? ??????????????? ???????????? ?????????????????? ??? ???????????????????????? ????????????????????? ?????????????????? ?????????????????? ????????? ????????????????????? ??????????????????????????? ??????????????? ??????????????? ?????????????????? ????????? ??????????????? ?????????????????? ???????????? ???????????? ???????????????????????????????????? ??? ?????????????????????????????? ?????????????????????????????? ????????? ?????????????????? ???????????????????????? ?????????????????? ??? ???????????????????????????????????? ???????????????/??????????????????????????? ?????????????????????????????? ???????????????????????????????????? ????????? ????????? ??????????????? ?????????????????? ????????? ????????? ?????????, ?????????????????? ??????????????? ????????????????????? ???????????? ???????????? ????????????????????? ??????????????? ??????????????????????????? ?????????????????? ??????????????? ??????????????? ?????????????????????????????? ???????????????-????????????????????? ????????????????????? ??????????????? ??????????????????, ????????????????????? ?????????????????? ?????????????????? ?????????????????? ???????????????????????? ????????????????????? ???????????????????????????, ??????????????? ???????????????????????????, ?????????????????? ???????????????????????? ??? ???????????????????????????????????? ????????????????????? ????????????????????? ???????????????????????? ?????????????????????????????? ??? ???????????????/??????????????????????????? ????????????????????? ?????????????????????????????? ????????????????????????????????? ??????????????? ????????????????????? ????????????????????? ?????? ????????? ???????????? ???????????????????????? ?????????????????? <span  class="hide-part">

            ???????????????????????? ???????????????????????? ??????????????????, ??????????????????, ??????????????? ????????????????????????, ????????????????????????, ?????????????????????????????? ??????????????????????????? ??? ????????? ??????????????? ??????????????? ?????????????????? ??????????????????????????? ??????????????? ?????????????????? ???????????? ?????????????????? ????????????????????? ????????? ??????, ????????? ??????????????? ???????????? ?????????????????? ???????????? ??????????????? ???????????????????????????????????? ?????????????????? ?????????????????? ?????????????????? ????????????????????????????????? ??????????????? ??????????????? ????????? ????????????????????? ?????????????????? ????????? ?????????????????? ???????????????/??????????????????????????? ?????????????????? ?????????????????? ?????????????????? ?????????????????? ????????? ????????? ?????????????????????, ??????????????? ???????????????????????? ??????????????????????????? ??????????????? ??????????????? ??? ?????????????????? ???????????????????????? ???????????? ?????????????????? ????????? ?????????????????? ???????????????-??????????????????????????? ???????????????????????? ????????? ????????? ????????? ????????? ????????? ???????????????????????????????????? ????????????????????? ???????????????/???????????????????????? ?????????????????? ?????????????????? ??????????????????????????? ??? ?????????????????? ???????????????????????? ??????????????? ?????????????????? ??????????????? ????????? ???????????? ?????????????????? ????????????????????? ???????????? ???????????? ??????????????? ???????????? ????????? ???????????? ???????????????????????????????????? ?????????????????????????????? ????????????-?????????????????? ?????????????????????????????? ???????????????????????? ????????????????????? ???????????? ?????????????????? ??? ??????????????? ?????????????????? ??????????????????????????? ?????????????????????????????? ???????????? ?????????????????????????????? ?????????????????????????????? ????????????????????? ????????? ?????? ?????????????????? ???????????? ?????????????????? ??????????????? ???????????????????????? ???????????? ??????????????? ????????????????????? ????????? ?????????????????? ??????????????????????????? ???????????? ?????????????????? ????????????????????? ?????????????????? ?????????????????? ???????????? ?????????????????? ???????????? ??? ???????????????????????? ???????????? ????????? ????????? ????????? ????????? ????????? ???????????? ??????????????? ?????????????????? ??????????????? ?????? ??????????????????????????? ?????????????????? ??????????????? ????????????????????? ???????????? ?????????????????? ??? ???????????????/??????????????????????????? ??????????????? ??????????????? ???????????????????????????????????? ?????????????????? ?????????????????????????????? ????????????????????? ??????????????????????????? ???????????????????????????????????? ????????????????????? ????????????-?????????????????????????????? ????????? ??????????????? ???????????? ???????????? ????????? ???????????????-?????????????????? ??? ?????????????????? ????????????????????? ??????????????? ????????????????????? ???????????? ??????????????????????????? ????????????????????? ???????????? ???????????? ??????????????? ????????? ?????????????????? ????????? ?????? ??????????????????????????????????????? ??????????????????????????? ???????????????????????? ????????????????????? ?????????????????????????????? ?????????????????? ???????????????????????? ???????????? ????????????????????????????????? ??????????????? ?????????????????? ????????????????????? ???????????? ???????????????????????? ?????????????????????????????? ??????????????? ????????????????????? ?????????????????? ????????? ????????? ??????????????????????????? ???????????????????????? ????????? ??????????????????

            ?????????????????? ????????? ??????????????? ?????? ?????????????????? ?????????????????? ???????????? ??? ???????????????????????????????????? ?????????????????????????????? ?????????????????? ????????????????????? ?????? ??????????????????????????? ?????????????????? ????????? ??????????????? ?????????????????? ??????????????? ???????????? ???????????????-??????????????????????????? ?????????????????? ?????????????????? ?????????????????? ?????????????????? ?????????????????? ????????????????????? ?????????????????? ??????????????? ???????????? ???????????????????????? ????????????????????? ?????????????????? ??? ????????????????????????????????? ?????????????????? ????????????????????? ??????????????? ??????????????????????????? ???????????? ??????????????? ????????????????????? ?????????????????????????????? ??? ???????????????????????????????????? ????????? ?????????????????????????????? ????????? ??????????????? ????????????????????? ????????????????????? ?????????????????????, ??????????????? ??? ????????????????????? ?????????????????? ???????????? ???????????????????????? ???????????????, ??????????????? ???????????? ?????????????????? ??????????????????????????? ???????????? ??????????????? ?????????, ??? ???????????? ?????????????????????????????? ????????? ????????????????????? ?????????????????? ????????????????????? ?????????????????? ???????????? ????????????</span></p>



            <p>??????. ???????????????????????? ??????????????? ???????????????</p>

            <p>??????.???????????? (??????????????????), ??????.???????????? (????????????????????????????????????), ??????.??????.</p>

            <p>?????????????????????</p>

            <p>????????????????????????-??????????????? ??????????????????????????? ?????????????????????????????? (??????????????? ???????????? ????????????)</p>

            <a class="hider btn" >Hide <i class="ti-arrow-up"></i></a>
            
            <a class="more btn">Read more </a>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-warning text-center">
                                <i class="ti-home"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total</p>
                                <p>Branches</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-home"></i>
                            {{ \App\Branch::count() }}


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-success text-center">
                                <i class="ti-user"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total</p>
                                <p>Teachers</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-user"></i>
                            {{\App\Teacher::where('status', 1)->count()}} <small>Number of Active Teachers</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-danger text-center">
                                <i class="ti-ruler-pencil"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total</p>
                                <p>Students</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-ruler-pencil"></i>
                            {{\App\Student::count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="content">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="icon-big icon-info text-center">
                                <i class="ti-reload"></i>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="numbers">
                                <p>Total</p>
                                <p>Shifts</p>
                            </div>
                        </div>
                    </div>
                    <div class="footer">
                        <hr />
                        <div class="stats">
                            <i class="ti-reload"></i>
                            {{\App\Shift::count()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        


     <!-- ======= Contact Section ======= -->
     <br>
     <hr>
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="text-center">
          <h4  class="title">Contact</h4>
          <h3 class="title"><span>Contact Us</span></h3>
          <p>Join us for better future.</p>
        </div>

        <div class="row text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="ti-home icon"></i>
              <h3 class="title">Our Address</h3>
              <p>P.O: Putiabari, Shibpur-Narsingdi</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="ti-email icon"></i>
              <h3 class="title">Email Us</h3>
              <p><a href="" >email-address</a></p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="ti-mobile icon"></i>
              <h3  class="title">Call Us</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- End Contact Section -->


</div>
    <hr> 
    <footer class="footer">
        <div class="container-fluid">
            <div class="copyright pull-right">             
               &copy; <script>document.write(new Date().getFullYear())</script>, built with care by <a        href="http://www.systechdigital.com">SYSTECH DIGITAL LIMITED</a>
            </div>
        </div>
    </footer>

<script>
    $(document).ready(function(){
        $(".hide-part").hide();
        $(".hider").hide();
        $(".hider").click(function(){
            $(".hide-part").hide();
            $(".hider").hide();
            $(".more").show();

        });
        $(".more").click(function(){
            $(".more").hide();
            $(".hider").show();
            $(".hide-part").show();

        });
    });
</script>
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
   
    setTimeout(carousel, 2000); // Change image every 2 seconds
    }
</script>

</body>

</html>
