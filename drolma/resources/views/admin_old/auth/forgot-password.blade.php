<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} </title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('front_end/font/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_end/css/style.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/switches.css')}}">
</head>
<body class="form formBody">
    

    <div class="form-container outer ">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                         @include('admin.layouts.validation_message')
                        @include('admin.layouts.auth_message')
                        <h1 class="">Forgot Password</h1>
                        <p class="">Forgot your password? No problem. Just let us know your email address and we will email you a password that can help you to login into you panel then you can change your password.</p>
                        
                        <form class="text-left" id="login" method="POST" action="{{ route('admin.forgot_password.submit') }}">
                        @csrf
                        <input type="hidden" value="admin" name="forgotpasswordFor">
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">EMAIL</label>
                                    <i class="fas fa-at"></i>
                                    <input id="email_address" name="email_address" value="{{old('email_address')}}"   autofocus type="text" class="form-control" placeholder="Email"> 
                                </div> 

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit"  name="submit" class="btn btn-primary" value="">Forgot Password</button>
                                    </div>
                                </div> 
                                
                                <p class="signup-link">Remember Password ? <a href="{{Route('admin.login')}}">Log In</a></p>
                            </div>
                        </form>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/js/authentication/form-2.js')}}"></script>

</body>
</html>