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
                        <h3 class="order-content">Experts</h3> 
                    
                        <form action="{{route('our_experts')}}"class="form-appoint">
                            <input type="text" name="keyword" value="{{$request['keyword']}}" class=""> 
                            <a href="#"> <button type="submit" class="filter" style="margin-left:0px">Filter</button></a>
                            <a href="{{url('experts')}}"> <button type="button" class="filter" style="margin-left:0px">Clear Filter</button></a>
                        </form>
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
                                @if(count($experts)>0)
                                    @foreach($experts as $expert)
                                        <?php $feedback_count   = DB::table('feedback')->where('feedback_to',$expert->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->count();
                                        $feedback_data    = DB::table('feedback')->where('feedback_to',$expert->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->sum('rating');
                                        $rating = 0;
                                        if($feedback_count >0 && $feedback_data >0){
                                            $rating = round(($feedback_data/$feedback_count));       
                                        } ?>
                                        <!-- {{$rating}} -->
                                        <tr>
                                            <td>{{$expert->user_id}}</td> 
                                            <td>{{$expert->full_name}}</td> 
                                            <td><img style="width: 150px;  height: 150px;" src="{{asset('public/user_images/'.$expert->user_image)}}"></td> 
                                            <td>{{CommonFunction::GetSingleField('designation','designation_title','designation_id',$expert->designation_id)}}</td>
                                            <td><span class="star-rating">@if($rating == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($rating == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($rating == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</td>
                                            <td><span class="star-rating">{{$expert->address_details}}</td>
                                            <td>
                                                <a style="position: relative;background-color: var(--yellow); height: 32px; padding: 5px 20px; border-radius: 3px; color: var(--white); font-size: 14px;" href="{{route('expert.details',$expert->user_id)}}" class="commonHeading">View Profile</a> 
                                                <a href="{{route('appointment.create')}}" class="readMoreCta">Book Appointment</a> 
                                            </td>
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
                    {{$experts->appends($request->all())->render('vendor.pagination.custom')}} 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal')
 