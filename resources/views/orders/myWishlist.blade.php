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
                        <div class="col-md-9">
                        @include('include.validation_message')
                        @include('include.auth_message')
                            <div class="dashboard-panel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h3 class="order-content">My Wishlist</h3>
                                    </div>
                                    
                                    <div class="col-lg-6" style="text-align:right;padding-top: 20px;">
                                        <span class="view-icon"><a style="color:white" onclick="dele_multi()" class="btn btn-danger">DELETE</a></span> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a href="#"><button class="w-100 @if(!isset($request['type']) || $request['type'] == 'current') curent-appoint @else previous-appoint @endif">Expert List</button></a>
                                    </div>
                                    <div class="col-lg-6">
                                        
                                <a href="#"><button class="w-100 @if($request['type'] == 'previous') curent-appoint @else previous-appoint @endif">Product List </button></a>
                                    </div>
                                </div>
                                
                                {{-- <table class="my-3 table table-bordered appoint-table" style="width:100%">
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
                                                    </td>
                                                </tr> 
                                            @endforeach
                                        @else
                                            <tr>
                                                <td  colspan="6">No wishlist product available</td>
                                            </tr> 
                                        @endif
                                    </tbody>
                                </table> --}}
                            </div>
                            <div class="shadow p-3 mb-5 bg-white rounded  p-3 card border-0  mb-3" style="max-width:100%;">
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                    <img width="100%;" height="130px;" src="#" class="card-img" alt="...">
                                        <div class="pl-0 expert_button">
                                            <a style="min-width: 100%; text-align:center" href="#">View Profile</a> 
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title">Expert Name</h5>
                                            <p class="text-muted">designation</p>
                                            <p class="text-muted">user_experience Years Experience Overall</p>
                                            <div class="my-1 d-flex">
                                                <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                                <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">rating</span>  <i class="fas fa-star checked"></i>                                            </div>
                                         
                                               
                                                    
                                                       
                                                            <p class="text-muted mb-0"> Available Slots</p>
                                                            <!-- <p class="text-muted mb-0">Available Slots</p> -->
                                                            <!-- <p class="text-muted mb-0">Booked Slots</p> -->
                                                            <div class="pl-3 row">
                                                                <div class="pl-0 col-lg-12 expert_time_slot">                           
                                            <div class="pl-0 col-lg-12 expert_button">
                                                <a style="display:none; text-align:center" href="" target="_blank"></a>
                                                <a style="text-align:center; margin-left: 60%;" href="{{route('appointment.create')}}" target="_blank">Book Appointment</a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
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

