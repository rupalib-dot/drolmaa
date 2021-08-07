@include('admin.layouts.header')    
 
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
            <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;"> 
                
            <!-- <div class="container" style = "margin-left: 0px;max-width: 100% !important;padding-right: 0px!important;">                      -->
                <div class="row layout-top-spacing" style="width:100%"> 
                    <div id="basic" class="col-lg-12 col-sm-12 col-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">     
                                @include('admin.layouts.validation_message')
                                @include('admin.layouts.auth_message')      
                            </div> 
                                <a class="btn btn-primary" href="{{route('product.create')}}">Add Product</a> 
                            <div class="table-responsive mb-4 mt-4" style="overflow-x: scroll;"> 
                                <table id="alter_pagination" style="width:100%"> 
                                    <thead>  
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Name</th>  
                                            <th>Quantity</th>  
                                            <th>MRP</th>
                                            <th>Selling Price</th>
                                            <th>Expiry Date</th> 
                                            <th>Status</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>  
                                        @if(count($products)>0) 
                                            @php $i=1; @endphp 
                                            @foreach($products as $aGetData) 
                                                <tr> 
                                                    <td>{{$i}}</td>
                                                    <td>{{$aGetData->product_name}}</td> 
                                                    <td>{{$aGetData->quantity}}</td>
                                                    <td>{{$aGetData->mrp}}</td> 
                                                    <td>{{$aGetData->selling_price}}</td>
                                                    <td>{{date('d M,Y',strtotime($aGetData->expiry_date))}}</td>
                                                    <td>{{ucwords(strtolower(array_search($aGetData->status,config('constant.BLK_UNBLK'))))}}</td>
                                                    <td>
                                                        @if($aGetData->status == config('constant.BLK_UNBLK.BLOCK'))
                                                            <span class="view-icon" title="Unblock"><a onclick="return confirm('Are you sure you want to unblock this product?')" href="{{route('product.changeStatus',['id'=>$aGetData->product_id,'status'=>config('constant.BLK_UNBLK.UNBLOCK')])}}" style="cursor:pointer"><i class="fas fa-check"></i></a></span>
                                                        @elseif($aGetData->status == config('constant.BLK_UNBLK.UNBLOCK'))
                                                            <span class="view-icon" title="Block"><a onclick="return confirm('Are you sure you want to block this product?')" href="{{route('product.changeStatus',['id'=>$aGetData->product_id,'status'=>config('constant.BLK_UNBLK.BLOCK')])}}" style="cursor:pointer"><i class="fas fa-times"></i></a></span>
                                                        @endif
                                                        <span class="view-icon" title="Delete"><a onclick="return confirm('Are you sure you want to delete this product?')" href="{{route('product.delete',$aGetData->product_id)}}" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                        <span class="view-icon" title="Edit"><a href="{{route('product.edit',$aGetData->product_id)}}" style="cursor:pointer"><i class="fas fa-edit"></i></a></span>  
                                                        <span class="view-icon" title="Detail"><a href="{{route('product.show',$aGetData->product_id)}}" style="cursor:pointer"><i class="fas fa-eye"></i></a></span>  
                                                    </td>
                                                </tr> 
                                            @php $i++; @endphp
                                            @endforeach 
                                        @else
                                            <tr> 
                                                <td colspan="8">No Record Found</td>
                                            </tr> 
                                        @endif  
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   