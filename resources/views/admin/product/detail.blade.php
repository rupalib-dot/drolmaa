@extends('admin.layouts.app')

@section('content')

<style>
.contacts-block  li{
    margin-bottom:20px;
}
.fas, .far{
   color: #ffc800;
}
</style>

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Product Details</h4>
                            </div>
                        </div>
                    </div> 
                </div>   
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-content widget-content-area">
                        <h3 class="">{{ucwords($product->product_name)}}</h3>
                        <h3 class="">
                            @if($product->rating == 1)
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($product->rating == 2)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($product->rating == 3)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($product->rating == 4)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            @elseif($product->rating == 5)
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            @else
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            @endif
                        </h3>
                    </div>
                    <div class="widget-content widget-content-area">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="contacts-block list-unstyled" style="max-width: 100%;">
                                    <li><b>Expiry Date:-</b> {{date('d M,Y',strtotime($product->expiry_date))}}</li>
                                    <li><b>Quantity:-</b> {{$product->quantity}}</li> 
                                    <li><b>Selling Price:-</b> {{$product->selling_price}}</li>  
                                    <li><b>MRP:-</b> {{$product->mrp}}</li>   
                                    <li><b>Category Name:-</b> {{CommonFunction::GetSingleField('category','category_name','category_id',$product->category_id)}}</li>

                                </ul>
                            </div> 
                            <div class="col-lg-6">
                                <ul class="contacts-block list-unstyled" style="max-width: 100%;"> 
                                    <li><b>Description:-</b> {{$product->description}}</li>
                                    <li><b>Instructions:-</b> {{$product->instructions}}</li>
                                    <li><b>References:-</b> {{$product->referenceses}}</li> 
                                </ul>
                            </div> 
                        </div>             
                    </div>
                </div> 
                <div class="statbox widget box box-shadow mb-1"> 
                    <div class="widget-content widget-content-area">
                        <div class="row">
                            <?php if(count($product_image)>0){
                                foreach($product_image as $productImg){?>
                                    <div class="col-lg-3" style="margin-top:20px">
                                        <span class="view-icon" title="Delete"><a onclick="return confirm('Are you sure you want to delete this product Image?')" href="{{route('productImage.delete',['id'=>$productImg->product_image_id,'product_id'=>$product->product_id])}}" style="cursor:pointer"><i class="far fa-times-circle"></i></a></span>
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
@endsection  
