@include('admin.layouts.header')   

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container sidebar-closed sbar-open" id="container">
        @include('admin.layouts.sidebar') 
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
         <!--  END SIDEBAR  -->
         
            <div class="layout-px-spacing">
                <div class="mt-20"> 
                     @include('admin.layouts.validation_message')
                        @include('admin.layouts.auth_message')
                </div>

                <h2 class="mt-20">{{strtoupper(Session::get('full_name'))}}</h2>
                <div class="row layout-top-spacing">

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        
                            <div class="widget widget-chart-one"> 
                                <div class="widget-heading"> 
                                    <h5 class="">Customers</h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <ul class="tabs tab-pills">
                                        <li>{{count($customers)}}</li>
                                    </ul> 
                                </div> 
                            </div>
                        </a>
                    </div>

                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <a href="{{Route('adminexpert.index')}}">
                            <div class="widget widget-chart-one"> 
                                <div class="widget-heading"> 
                                    <h5 class="">Experts</h5>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    <ul class="tabs tab-pills">
                                        <li>{{count($experts)}}</li>
                                    </ul> 
                                </div> 
                            </div>
                        </a>
                    </div>

                        
                </div>

            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER --> 
@include('admin.layouts.footer')