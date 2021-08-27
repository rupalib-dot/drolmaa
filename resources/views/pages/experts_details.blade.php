@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments"> 
   <div class="container-fluid">
    <div class="row">
        <div class="header_expert">
           <div class="mt-3 mb-3 text-center">
               <h3>Expert Listing</h3>
             
           </div>
           <div class="container mb-4">
                <form action="{{route('our_experts')}}"class="form-appoint"> 
                    <div class="input-group">
                        <div class="my-2  col-md-3">
                            <input type="text" class="form-control" name="keyword" value="{{$request['keyword']}}" placeholder="Keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        </div>
                        <div class="my-2  col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1" placeholder="Designation" name="designation" aria-label="Designation" aria-describedby="basic-addon2">
                                <option value="">Designation</option>
                                @foreach($designation_list as $designation)
                                    <option {{ old('designation',$request['designation']) == $designation->designation_id ? 'selected' : ''}} value="{{$designation->designation_id}}">{{ucfirst(strtolower($designation->designation_title))}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-2  col-md-3">
                            <select class="form-control" id="exampleFormControlSelect1" placeholder="Specialization" name="specialization" aria-label="Specialization" aria-describedby="basic-addon2">
                                <option value="">Specialization</option>
                                @foreach($specialPlans as $value => $key)
                                    <option {{ old('specialization',$request['specialization']) == $key ? 'selected' : ''}} value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-2 col-md-3">
                        <button type="submit" class="w-100 btn btn-outline-danger">Search</button>    
                        </div>  
                    </div>
                </form>
           </div>
        </div>
    </div>
   </div>
   <div class="container">
       <div class="row">
           <div class="pt-4 col-lg-4">
               <div class=" filter_exper_list border border-2 w-100">
                    <div class="text-muted px-3 pt-3">
                        <h3>Filter</h3>
                    </div>
                    <hr/>
                    <div class="p-3">
                        <h6>SPECIALIZATION</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <hr/>
                        <h6>LOCALITY</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >lorem ipsum</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >lorem ipsum</span>
                        </div>
                        <hr/>
                        <h6>AVAILABILITY</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Today</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Tomorrow</span>
                            <!-- <span class="ml-5">Add</span> -->
                        </div>
                        <hr/>
                        <h6>CLINIC FEES</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <hr/>
                        <h6>GENDER</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Male</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Female</span>
                        </div>
                        <hr/>
                    </div>
                </div>
           </div>
                <div class="pt-4  col-lg-8">
                @include('include.validation_message')
                    @include('include.auth_message')
                    @if(count($experts)>0)
                        @foreach($experts as $expert)
                            <?php $feedback_count   = DB::table('feedback')->where('feedback_to',$expert->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->count();
                            $feedback_data    = DB::table('feedback')->where('feedback_to',$expert->user_id)->where('module_type',config('constant.FEEDBACK.APPOINMENT'))->sum('rating');
                            $rating = 0;
                            if($feedback_count >0 && $feedback_data >0){
                                $rating = round(($feedback_data/$feedback_count));       
                            }
                            //availability data
                            $availSlots=array();
                            $avail_slots = DB::table('availability')->where('user_id',$expert->user_id)->get();
                            if(count($avail_slots) >0){
                                $availSlots =  CommonFunction::getslotsData($expert->user_id);
                                
                            }?>
                                <div class="card border-0  mb-3" style="max-width:100%;">
                                    <div class="row no-gutters">
                                        <div class="col-md-3">
                                        <img width="100%;" height="130px;" src="@if(!empty($expert->user_image)) {{asset('public/user_images/'.$expert->user_image)}} @else {{asset('front_end/images/blogimg.jpg')}} @endif" class="card-img" alt="...">
                                            <div class="pl-0 expert_button">
                                                <a style="min-width: 100%; text-align:center" href="{{route('expert.details',$expert->user_id)}}" target="_blank">View Profile</a> 
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$expert->full_name}}</h5>
                                                <p class="text-muted">{{CommonFunction::GetSingleField('designation','designation_title','designation_id',$expert->designation_id)}}</p>
                                                <p class="text-muted">{{$expert->user_experience}} Years Experience Overall</p>
                                                <div class="my-1 d-flex">
                                                    <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                                    <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">{{$expert->$rating}}</span> @if($rating == 1) <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 2) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @elseif($rating == 3) <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> @elseif($rating == 4) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="far fa-star"></i> @elseif($rating == 5) <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i>  <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> <i class="fas fa-star checked"></i> @else <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> @endif</span>
                                                </div>
                                                @if(count($availSlots) >0)
                                                    @foreach($availSlots as $slots)
                                                        @if($slots['availability_id'] == date('Y-m-d'))
                                                            @if($slots['available_slots'] >0) 
                                                                <p class="text-muted mb-0">{{$slots['available_slots']}} Available Slots ({{$slots['date']}})</p>
                                                                <!-- <p class="text-muted mb-0">Available Slots ({{$slots['available_slots']}})</p> -->
                                                                <!-- <p class="text-muted mb-0">Booked Slots ({{$slots['booked_slots']}})</p> -->
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
                                                    @if(Session::get('role_id') != 2)
                                                    <a style="text-align:center; margin-left: 60%;" href="{{route('appointment.create',['designation_id'=>$expert->designation_id,'user_id'=>$expert->user_id])}}">Book Appointment</a>
                                                    @endif
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <?php  $favExist = \DB::table('favourate')->where(['product_id' => $expert->user_id,'user_id'=>Session::get('user_id'),'module_type'=>config('constant.WISHLIST.EXPERT')])->first();?>
                                            @if(!empty($favExist))
                                                <i onclick="addTofavourat('{{$expert->user_id}}','{{config('constant.WISHLIST.EXPERT')}}','{{Session::get('user_id')}}')" style="color:#952A16;font-size: 30px; cursor:pointer;color:#952A16;" class="fas fa-heart"></i> 
                                            @else
                                                <img onclick="addTofavourat('{{$expert->user_id}}','{{config('constant.WISHLIST.EXPERT')}}','{{Session::get('user_id')}}')" style="cursor:pointer;color:#952A16;" src="{{asset('front_end/images/like.png')}}" alt="" class=" img-fluid like-img">
                                            @endif   
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                        @endforeach
                    @else 
                        <div class="card border-0  mb-3" style="max-width:100%;">
                            <div class="row no-gutters">
                                <h3 style="margin: auto;"> No Record Found</h3>
                            </div>
                        </div> 
                    @endif
                     
                    <nav class="mb-4 mt-4" aria-label="Page navigation example">
                    {{$experts->appends($request->all())->render('vendor.pagination.custom')}} 
                        <!-- <ul class="pagination justify-content-start">
                            <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="active   page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                            </li>
                        </ul> -->
                    </nav>
                </div>
                
       </div>
   </div>
 
</section>
<script>
    
function addTofavourat(id,module_type, userid){  
    if(userid == ''){
        window.location.href = "{{url('user_login')}}";
    }else{
        $.ajax({ 
            type:'POST',
            url: "{{route('addtofavourate')}}",
            data:  { userid: userid, id: id,module_type:module_type, "_token": "{{ csrf_token() }}"}, 
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
}
    </script>
@include('include.footer')
@include('include.script')
@include('include.modal')
 