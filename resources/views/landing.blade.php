<?php
  use App\Vendors;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cataloge</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link href="https://use.fontawesome.com/f688949f46.css" media="all" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height"  style='backgorund: #4a4a4a;'>
        
            @if (Route::has('login'))
                <div class="top-right links" style='background: #008000;
                    padding: 20px 20px;
                    left: 0px;
                    color: #008000;
                    position: absolute;
                    right: 0px;
                    top: 0;
                    margin-bottom: 20px;'>
               
                    @auth
                        <a href="{{ url('/customers') }}">Home</a>
                    @else
                        <a href="{{ url('/') }}" style="float:left;color:#ffffff;"><h5>BOOKING SYSTEM</h5></a>
                        <a href="{{ route('customer.login') }}" style="color:#ffffff;">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('customer.create') }}" style="color:#ffffff;">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content" style="margin-top: 80px;">
                <div class="container">
                    <div class="row" style='margin-top: 25%;'>
                                @foreach($vendors as $vendor)
                                        <div class="col-xs-6 col-sm-4 col-md-3" style='margin-top: 5%; text-align: left;'>
                                            <div class="product-imagewrapper">
                                                
                                                <?php  
                                                $full_img = Vendors::getLogo($vendor->vendor_logo);
                                                ?>
                                                
                                                
                                                <img src="{{$full_img}}" class="img-responsive" ></a>
                                            </div>

                                            <div class="product-content-wrapper" style='text-align:left;'>
                                                <h5>
                                                        {{$vendor->package_name}}</h5>
                                                
                                                <span>PHP {{$vendor->rates}} </span>
                                               
                                                
                                                <form name="add-to-cart" action=" {{route('customer.login')}}" method="get" style="margin-top:5px;clear:both;margin-right: 5px;">
                                                    {!! csrf_field() !!}
                                                    <a  class="btn btn-default addcard-new">
                                                    <input type="hidden" value="1" name="quantity" class="qty" />
                                                    <input type="hidden" value="{{$vendor->package_uuid}}" name="id" class="id proid" />
                                                    @csrf
                                                    <span class="item-count"></span>
                                                    <input class='btn-success btn' type="submit" value="Add to Cart" name="add_to_cart" class="add" />
                                                    </a>
                                                </form>
                                                <form name="add-to-cart" action="{{route('customer.login')}}" method="get">
                                                    {!! csrf_field() !!}
                                                    <a  class="btn btn-default addcard-new">
                                                    <input type="hidden" value="1" name="quantity" class="qty" />
                                                    <input type="hidden" value="{{$vendor->package_uuid}}" name="id" class="id proid" />
                                                    @csrf
                                                    <span class="item-count"></span>
                                                    <input class='btn-success btn' type="submit" value="BUY NOW" name="book_now" class="book" />
                                                    
                                                    </a>
                                                </form>	
                                                            
                                            </div>  
                                        </div>
                                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
