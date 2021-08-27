@include('include.header')
@include('include.nav')
<style>
.feather-eye
    {
        cursor: pointer;
        width: 16px;
        position: absolute;
        top: 6px;
        left: 225px;
    }
</style>
<section id="clientLogIn" class="clientLogIn padding-top my-5" role="Login" style="padding-top:120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="clientLogImage">
                    <div class="clientLogo">
                        <img src="{{asset('front_end/images/bannerimg2.png')}}" alt="">
                        <h3 class="text-dark">DrolMaa Constellation Club</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="formRight">
                    @include('include.validation_message')
                    @include('include.auth_message')
                    <div class="clientTextF">
                        <h4>Welcome to</h4>
                        <h3>DrolMaa Constellation Club</h3>
                        <p class="clientP">Login</p>
                    </div>
                    <form action="{{route('login.account')}}" class="formLogIn" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Mobile Number / Email Id"
                                        aria-label="Mobile Number /  Email Id" aria-describedby="basic-addon1" name="email_address" value="{{old('email_address',isset($_COOKIE['email_address'])? $_COOKIE['email_address'] : '')}}">
                                </div>
                                <div class="form-check list-regular">
                                    <input class="form-check-input" name="remember_me" type="checkbox" value="1" @if(isset($_COOKIE['remember_me'])) @if($_COOKIE['remember_me']==1) checked @endif @endif id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault" style="padding-top:3px;">
                                        Remember me
                                    </label>
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" value="{{isset($_COOKIE['user_password'])? $_COOKIE['user_password'] : ''}}" placeholder="Password" aria-label="Password"
                                        aria-describedby="basic-addon1" name="user_password" id="user_password">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('user_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <a href="{{route('forgot_password')}}" class="text-danger forgotPasswrd">Forgot Password?</a>
                            </div>
                            <button class="login1 btn">Log In</button>
                        </div>
                        <div class="sign-up ajay mt-4">
                            Don't have an Account ?<br> 
                            <a href="{{route('customer.create')}}" class="text-danger">Register as USER </a><span> | <a href="{{route('expert.first.step')}}" class="text-danger">Register as EXPERT</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('include.footer')
@include('include.footer_bottom')
@include('include.script')

<script>
        function ShowPass(id)
        { 
            var x = document.getElementById(id);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>