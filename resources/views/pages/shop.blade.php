@include('include.header')
@include('include.nav')
<style> 
.fas, .far{
   color: #ffc800;
}
</style>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/shopimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Shop</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-product" class="about-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="product-name">
                    <h3>Product with Medicine</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="product-des" class="product-des">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                <div class="full-box" style="padding-bottom: 10px;">
                    <div class="categ-pro">
                        <p class="lag-catag">Categories</p>
                    </div>
                    <hr>
                    <div class="search-input">
                        <form action="{{route('page.shop')}}" class="form-appoint">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary ss" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @if(count($category)>0)
                        @foreach($category as $cat)
                            <div class="theropy-tool" >
                                <p class="the-para">{{$cat->category_name}}</p>
                                <?php $getData = CommonFunction::GetData('products','category_id',$cat->category_id);
                                if(count($getData)>0){
                                    foreach($getData as $data){?>
                                        <div class="form-check list-regular">
                                            <!-- <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked1" checked> -->
                                            <a href="{{route('page.shopDetail',$data->product_id)}}">
                                                <label style="cursor: pointer;" class="form-check-label text-color" for="flexCheckChecked1">
                                                    {{$data->product_name}}
                                                </label>
                                            </a>
                                        </div> 
                                <?php }} ?>
                            </div> 
                        <hr> 
                        @endforeach
                    @else
                        No Record Found
                    @endif
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    @if(count($products)>0)
                        @foreach($products as $prod)
                            <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3"> 
                                    <div class="product-box">
                                        <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$prod->product_id);
                                        $favExist = CommonFunction::GetMultiWhereData('favourate','product_id',$prod->product_id,'user_id',Session::get('user_id'))?>
                                        <img src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="img-fluid m-icos">
                                        <div class="overlay"></div> 
                                        <div class="wis-lis"> 
                                            @if(!empty($favExist))
                                                <i onclick="addTofavourat('{{$prod->product_id}}','{{Session::get('user_id')}}')" style="color:#952A16;font-size: 30px;" class="fas fa-heart"></i>
                                            @else
                                                <img onclick="addTofavourat('{{$prod->product_id}}','{{Session::get('user_id')}}')" src="{{asset('front_end/images/like.png')}}" alt="" class=" img-fluid like-img">
                                            @endif
                                            @if(Session::get('role_id') == 3)
                                                <img src="{{asset('front_end/images/shopping-cart.png')}}" alt="" onclick="addToCart('{{$prod->product_id}}','{{Session::get('user_id')}}')" class=" img-fluid like-img"> 
                                            @endif
                                            <a href="{{route('page.shopDetail',$prod->product_id)}}"><img src="{{asset('front_end/images/view.png')}}" alt="" class=" img-fluid like-img"> </a>
                                        </div>
                                    </div>
                                    <a href="{{route('page.shopDetail',$prod->product_id)}}">
                                        <h5 class="tool-the">{{$prod->product_name}}</h5>
                                        <p class="tool-para"> {{CommonFunction::GetSingleField('category','category_name','category_id',$prod->category_id)}}</p>
                                        <p class="indrupee"> &#8377 <span class="yerupee">{{$prod->selling_price}}</span></P>
                                        <p class="mb-5">{{$prod->rating}} <span class="star-rating">@if($prod->rating == 1) <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($prod->rating == 2) <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($prod->rating == 3) <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($prod->rating == 4) <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> @elseif($prod->rating == 5) <i class="fas fa-star"></i> <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</p>
                                    </a>
                            </div> 
                        @endforeach
                    @else
                        No Record Found
                    @endif
                </div>
            </div>
        </div>
</section>
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
function addTofavourat(id, userid){ 
    if(userid == ''){
        window.location.href = "{{url('user_login')}}";
    }
    $.ajax({ 
        type:'POST',
        url: "{{route('addtofavourate')}}",
        data:  { userid: userid, id: id, "_token": "{{ csrf_token() }}"}, 
        dataType: "json", 
        success: function(response) {  
            console.log(response.message); 
            window.location.reload();
           alert(response.message); 
        },
        error: function(xhr,status,error){  
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err.message);    
        }
    }); 
}
</script>
@include('include.footer')
@include('include.footer_bottom') 