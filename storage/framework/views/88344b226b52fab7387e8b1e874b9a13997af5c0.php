<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title><?php echo e(config('app.name')); ?> </title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front_end/font/flaticon.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('front_end/css/style.css')); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/plugins.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/authentication/form-2.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/theme-checkbox-radio.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/forms/switches.css')); ?>">
</head>
<body class="form formBody">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Sign In</h1>
                        <p class="">Log in to your account to continue.</p>
                        <?php echo $__env->make('admin.inc.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.inc.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form class="text-left" id="login" method="POST" action="<?php echo e(route('login.account')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" value="admin" name="loginFor">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">USERNAME</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input name="email_address" type="text" class="form-control" placeholder="Email Address" value="<?php echo e(old('email_address')); ?>" required onkeypress="return LenCheck(event, this.value, '50')">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">PASSWORD</label>
                                        <a href="<?php echo e(route('admin.forgot_password')); ?>" class="forgot-pass-link">Forgot Password?</a>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="user_password" type="password" class="form-control" placeholder="Password" value="<?php echo e(old('user_password')); ?>" required onkeypress="return LenCheck(event, this.value, '16')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Log In</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo e(asset('assets/js/libs/jquery-3.1.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo e(asset('assets/js/authentication/form-2.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation.min.js')); ?>"></script>

</body>
</html><?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>