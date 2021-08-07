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
                        <p style="color:red"><b>{{$msg}}</b></p>
                        <h3>DrolMaa Constellation Club</h3>
                        <p class="clientP">Verify Otp</p>
                    </div>
                    <form action="{{route('verify.otp.submit')}}" class="formLogIn" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="OTP" aria-label="OTP" aria-describedby="basic-addon1" name="otp" value="{{old('otp')}}">
                                </div> 
                            </div> 
                            <div class="col-md-12">
                                <div class="input-group mb-4">
                                    <button type="submit" name="submit" class="login1 btn">Verify Otp</button>
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