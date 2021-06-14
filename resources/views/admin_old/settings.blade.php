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
                            <form class="text-left" method="POST" action="{{route('settings.update',$settings->setting_id)}}">
                                @csrf
                                @method('PUT')  
                                <div class="row">
                                    <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="mobile">Contact Name</label>
                                            <input maxlength="50" type="text" value="{{old('contact_name', !empty($settings) ? $settings->contact_name : '')}}" required name="contact_name" class="form-control" id="contact_name" placeholder="Contact Name"> 
                                        </div>  
                                    </div>
                                    <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="dob">Contact Email</label>
                                            <input  type="text" maxlength="50"  required name="contact_email" value="{{old('contact_email', !empty($settings) ? $settings->contact_email : '')}}" class="form-control" id="contact_email" placeholder="Contact Email"> 
                                        </div> 
                                    </div>
                                </div> 
                                 
                                <div class="row">
                                    <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="mobile">Contact Number</label>
                                            <input maxlength="10" type="text" value="{{old('contact_no', !empty($settings) ? $settings->contact_no : '')}}" required name="contact_no" class="form-control" id="contact_no" placeholder="Contact Number">
                                        </div>  
                                    </div>
                                    <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="dob">Other Contact Number</label>
                                            <input  type="text"  maxlength="10" required name="aleternate_no" value="{{old('aleternate_no', !empty($settings) ? $settings->aleternate_no : '')}}" class="form-control" id="aleternate_no" placeholder="Other Contact Number">
                                        </div> 
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="name"> Contact Address</label>
                                            <textarea  maxlength="150" required name="contact_address" class="form-control" id="contact_address" placeholder="Contact Address">{{old('contact_address', !empty($settings) ? $settings->contact_address : '')}}</textarea> 
                                        </div>
                                    </div> 
                                </div>  
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="name"> Privacy Policy</label>
                                            <textarea required name="privacy" class="form-control" id="privacy" placeholder="Privacy & Policy">{{old('privacy', !empty($settings) ? $settings->privacy : '')}}</textarea> 
                                        </div>
                                    </div> 
                                </div> 
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="name"> Terms & Condition</label>
                                            <textarea required name="terms_condition" class="form-control" id="terms_condition" placeholder="Terms & Condition">{{old('terms_condition', !empty($settings) ? $settings->terms_condition : '')}}</textarea> 
                                        </div>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group mb-4">
                                            <label for="name">About Us</label>
                                            <textarea required name="about_us" class="form-control" id="about_us" placeholder="About Us">{{old('about_us', !empty($settings) ? $settings->about_us : '')}}</textarea> 
                                        </div>
                                    </div>  
                                </div>


                                
                                <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                            </form> 
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   

<script> 
    CKEDITOR.replace( 'privacy' ); 
    CKEDITOR.replace( 'terms_condition' );  
    CKEDITOR.replace( 'about_us' );  
</script>