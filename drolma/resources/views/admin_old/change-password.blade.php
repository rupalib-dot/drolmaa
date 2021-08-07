@include('admin.layouts.header')    

 <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('admin.layouts.sidebar')   

         <div id="content" class="main-content"> 
             <div class="page-header" style = "margin-left: 25px">
                    <div class="page-title">
                        <h3>{{$title}}</h3>
                    </div>
                </div>
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;"> 
                
            <!-- <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;">                      -->
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">     
                            @include('admin.layouts.validation_message')
                            @include('admin.layouts.auth_message')      
                            </div>
                            <form class="text-left" method="POST" action="{{ Route('admin.change_password.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-xl-4 col-md-12 col-sm-12 col-12">
                                        <div id="password-field" class="field-wrapper input mb-2 CurrentPass">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">CURRENT PASSWORD</label> 
                                            </div> 
                                            <input id="CurrentPass" value="{{old('CurrentPass')}}" type="password" name="CurrentPass"   autocomplete="current-password"  class="form-control" placeholder="Current Password">
                                            <i  id="toggle-passwordCurrent" class="fas fa-eye"></i> 
                                        </div> 
                                    </div>
                                    <div class="col-xl-4 col-md-12 col-sm-12 col-12">
                                        <div id="password-field" class="field-wrapper input mb-2 NewPass">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">NEW PASSWORD</label> 
                                            </div>
                                            <input id="NewPass" value="{{old('NewPass')}}" type="password" name="NewPass"   autocomplete="new-password"  class="form-control " placeholder="New Password">
                                            <i  id="toggle-passwordNew" class="fas fa-eye"></i> 
                                        </div> 
                                    </div>
                                    <div class="col-xl-4 col-md-12 col-sm-12 col-12">
                                        <div id="password-field" class="field-wrapper input mb-2 ConfirmPass">
                                            <div class="d-flex justify-content-between">
                                                <label for="password">CONFIRM PASSWORD</label> 
                                            </div>
                                            <input value="{{old('ConfirmPass')}}" id="ConfirmPass" type="password" name="ConfirmPass"   autocomplete="confirm-password"  class="form-control" placeholder="Password">
                                            <i  id="toggle-passwordConfirm" class="fas fa-eye"></i> 
                                        </div> 
                                    </div> 
                                    <div class="code-section-container show-code"  style = "margin-left: 20px"> 
                                        <a href="{{Route('admin.change_password')}}" class="btn btn-danger">Cancel</a>
                                        <button style = "margin-left: 10px" type="submit" name="submit" class="btn btn-primary" value="">Save</button> 
                                        
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   