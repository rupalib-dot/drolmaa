@extends('admin.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Products Listing </h4>
                            </div>
                        </div>
                    </div>
                    <!-- <form action="" method="GET">
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" maxlenght="6" class="form-control mb-3 mb-md-0" name="coupon_code" placeholder="Coupon Code" value="{{$request->coupon_code}}" onkeypress="return IsAlphaNum(event, this.value, '6')"> 
                                </div>
                                <div class="col-md-4 d-flex">
                                    <button class="btn btn-primary mr-3" type="submit">
                                        Filter
                                    </button>
                                    <button class="btn btn-danger" type="button" id="ClearFilter">
                                        Clear Filter
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form> -->
                </div>
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>  
                                    <tr> 
                                        <th>S.No</th>
                                        <th>Name</th>  
                                        <th>Quantity</th>  
                                        <th>MRP</th>
                                        <th> Category</th>
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
                                                <td><i class="fas fa-rupee-sign"></i> {{$aGetData->mrp}}</td> 
                                                <td>{{CommonFunction::GetSingleField('category','category_name','category_id',$aGetData->category_id)}}</td>
                                                <td><i class="fas fa-rupee-sign"></i> {{$aGetData->selling_price}}</td>
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
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$products->appends($request->all())->render('vendor.pagination.custom')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  
