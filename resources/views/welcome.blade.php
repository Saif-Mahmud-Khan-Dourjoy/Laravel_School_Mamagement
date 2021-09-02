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
                <h3 class="pt-1">নতুন ক্যাম্পাস</h3>
            </div>
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/AtBMAfKKuPKaHuKtAqr22RiIBdDCbTUw1ITyg1lT.jpeg" style="width:100%">
                <h3 class="pt-1">ইনস্টিটিউট ছাত্রা বাস</h3>
            </div>
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/OjYrQkFeQ4WXQK1gOx5pFcAdkgmIYYW9PHa8fIfA.jpeg" style="width:100%">
                <h3 class="pt-1">পুরাতন শ্রেণিকক্ষ</h3>
            </div>
            <div class="mySlides">
                <img class="" src="http://www.ghmi.edu.bd/storage/app/gallery/XrkL0WTWHS7PqWFkxkuErporhpOVw6ZaODY5fdwU.jpeg" style="width:100%">
                <h3 class="pt-1">পুরাতন টিনশেড শ্রেনিকক্ষ</h3>
            </div>
        </div>
    </div>
    <!-- ======= End Slider Section ======= -->
        <h3 class="pt-3 text-center title">অধ্যক্ষের বাণী</h3>
        <hr class="hr-title">
    <div class="row text-section">
        
        <div class="col-md-4 text-center">
            <img src="http://www.ghmi.edu.bd/storage/app/avatar/wcqtNlTX24J71gLY8bzDFFgouIPPNz5Qm8Lrs5CL.jpeg" class="rounded" alt="">
        </div>
        <div class="col-md-8">
            <p>নরসিংদী জেলার শিবপুর উপজেলায় বংশিরদিয়া নামে এক প্রত্যন্ত গ্রামে অবস্থিত গুলেস্তা-হাফিজ মেমোরিয়াল ইনস্টিটিউট (স্কুল এন্ড কলেজ)। এলাকার অবহেলিত, সুবিধাবঞ্চিত ছেলেমেয়েসহ সকলের জন্য আধুনিক ও মানসম্মত শিক্ষার সুযোগ সৃষ্টি করে ভবিষ্যৎ প্রজন্মকে দেশের সম্পদ হিসেবে গড়ে তোলার লক্ষ্য নিয়ে ২০০০ খ্রিস্টাব্দে এ ইনস্টিটিউট প্রতিষ্ঠিত হয়। নিয়মিত পাঠদানের বাইরেও এ ইনস্টিটিউটের ছাত্র/ছাত্রীদের মানসিকভাবে আত্মবিশ্বাসী করে গড়ে তোলার চেষ্টা করা হয়। ফলে, জীবনের যেকোন পর্যায়ে গিয়ে তারা নিজেদের যোগ্য প্রতিযোগী হিসেবে ভাবতে শেখে। অবকাঠামোগত সুযোগ-সুবিধার শিক্ষার মনোরম পরিবেশ, সুযোগ্য শিক্ষক মন্ডলী দ্বারা পরিচালিত শিক্ষার কার্যক্রম, সুষ্ঠ পরিকল্পনা, সুদক্ষ পরিচালনা ও ব্যবস্থাপনার মাধ্যমে শিক্ষার মনোন্নয়ন প্রচেষ্টায় ও ছাত্র/ছাত্রীদের কল্যাণে ইনস্টিটিউট কর্তৃপক্ষের গৃহীত বিভিন্ন পদক্ষেপ আজ সকল মহলে প্রশংসিত হচ্ছে। <span  class="hide-part">

            মানসম্মত শিক্ষাদন পদ্ধতি, শৃংখলা, মেধার মূল্যায়ন, খেলাধুলা, সাংস্কৃতিক কর্মকান্ড – এসব এখানে জাতীয় শিক্ষা কারিকুলাম ছাড়াও নিজস্ব কিছু পদ্ধতি অবলম্বন করা হয়, যার সুফলও আমরা বরাবরই পেয়ে আসছি। ইনস্টিটিউটের “ছাত্র কল্যাণ তহবিল” কার্যক্রমের আওতায় প্রতি বছর বেশকিছু দরিদ্র অথচ মেধাবী ছাত্র/ছাত্রীদের শিক্ষা সহায়তা অনুদান প্রদান করা হয়। তাছাড়াও, “মেধা অন্বেষণ” প্রকল্পের আওতায় একাদশ ও দ্বাদশ পর্যায়সহ কিছু দরিদ্র অথচ মেধাবী ছাত্র-ছাত্রীদের পড়াশুনার সকল খরচ বহন করা হয়। ইনস্টিটিউটের প্রতিটি ছাত্র/ছাত্রীকে শিক্ষক মন্ডলী প্রত্যক্ষ ও পরোক্ষ তদারকিতে রাখার চেষ্টা করেন। ফলে তারা নিয়মিত পড়াশুনা থেকে দুরে থাকতে পারে না। আমরা ইনস্টিটিউটের অভ্যন্তরীণ নিয়ম-শৃংখলা ব্যবস্থাকে সর্বোচ্চ গুরুত্ব দেই। ধর্মীয় ও নৈতিক শিক্ষা অনুশীলনের সুযোগদানের জন্য ইনস্টিটিউট ক্যাম্পাসে নির্মাণ করা হয় সুন্দর একটি মসজিদ। দুরের ছাত্রদের জন্য সীমিত পর্যায়ে আছে আবাসিক ব্যবস্থা। আমরা আধুনিক ডিজিটাল শিক্ষা অনুসরণ করার চেষ্টা করি। এ লক্ষ্যকে ধারণ করে তিল তিল করে গড়ে তোলা হয়েছে আধুনিক মানের এক কম্পিউটার ল্যাব। সীমিত পর্যায়ে হলেও শিক্ষক ও ছাত্র/ছাত্রীদের জন্যে রয়েছে ইনস্টিটিউটের নিজস্ব ক্যান্টিনে খাবারের ব্যবস্থা। ইনস্টিটিউটের সার্বিক তথ্য-পরিসংখ্যান হাল নাগাদ করার জন্য এবং ছাত্র-ছাত্রী ও শিক্ষক মন্ডলীর মধ্যে সৃজনশীল লেখন প্রতিভাকে উৎসাহিত করার জন্য প্রতি বছর প্রকাশ করা হয় “ইনস্টিটিউটের পরিক্রমা” শিরোনামে বার্ষিক ম্যাগাজিন। আবাসিক ছাত্রদের জন্য নিরবচ্ছিন্ন বিদুৎ সরবরাহ নিশ্চিত করতে সম্প্রতি ছাত্রাবাসে সোলার প্যানেল স্থাপন করে সৌর বিদ্যুতের ব্যবস্থা করা হয়েছে।

            আমাদের মনে বিশাল এক আগামী। সেখানে আমরা এ ইনস্টিটিউটকে বাংলাদেশের অন্যতম শ্রেষ্ঠ এক বিদ্যাপীঠ হিসেবে গড়ে তোলার স্বপ্ন দেখি। আমরা ছাত্র-ছাত্রীদের স্বপ্ন দেখাই। স্বপ্ন পূরণের আপ্রাণ চেষ্টা। আলোকিত মানুষ গড়ার আন্দোলনে নিয়েজিত সুন্দর এ ইনস্টিটিউটে সবাইকে স্বাগত। সময়ের মাপকাঠিতে নবীন কিন্ত উজ্জ্বল সম্ভাবনাময় এ প্রতিষ্ঠানকে আরও সুন্দরভাবে গড়ে তোলার লক্ষ্যে গঠনমূলক পরামর্শ, নৈতিক ও বস্তুগত সমর্থন দিয়ে সহযোগিতা করবেন, সকলের নিকট এমনটাই প্রত্যাশা করি। কামনা করি, এ মহতী প্রচেষ্টায় পরম করূণাময় আল্লাহ তা’য়ালা আমাদের সহায় হউন।</span></p>



            <p>মো. মাজহারুল ইসলাম জুয়েল</p>

            <p>বি.এসসি (সম্মান), এম.এসসি (পদার্থবিদ্যা), ঢা.বি.</p>

            <p>অধ্যক্ষ</p>

            <p>গুলেস্তা-হাফিজ মেমোরিয়াল ইনস্টিটিউট (স্কুল এন্ড কলেজ)</p>

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
