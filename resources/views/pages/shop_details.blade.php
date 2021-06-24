@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/shopimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Product Details</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-product" class="about-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                <div class="product-photo">
                    <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$id)?>
                    <img style="width: 100%;height: 320px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="mas-img">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                <div class="product-name">
                    <h3>{{ucwords(strtolower($product->product_name))}} </h3>
                    <h3>{{CommonFunction::GetSingleField('category','category_name','category_id',$product->category_id)}}</h3>
                    <p class="mt-5"><span class="star-rating">@if($product->rating == 1) <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 2) <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 3) <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($product->rating == 4) <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 5) <i class="fas fa-star"></i> <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif<span
                                class="cust-review ml-2"></span></p>
                    <p class="indrupee"> &#8377 <span class="yerupee">{{number_format($product->selling_price,2,'.',',')}}</span></P>
                    <hr>
                    <p class="guide-text">{{$product->description}}</P>
                    @if(Session::get('role_id') == 3)
                        <div class="check-out mb-2">
                            <button type="button" onclick="addToCart('{{$id}}','{{Session::get('user_id')}}')" class="checkbtn btn">Add to Cart</button>
                            <!-- <button type="button" href="{{url('checkout')}}" class="cartbtn btn ml-3">Checkout</button> -->
                        </div>
                    @endif
                    <!-- <a href="#" class="wisha mr-3"><i class="fa fa-heart" aria-hidden="true"><span
                                class="ml-2 addlis">Browse
                                Wishlist</span></i></a>
                    <a href="#" class="wisha"><i class="fa fa-balance-scale" aria-hidden="true"></i><span
                            class="ml-2 addlis">Add to compare</span></i></a> -->
                </div>
            </div>
        </div>
        <hr class="mt-0">
    </div>
</section>
<section id="about-inst" class="about-inst">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="Des-book">
                    <h4 class="bold-heading">Description</h4>
                    <p>{{$product->description}}
                    </P>
                </div>
                <div class="des-instru">
                    <h4 class="bold-heading">Instructions</h4>
                    <p>{{$product->instructions}}</p> 
                </div>
            </div>
            <div class="seperator"></div>
            <div class="col-md-6">
                <div class="refer-book">
                    <h4 class="bold-heading">References</h4>
                    <p>{{$product->referenceses}}</p> 
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>
@include('include.footer')
<script>
function addToCart(id, userid){  
    if(userid == ''){
        window.location.href = "{{url('user_login')}}";
    }
    $.ajax({ 
        type:'POST',
        url: "{{route('addtocart')}}",
        data:  { userid: userid, id: id ,"_token": "{{ csrf_token() }}"},
        dataType: "json",
        success: function(response) {   
            console.log(response.message); 
            window.location.reload();
           alert(response.message);  
        },error: function(xhr,status,error){  
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err.message); 
        }
    });  
}

 
</script>
@include('include.footer_bottom') 
 