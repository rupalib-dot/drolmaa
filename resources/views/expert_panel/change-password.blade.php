@include('include.header')
@include('include.nav')
<style>
.feather-eye
    {
        cursor: pointer;
        width: 16px;
        position: absolute;
        top: 6px;
        left: 496px;
    }
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-lg-10">
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">{{$title}}</h3> 
                                <p class="fnt">Your new password must be different from previous used password.</p>
                                <form action="{{route('change-password-submit')}}" method="POST" class="formLogIn">
                                    @csrf 
                                        
                                    <div class="row">
                                        <div class="col-md-8 mb-5">
                                            <div class="input-group mb-4">
                                                <input type="password" maxlength="16" value="{{old('CurrentPass')}}" name="CurrentPass"  id="login_password"  required class="form-control"
                                                    placeholder="Old Password" aria-label="Name"
                                                    aria-describedby="basic-addon1"> 
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('login_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <div class="col-md-8 mb-5">
                                            <div class="input-group mb-4">
                                                <input type="password" maxlength="16" name="NewPass" id="new_password" value="{{old('NewPass')}}"  required class="form-control"
                                                    placeholder="New Password" aria-label="Name"
                                                    aria-describedby="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('new_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="input-group mb-4">
                                                <input type="password" maxlength="16" name="ConfirmPass" id="confirm_password" value="{{old('ConfirmPass')}}" required class="form-control"
                                                    placeholder="Confirm Password" aria-label="Name"
                                                    aria-describedby="basic-addon1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="ShowPass('confirm_password')" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="input-group mb-4">
                                                <button class="login1 btn" type="submit" name="submit">Submit</button>
                                            </div>
                                        </div>
                                        </form>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>
@include('include.footer') 
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