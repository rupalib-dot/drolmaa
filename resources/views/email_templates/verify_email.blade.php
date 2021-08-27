<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Drolma - Verify Email!</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<style type="text/css">
	*{font-family: 'Roboto', sans-serif;margin:0px;padding: 0px;}
	h2{color: #000; font-size: 34px;font-weight: 400;margin-bottom: 10px;}
	strong{color: #000; font-size: 18px;font-weight: 300;margin-bottom: 15px;}
	p{color: #555555;font-size: 15px;font-weight: 300;margin-bottom: 20px;line-height: 25px;}
</style>
</head>

<body>
	<?php $emailAddress = base64_encode($details['email']);
	$userid = base64_encode($details['user_id']);
	$otp = base64_encode($details['otp']);?>
	<div style="max-width: 600px; margin:0 auto;">
		<div style ="display:block; position:relative; padding:25px; background-color: #eef0f3">
			<div style="display: block; position: relative;padding: 32px;background-color: #fff;border-radius: 10px;box-shadow: 0px 0px 10px #e2e2e2;">
				<p><strong>Dear {{$details['name']}}</strong></p>
				<p>You have received this message because your email address has been registerd with "Drolmaa" plateform. Verify yourself and confirm your email by clicking below link and using bellow otp.</p>
				<p style="text-align: center;">OTP:- {{$details['otp']}}</p>
				<p style="text-align: center;"><a href="{{route('verify.otp',['module'=>'email','page'=>'profile','user_id'=>$userid,'otp'=>$otp])}}">{{route('verify.otp',['module'=>'email','page'=>'profile','user_id'=>$userid,'otp'=>$otp])}}</a></p>
				<p style="text-align: center;"><a href="{{route('verify.otp',['module'=>'email','page'=>'profile','user_id'=>$userid,'otp'=>$otp])}}" style="display: inline-block;background-color: #203869;color: #fff;position: relative;border-radius: 60px;padding: 12px 30px;text-decoration: none;">Verify Email</a></p>
				<p>If it wasn't you who submitted your email address in the first place, we apologies for the error.</p>
				<p>Please ignore this email. You will not receive any further email from us.</p>
				<p style="padding-top: 20px;">Kind Regards,</p>
				<p><b>Drolmaa Team</b></p>
			</div>
			
			<!-- htmlspecialchars(): Argument #4 ($double_encode) must be of type bool, array given (View: C:\xampp\htdocs\drolmaa\resources\views\email_templates\new_user_register.blade.php) -->
		</div>
	</div>
</body>
</html>