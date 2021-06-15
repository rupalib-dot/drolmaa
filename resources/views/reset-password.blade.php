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
                        <p class="clientP">Reset Password</p>
                    </div>
                    <form action="{{route('reset_password.submit')}}" class="formLogIn" method="POST">
                        @csrf
                        <input type="hidden" value="{{$request['email']}}" name="email_address">
                        <input type="hidden" value="{{$request['userId']}}" name="userId">
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                        aria-describedby="basic-addon1" name="user_password" id="user_password" value="{{old('user_password')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('user_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div> 
                            </div> 
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="password" class="form-control" placeholder="Confirm password"
                                        aria-label="Confirm password" aria-describedby="basic-addon1" id="confirm_password" name="confirm_password" value="{{old('confirm_password')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('confirm_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div> 
                            </div>
                            <button type="submit" name="submit"  class="login1 btn">Reset</button>
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