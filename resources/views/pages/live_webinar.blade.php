@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint"> 
                    <div class="dashboard-panel">
                        @include('include.validation_message')
                        @include('include.auth_message')
                        <h3 class="order-content">Live Webinar</h3> 
                     
                        <table class="table table-bordered appoint-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Designation</th>
                                    <th style="width: 150px;">Rating</th>
                                    <th>Address Details</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($workshop_detail)>0)
                                    @foreach($workshop_detail as $workshops) 
                                        <tr>
                                            <td>{{$expert->user_id}}</td> 
                                            <td>{{$expert->full_name}}</td> 
                                            <td><img style="width: 150px;  height: 150px;" src="{{asset('public/user_images/'.$expert->user_image)}}"></td> 
                                            <td>{{CommonFunction::GetSingleField('designation','designation_title','designation_id',$expert->designation_id)}}</td>
                                            <td><span class="star-rating">@if($rating == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($rating == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($rating == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</td>
                                            <td><span class="star-rating">{{$expert->address_details}}</td>
                                           
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">No Record Found</td>
                                    </tr>
                                @endif
                            </tbody> 
                        </table>
                    </div>
                    <div class="paginationPara">
                    {{$workshop_detail->appends($request->all())->render('vendor.pagination.custom')}} 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal')
 