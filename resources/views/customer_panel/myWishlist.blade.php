@include('include.header')
@include('include.nav')
<style> 
.checked{
   color: #ffc800;
}
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
    
        <div class="row">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.client_sidebar')
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
                                <table class="table table-bordered appoint-table" style="width:100%">
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
                                </table>
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

