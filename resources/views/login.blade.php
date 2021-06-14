@include('include.header')
@include('include.nav')
<section id="clientLogIn" class="clientLogIn padding-top" role="Login" style="padding-top:120px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="clientLogImage" style="background-image:url({{asset('front_end/images/img1-1.png')}})">
                    <div class="clientLogo">
                        <img src="{{asset('front_end/images/bannerimg2.png')}}" alt="">
                        <h3>DrolMaa Constellation Club</h3>
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
                        <p class="clientP">Client Login</p>
                    </div>
                    <form action="{{route('login.account')}}" class="formLogIn" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Mobile Number / Email Id"
                                        aria-label="Mobile Number /  Email Id" aria-describedby="basic-addon1" name="email_address" value="{{old('email_address')}}">
                                </div>
                                <div class="form-check list-regular">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Remember me
                                    </label>
                                </div>
                               
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                        aria-describedby="basic-addon1" name="user_password">
                                </div>
                                <a href="#" class="forgotPasswrd">Forgot Password?</a>
                            </div>
                            <button class="login1 btn">Log In</button>
                        </div>
                        <div class="sign-up mt-4">
                            Don't have an account ? <a href="{{route('customer.create')}}">Client Account</a><span> | <a href="{{route('expert.first.step')}}">Expert Account</span></a>
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