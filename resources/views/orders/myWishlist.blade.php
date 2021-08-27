@include('include.header')
@include('include.nav')
<style> 
.checked{
   color: #ffc800;
}
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
    
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @if(Session::get('role_id') == 3)
                            @include('include.client_sidebar')
                        @elseif(Session::get('role_id') == 2)
                            @include('include.expert_sidebar')
                        @endif
                        <div class="col-lg-9">
                        @include('include.validation_message')
                        @include('include.auth_message')
                            <div class="dashboard-panel">
                                <div class="row my-4">
                                    <div class="col-lg-6">
                                        <h3 class="order-content">My Wishlist</h3>
                                    </div>
                                    @if(Session::get('role_id') == 3 && $request['module'] == 'product')
                                    <div class="col-lg-6 text-lg-right">
                                        <span class="view-icon"><a style="color:white" onclick="dele_multi()" class="btn btn-danger">DELETE</a></span> 
                                    </div>
                                    @endif
                                </div>
                                <div class="my-3 row">
                                    @if(Session::get('role_id') != 2)
                                        <div class="mt-3 col-lg-6">
                                            <a href="{{route('customer.myWishlist',['module'=>'expert'])}}"><button class="w-100 @if(!isset($request['module']) || $request['module'] == 'expert') curent-appoint @else previous-appoint @endif">Expert List</button></a>
                                        </div>
                                        <div class="mt-3 col-lg-6"> 
                                            <a href="{{route('customer.myWishlist',['module'=>'product'])}}"><button class="w-100 @if($request['module'] == 'product') curent-appoint @else  previous-appoint @endif">Product List </button></a>
                                        </div>
                                    @endif
                                    
                                </div>
                                @if($request['module'] == 'product')
                                    <table class="my-3 table table-bordered appoint-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th style="width: 150px;">Product Name</th>
                                                <th style="width: 150px;">Image</th>
                                                <th style="width: 150px;">Category</th> 
                                                <th style="width: 150px;">Price</th> 
                                                <th style="width: 250px;">Rating</th> 
                                                <th style="width: 150px;">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($favourate)>0)
                                                @foreach($favourate as $getData) 
                                                @php $product = CommonFunction::GetSingleRow('products','product_id',$getData->product_id);@endphp 
                                                    <tr>
                                                        <td><input type="checkbox" value="{{$getData->favourate_id}}" class="mul_del" id="mul_del" name="mul_del[]"></td>
                                                        <td>{{ucwords(strtolower($product->product_name))}}</td>
                                                        <td><?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$product->product_id)?>
                                                            <img style="width: 100px;height: 100px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="mas-img"> 
                                                        </td>
                                                        <td>{{CommonFunction::GetSingleField('category','category_name','category_id',$product->category_id)}}</td> 
                                                        <td><i class="fas fa-rupee-sign"></i> {{number_format($product->selling_price,2,'.',',')}}</td>
                                                        <td><span class="star-rating">@if($product->rating == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($product->rating == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($product->rating == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</td>
                                                        <td class="cancel-icon">
                                                            <span class="view-icon"><a href="{{route('page.shopDetail',$product->product_id)}}"><i class="fas fa-eye"></i></a></span> 
                                                            <span class="view-icon"><a onclick="return confirm('Are you sure you want to delete product from wishlist?')" href="{{route('wishlist.delete',['favourate_id'=>$getData->favourate_id])}}"><i class="fas fa-trash"></i></a></span> 
                                                            <button type="button" class="btn btn-danger btn_small btn-sm" onclick="addToCart('{{$getData->product_id}}','{{Session::get('user_id')}}')">Add To Cart</button>
                                                        </td>
                                                    </tr> 
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td  colspan="6">No wishlist product available</td>
                                                </tr> 
                                            @endif
                                        </tbody>
                                    </table>
                                @else
                                    @if(Session::get('role_id') != 2)
                                        @if(count($favourate)>0)
                                            @foreach($favourate as $getData) 
                                                @php $expert = CommonFunction::GetSingleRow('users','user_id',$getData->product_id);
                                                    //feedback data
                                                    $feedback    = DB::table('feedback')->where('feedback_to',$getData->product_id)->where('module_type','!=',config('constant.FEEDBACK.ORDER'))->get();
                                                    $feedback_data    = DB::table('feedback')->where('feedback_to',$getData->product_id)->where('module_type',config('constant.FEEDBACK.ORDER'))->sum('rating');
                                                    $rating = 0;
                                                    if($feedback_data > 0 && count($feedback) >0){
                                                        $feedback_count = count($feedback);
                                                        $rating = round($feedback_data/$feedback_count);       
                                                    } 
                                                    //availability data
                                                    $availSlots=array();
                                                    $avail_slots = DB::table('availability')->where('user_id',$getData->product_id)->get();
                                                    if(count($avail_slots) >0){
                                                        $availSlots =  CommonFunction::getslotsData($getData->product_id);
                                                    } 
                                                @endphp 
                                                <div class="shadow p-3 mb-5 bg-white rounded  p-3 card border-0  mb-3" style="max-width:100%;">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-3">
                                                        <img width="100%;" height="130px;" src="@if(!empty($expert->user_image)) {{asset('public/user_images/'.$expert->user_image)}} @else {{asset('front_end/images/blogimg.jpg')}} @endif" class="card-img" alt="...">
                                                            <div class="pl-0 expert_button">
                                                                <a style="min-width: 100%; text-align:center" href="{{route('expert.details',$getData->product_id)}}">View Profile</a> 
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{$expert->full_name}}</h5>
                                                                <p class="text-muted">{{CommonFunction::GetSingleField('designation','designation_title','designation_id',$expert->designation_id)}}</p>
                                                                <p class="text-muted">{{$expert->user_experience}} Years Experience Overall</p>
                                                                <div class="my-1 d-flex">
                                                                    <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                                                    <span class="align-self-center"><span class="align-self-center"><span class="ml-2 text-success font-weight-bold">{{$rating}}</span> @if($rating == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($rating == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($rating == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</span></div> 
                                                                    @if(count($availSlots) >0)
                                                                        @foreach($availSlots as $slots)
                                                                            @if($slots['availability_id'] == date('Y-m-d'))
                                                                                @if($slots['available_slots'] >0)
                                                                                    <p class="text-muted mb-0">Todays Slots</p>
                                                                                    <p class="text-muted mb-0">Available Slots ({{$slots['available_slots']}})</p>
                                                                                    <p class="text-muted mb-0">Booked Slots ({{$slots['booked_slots']}})</p>
                                                                                    <div class="pl-3 row">
                                                                                        <div class="pl-0 col-lg-12 expert_time_slot">
                                                                                            @if(count($slots['time_slot'])>0)
                                                                                                @foreach($slots['time_slot'] as $time)
                                                                                                <p>{{$time['start_time']}}</p> 
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </div> 
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    @endif 
                                                                <div class="pl-0 col-lg-12 expert_button">
                                                                    <a style="display:none; text-align:center" href="" target="_blank"></a>
                                                                    <a style="text-align:center; margin-left: 60%;" href="{{route('appointment.create',['designation_id'=>$expert->designation_id,'user_id'=>$getData->product_id])}}" target="_blank">Book Appointment</a>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                        <div class="shadow p-3 mb-5 bg-white rounded  p-3 card border-0  mb-3" style="max-width:100%;">
                                        No Record Found
                                                </div>
                                        @endif
                                    @else
                                        <table class="my-3 table table-bordered appoint-table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="width: 150px;">Product Name</th>
                                                    <th style="width: 150px;">Image</th>
                                                    <th style="width: 150px;">Category</th> 
                                                    <th style="width: 150px;">Price</th> 
                                                    <th style="width: 250px;">Rating</th> 
                                                    <th style="width: 150px;">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($favourate)>0)
                                                    @foreach($favourate as $getData) 
                                                    @php $product = CommonFunction::GetSingleRow('products','product_id',$getData->product_id);@endphp 
                                                        <tr>
                                                            <td><input type="checkbox" value="{{$getData->favourate_id}}" class="mul_del" id="mul_del" name="mul_del[]"></td>
                                                            <td>{{ucwords(strtolower($product->product_name))}}</td>
                                                            <td><?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$product->product_id)?>
                                                                <img style="width: 100px;height: 100px;" src="<?php if(!empty($image_name)){?>{{asset('products/'.$image_name)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>" alt="" class="mas-img"> 
                                                            </td>
                                                            <td>{{CommonFunction::GetSingleField('category','category_name','category_id',$product->category_id)}}</td> 
                                                            <td><i class="fas fa-rupee-sign"></i> {{number_format($product->selling_price,2,'.',',')}}</td>
                                                            <td><span class="star-rating">@if($product->rating == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($product->rating == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($product->rating == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($product->rating == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</td>
                                                            <td class="cancel-icon">
                                                                <span class="view-icon"><a href="{{route('page.shopDetail',$product->product_id)}}"><i class="fas fa-eye"></i></a></span> 
                                                                <span class="view-icon"><a onclick="return confirm('Are you sure you want to delete product from wishlist?')" href="{{route('wishlist.delete',['favourate_id'=>$getData->favourate_id])}}"><i class="fas fa-trash"></i></a></span> 
                                                                <button type="button" class="btn btn-danger btn_small btn-sm" onclick="addToCart('{{$getData->product_id}}','{{Session::get('user_id')}}')">Add To Cart</button>
                                                            </td>
                                                        </tr> 
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td  colspan="6">No wishlist product available</td>
                                                    </tr> 
                                                @endif
                                            </tbody>
                                        </table>
                                    @endif
                                @endif
                            </div> 
                            <div class="paginationPara">
                            {{$favourate->appends($request->all())->render('vendor.pagination.custom')}}
                                <!-- <ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Previouss</button>
                                        </a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Next</button>
                                        </a></li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal')


<script>
function addToCart(id, userid){  
    if(userid == ''){
        window.location.href = "{{url('user_login')}}";
    }else{
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
}
function dele_multi(){
    var areaofinterest = '';

	$('.mul_del').each(function(i,e) {
        if ($(e).is(':checked')) {
            var comma = areaofinterest.length===0?'':',';
            areaofinterest += (comma+e.value);
        }
    });
    if(areaofinterest != ''){
        if (confirm('Are you sure you want to delete product from wishlist?')) {
            $.ajax({ 
                type:'POST',
                url: "{{url('del_multi_wishlist')}}",
                data:  { areaofinterest: areaofinterest, "_token": "{{ csrf_token() }}"},
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
    }else{
        bootbox.alert("Please select atleast one product to delete!");
    }
}
</script>

