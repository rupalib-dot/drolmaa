@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/shopimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">My Cart</h2>
            </div>
        </div>
    </div>
</section>
<section id="your-cart" class="your-cart">
    <div class="container">
        @include('include.validation_message')
        @include('include.auth_message')
        @if(count($cart)>0)
            <div class="row">
                <div class="col-md-8 col-lg-8 col-xl-8">
                    <div class="cart-box">
                        <table class="table box-demo" style="margin-bottom:0px">
                            <thead class="text-black">
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if(count($cart)>0)
                                    @foreach($cart as $getData)
                                        <tr>
                                            <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$getData->product_id); ?>
                                            <td><img style="    width: 100px; height: 100px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="img-pro">
                                                <p class="fnt mt-2">{{$getData->product_name}}</p>
                                            </td>
                                            <td class="py-0">
                                                <p class="indrupee"> &#8377 <span class="yerupee">{{number_format($getData->price,2,'.',',')}}</span></P>
                                            </td>
                                            <td class="py-0">
                                                <div class="qty-input">
                                                    <button @if($getData->quantity ==1) disabled @endif onclick="updateCartqty('{{$getData->product_id}}','{{Session::get("user_id")}}','sub')" id="{{$getData->cart_id}}" class="qty-count qty-count--minus" data-action="minus"
                                                        type="button">-</button>
                                                    <input class="product-qty" type="number" name="product-qty" min="0" max="10" data-id="{{$getData->cart_id}}"
                                                        value="{{$getData->quantity}}" read only>
                                                    <button id="{{$getData->cart_id}}" onclick="updateCartqty('{{$getData->product_id}}','{{Session::get("user_id")}}','add')" class="qty-count qty-count--add" data-action="add"
                                                        type="button">+</button>
                                                </div>
                                            </td>
                                            <td class="text-red py-0">{{number_format($getData->total_price, 2,'.',',')}}</td>
                                            <td class="text-red py-0"><span class="view-icon" title="Delete"><a onclick="return confirm('Are you sure you want to delete this item?')" href="{{route('cartItem.delete',['id'=>$getData->cart_id,'delType'=>'single'])}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td> Grand Total</td>
                                        <td class="py-0"></td>
                                        <td class="py-0"></td>
                                        <td class="text-red py-0">{{number_format($totalcartamount,2,'.',',')}}</td>
                                        <td class="py-0"></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="5"> No Record Found</td> 
                                    </tr>
                                    
                                @endif
                            </tbody>
                        </table> 
                        <ul class="cart-select">
                            <!-- <li><a href="#"><button class="add btn ">Coupon code</button></a></li>
                            <li><a href="#"><button class="apply btn ">Apply coupon</button></a></li> -->
                            <li><a href="{{route('cartItem.delete',['id'=>Session::get('user_id'),'delType'=>'all'])}}"><button class="apply btn ">Delete Cart</button></a></li>
                            <li><a href="{{route('page.shop')}}"><button class="update btn ">Update cart</button></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4">
                    <div class="detail-cart">
                        <table class="table box-demo mb-0">
                            <thead class="text-black">
                                <tr>
                                    <th scope="col">Price Details</th>
                                    <th scope="col"></th>  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="mb-0">
                                    Total Price
                                    </td>
                                    <td class="text-red text-center">{{number_format($totalcartamount,2,'.',',')}}</td>
                                </tr>
                                <tr>
                                    <td class="mb-0">
                                    Shipping
                                    </td>
                                    <td class="text-center">Free shipping</td>
                                </tr>
                                <!-- <tr>
                                    <td class="mb-0">
                                    Discount
                                    </td>
                                    <td class="text-red text-center">-₹150</td>
                                </tr> -->
                                <tr>
                                    <td class="mb-0">
                                Total Amount
                                    </td>
                                    <td class="text-red text-center">{{number_format($totalcartamount,2,'.',',')}}</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    @if(count($cart)>0) 
                    <a href="{{url('checkout')}}" class="update btn pl-0"><button class="update btn mt-3">Proceed to checkout</button></a>
                    @endif
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <i style="font-size:200px" class="fas fa-cart-plus"></i> 
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <h4 style="margin-bottom:20px" > Your Drolmaa basket is empty</h4>
                    <a href="{{route('page.shop')}}"><button class="update btn ">Continue shopping</button></a>
                </div>
            </div>
        @endif
    </div>
</section>

@include('include.footer')
@include('include.script')

<script> 
function updateCartqty(pid, userid,type){   
    var qty = $(".product-qty").val();
    
    $.ajax({ 
        type:'POST',
        url: "{{route('updateCartQty')}}",
        data:  { userid: userid, pid: pid, type:type ,"_token": "{{ csrf_token() }}"},
        dataType: "json",
        success: function(response) {   
            console.log(response.message); 
            window.location.reload(); 
            // window.location.href="{{url('viewcart')}}";
           alert(response.message);  
        },error: function(xhr,status,error){  
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err.message); 
        }
    });  
}
 

</script> 



 