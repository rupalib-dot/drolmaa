@include('admin.layouts.header')    
<style>
    li{
     margin-bottom: 10px;
    }
</style>

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
                <div class="widget-header" style="margin:20px;">  
                    @include('admin.layouts.validation_message')
                    @include('admin.layouts.auth_message')
                </div> 
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;"> 
            
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;">                     
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow"> 
                            <div class="row layout-spacing"> 
                                <!-- Content -->
                                <h4 style="margin-left: 15px;" class="">INFO</h4>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">  
                                    <div class="user-profile layout-spacing">  
                                        <div class="d-flex justify-content-between" style = "margin-bottom: 20px;"> 
                                            <h3 class="">{{ucwords($product->product_name)}}</h3>
                                        </div>  
                                        <div class="user-info-list"> 
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <ul class="contacts-block list-unstyled" style="max-width: 100%;">
                                                        <li><b>Expiry Date:-</b> {{date('d M,Y',strtotime($product->expiry_date))}}</li>
                                                        <li><b>Quantity:-</b> {{$product->quantity}}</li> 
                                                        <li><b>Description:-</b> {{$product->description}}</li> 
                                                    </ul>
                                                </div> 
                                                <div class="col-lg-6">
                                                    <ul class="contacts-block list-unstyled" style="max-width: 100%;"> 
                                                        <li><b>Selling Price:-</b> {{$product->selling_price}}</li>  
                                                        <li><b>MRP:-</b> {{$product->mrp}}</li>  
                                                    </ul>
                                                </div> 
                                            </div>               
                                        </div> 
                                    </div> 
                                </div>  
                            </div>  
                        </div>
                    </div> 
                </div> 
               
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow"> 
                            <div class="row layout-spacing"> 
                                <!-- Content -->
                                <h4 style="margin-left: 15px;" class="">Product Images</h4>
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">  
                                    <div class="user-profile layout-spacing">  
                                        <div class="user-info-list"> 
                                            <div class="row"> 
                                                <?php if(count($product_image)>0){
                                                    foreach($product_image as $productImg){?>
                                                        <div class="col-lg-3" style="margin-top:20px">
                                                            <span class="view-icon" title="Delete"><a onclick="return confirm('Are you sure you want to delete this product Image?')" href="{{route('productImage.delete',['id'=>$productImg->product_image_id,'product_id'=>$product->product_id])}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                            <img style="width: 150px;" src="<?php if(!empty($productImg->image_name)){?>{{asset('products/'.$productImg->image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>"> 
                                                        </div> 
                                                    <?php }
                                                } ?>                                                
                                            </div>               
                                        </div> 
                                    </div> 
                                </div>  
                            </div>  
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   