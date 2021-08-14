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
            <dv cliass="row">
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
                                            <td><a target="_blank" href="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>"><img style="    width: 100px; height: 100px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="img-pro"></a>
                                                <h4 class="fnt mt-2">{{$getData->product_name}}</h4>
                                            </td>
                                            <td class="py-0">
                                                <p class="indrupee"> &#8377 <span class="yerupee">{{number_format($getData->price,2,'.',',')}}</span></P>
                                            </td>
                                            <td class="py-0">
                                                <div class="qty-input">
                                                    <button @if($getData->quantity ==1) disabled @endif onclick="updateCartqty('{{$getData->product_id}}','{{Session::get("user_id")}}','sub')" id="{{$getData->cart_id}}" class="qty-count qty-count--minus" data-action="minus"
                                                        type="button">-</button>
                                                    <input class="product-qty" type="number" name="product-qty" min="0" max="10" data-id="{{$getData->cart_id}}"
                                                        value="{{$getData->quantity}}" readOnly>
                                                    <button id="{{$getData->cart_id}}" onclick="updateCartqty('{{$getData->product_id}}','{{Session::get("user_id")}}','add')" class="qty-count qty-count--add" data-action="add"
                                                        type="button">+</button>
                                                </div>
                                            </td>
                                            <td class="text-red py-0"><i class="fas fa-rupee-sign"></i>{{number_format($getData->total_price, 2,'.',',')}}</td>
                                            <td class="text-red py-0"><span class="view-icon" title="Delete"><a onclick="return confirm('Are you sure you want to delete this item?')" href="{{route('cartItem.delete',['id'=>$getData->cart_id,'delType'=>'single'])}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td> Grand Total</td>
                                        <td class="py-0"></td>
                                        <td class="py-0"></td>
                                        <td class="text-red py-0"><i class="fas fa-rupee-sign"></i>{{number_format($totalcartamount,2,'.',',')}}</td>
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
                            {{-- <li><a href="{{route('cartItem.delete',['id'=>Session::get('user_id'),'delType'=>'all'])}}"><button class="apply btn ">Delete Cart</button></a></li> --}}
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
                                    <td class="text-red text-center"><i class="fas fa-rupee-sign"></i>{{number_format($totalcartamount,2,'.',',')}}</td>
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
                                    <td class="text-red text-center"><i class="fas fa-rupee-sign"></i>{{number_format($totalcartamount,2,'.',',')}}</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    @if(count($cart)>0) 
                    <!-- Button trigger modal -->
                    <button type="button" class="update btn mt-3" data-toggle="modal" data-target="#exampleModal">Proceed to checkout</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Enter Your Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    @include('include.validation_message')
                                        @include('include.auth_message')
                                        <form action="{{route('placeOrder')}}" method="POST" class="formLogIn">
                                            @csrf
                                            <div class="row"> 
                                                <div class="col-md-12 ">
                                                    <?php $session = Session::get('order'); ?>
                                                    <div class="billing-detail">
                                                        <h3 class="billing-text mb-4">Billing details</h3> 
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control" placeholder="Full Name*" name="full_name" id="first name" value="{{old('full_name',!empty($session) ? $session['full_name'] : '',!empty($user) ? $user['full_name'] : '')}}">
                                                                    </div>
                                                                </div>  
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <select class="form-control" id="exampleFormControlSelect1" name="user_gender">
                                                                            <option value="">Select Gender *</option>
                                                                            @foreach(config('constant.GENDER') as $value => $key)
                                                                                <option {{ old('user_gender',!empty($session) ? $session['user_gender'] : '',!empty($user) ? $user['user_gender'] : '') == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control" placeholder="Company Name (optional)" aria-label="Name"
                                                                            aria-describedby="basic-addon1" name="company_name" value="{{old('company_name',!empty($session) ? $session['company_name']:'')}}">
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control" id="address" placeholder="House Number and street name *" aria-label="Address"
                                                                            aria-describedby="basic-addon1" name="address1" maxlength="250" value="{{old('address1',!empty($session) ? $session['address1']:'',!empty($user) ? $user['address_details'] : '')}}">
                                                                        <input type="text" class="form-control" id="address" placeholder="Apartment, suite, unit, etc, (optional)" aria-label="Address"
                                                                            aria-describedby="basic-addon1" name="address2" maxlength="250"  value="{{old('address2',!empty($session) ? $session['address2']:'')}}" style="margin-top:15px">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    {{-- <div class="form-group"> 
                                                                        <select class="form-control" class="form-control country_id" id="exampleFormControlSelect1" name="country_id" onchange="state_list(this.value)">
                                                                            <!-- <option value="">Select Country / Region *</option>
                                                                            @foreach($country_list as $con_list)
                                                                                <option {{ old('country_id',!empty($session) ? $session['country_id']:'',!empty($user) ? $user['country_id'] : '') == $con_list->country_id ? 'selected' : ''}} value="{{$con_list->country_id}}">{{$con_list->country_name}}</option>
                                                                            @endforeach -->
                                                                            <option value="101">India<option>
                                                                            
                                                                        </select>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="hidden" name="state_id_hidden" id="state_id_hidden" value="{{old('state_id',!empty($session) ? $session['state_id']:'',!empty($user) ? $user['state_id'] : '')}}">
                                                                        <select class="form-control state_list" id="exampleFormControlSelect1"
                                                                            name="state_id" onchange="city_list(this.value)">
                                                                            <option value="">Select State *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="hidden" name="city_id_hidden" id="city_id_hidden" value="{{old('city_id',!empty($session) ? $session['city_id']:'',!empty($user) ? $user['city_id'] : '')}}">
                                                                        <select class="form-control city_list" id="exampleFormControlSelect1"
                                                                            class="form-control" name="city_id">
                                                                            <option value="">Select Town / City *</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control" placeholder="Pin Code *" aria-label="Pin code"
                                                                            aria-describedby="basic-addon1" id="pincode" name="pincode" value="{{old('pincode',!empty($session) ? $session['pincode']:'')}}"> 
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-2" style="padding-right:0px">
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control" aria-label="Country Code" aria-describedby="basic-addon1" name="country_code" value="+91" ReadOnly>
                                                                            </div> 
                                                                        </div>
                                                                        <div class="col-lg-10" style="padding-left:0px">  
                                                                            <div class="form-group"> 
                                                                                <input type="text" class="form-control" placeholder="Mobile Number *"
                                                                                    aria-label="Mobile Number" aria-describedby="basic-addon1" name="mobile_number" value="{{old('mobile_number',!empty($session) ? $session['mobile_number']:'',!empty($user) ? $user['mobile_number'] : '')}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group"> 
                                                                        <input type="text" class="form-control" placeholder="Email Address *" aria-label="Email"
                                                                            aria-describedby="basic-addon1" name="email_address" value="{{old('email_address',!empty($session) ? $session['email_address']:'',!empty($user) ? $user['email_address'] : '')}}">
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="form-check list-regular ml-3">
                                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedaccount"
                                                                        checked>
                                                                    <label class="form-check-label" for="flexCheckCheckedaccount">
                                                                        Create an account?
                                                                    </label>
                                                                </div> -->
                                                            </div> 
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h3 class="billing-text mb-4">Your order</h3>
                                                    <div class="detail-cart h-fnt">
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
                                                                        <td class="text-red text-center"><i class="fas fa-rupee-sign"></i> {{number_format($totalcartamount,2,'.',',')}}</td>
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
                                                                        <td class="text-red text-center"><i class="fas fa-rupee-sign"></i> {{number_format($totalcartamount,2,'.',',')}}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary mt-3" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="update btn mt-3">Place order</button> 
                                                </div> 
                                            </div>
                                        </form>
                                    </div>
                            </div>

                        </div>
                        </div>
                    </div>
                        {{-- <a href="{{url('checkout')}}" class="update btn pl-0"><button class="update btn mt-3">Proceed to checkout</button></a> --}}
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
    <div class="mt-5 container">
        <div class="row">
            <div class="col-lg-6 input-group mb-3">
                <img src="{{asset('front_end/images/cart_coupon_img.svg')}}" alt="">
                <input type="text" class="ml-3 form-control" placeholder="Enter Coupon Code" aria-label="Recipient's username" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-danger" type="button" id="button-addon2">Apply coupon</button>
                </div>
            </div>
            <div class="col-md-4">
                <a href="{{route('page.shop')}}"><button class="update btn ">Update cart</button></a>
                        
            </div>
        </div>
    </div>
</section>

@include('include.footer')
@include('include.script')

<script> 
function updateCartqty(pid, userid,type){    
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



 