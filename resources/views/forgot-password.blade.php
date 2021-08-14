@include('include.header')
@include('include.nav') 
<section id="clientLogIn" class="clientLogIn padding-top" role="Login" style="padding-top:120px;">
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
                        <p class="clientP">Forgot Password</p>
                    </div>
                    <form action="{{route('forgot_password.submit')}}" class="formLogIn" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email Id"
                                        aria-label="Email Id" aria-describedby="basic-addon1" name="email_address" value="{{old('email_address')}}">
                                </div> 
                            </div> 
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <button type="submit" name="submit" class="login1 btn">Reset Password</button>
                                </div> 
                            </div> 
                            
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