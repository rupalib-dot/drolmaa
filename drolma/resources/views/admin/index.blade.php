@extends('admin.layouts.app')

@section('content')

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

        
            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{Route('admincustomer.index')}}">
                <div class="widget widget-table-one">
                    <div class="widget-heading">
                        <h5 class="">Customers</h5>
                    </div>

                    <div class="widget-content">
                       
                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl"> 
                                                <span class="avatar-title rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4></h4>
                                            <p class="meta-date"></p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p><span>{{count($customers)}}</span> </p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </a>
            </div>
       
           
            <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
            <a href="{{Route('adminexpert.index')}}">
                <div class="widget widget-table-one">
                    <div class="widget-heading">
                        <h5 class="">Experts</h5>
                    </div>

                    <div class="widget-content">
                       
                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl"> 
                                                <span class="avatar-title rounded-circle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4></h4>
                                            <p class="meta-date"></p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p><span>{{count($experts)}}</span> </p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </a>
            </div>
           
            <!--<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-three">

                    <div class="widget-heading">
                        <h5 class="">Top Selling Products</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><div class="th-content">Product</div></th>
                                        <th><div class="th-content th-heading">Price</div></th>
                                        <th><div class="th-content">Sold</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>-->

            <!--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-table-two">

                    <div class="widget-heading">
                        <h5 class="">Recent Orders</h5>
                    </div>

                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th><div class="th-content">Invoice</div></th>
                                        <th><div class="th-content">Customer</div></th>
                                        <th><div class="th-content th-heading">Price</div></th>
                                        <th><div class="th-content">Status</div></th>
                                        <th><div class="th-content">Action</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>-->

        </div>

    </div>
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © {{date('Y')}} <a target="_blank" href="{{url('')}}">Drolmaa</a>, All rights reserved.</p>
        </div>
    </div>
    
@endsection  