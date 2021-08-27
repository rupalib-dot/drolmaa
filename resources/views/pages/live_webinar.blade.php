@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
        <div class="container-fluid">
            <div class="row">
                <div class="header_workshop">
                    <div class="mt-3 mb-3 text-center">
                        <h3>Workshop Listing</h3>
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="pt-4 col-lg-4">
                    <div class=" filter_exper_list border border-2 w-100">
                        <div class=" px-3 pt-3">
                            <h3>Filter</h3>
                        </div>
                        <hr/>
                        <form action="{{route('live_webinar')}}"class="form-appoint"> 
                            <input type="hidden" name="status" value="<?php if(isset($request['status'])){ echo $request['status']; } else{ echo 'live'; }?>"> 
                            <div class="p-3">
                                <div class="input-group mb-3">
                                    <input type="text" name="keyword" value="{{old('keyword',$request['keyword'])}}" placeholder="Search by keyword" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="date" name="date" value="{{old('date',$request['date'])}}"  placeholder="Search by Date" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <!-- <span class="input-group-text"><i class="far fa-calendar-alt"></i></span> -->
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="time" name="time" value="{{old('time',$request['time'])}}"  placeholder="Search by Time" class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <div class="input-group-append">
                                        <!-- <span class="input-group-text"><i class="fas fa-search"></i></span> -->
                                    </div>
                                </div> 
                                <select name="expert" class="custom-select">
                                    <option value="">Search by Expert Name</option>
                                    @if(count($expert)>0)
                                        @foreach($expert as $experts)
                                            <option {{ old('expert',$request['expert']) == $experts->user_id ? 'selected' : ''}} value="{{$experts->user_id}}">{{$experts->full_name}}</option> 
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="p-3">
                                <button type="submit" class="w-100 btn btn-outline-danger">Search</button> 
                            </div>
                        </form>
                    </div>
                    <div class="my-4 filter_exper_list border border-2 w-100">
                        <div class=" px-3 pt-3">
                            <h3>Blogs</h3>
                        </div>
                        <hr/>
                        @if(count($blogs)>0)
                            @foreach($blogs as $blog)
                                <div class="card border-0 mb-3" style="max-width:100%;">
                                    <div class="row no-gutters p-2">
                                        <div class="col-md-4">
                                            <img src="{{asset('public/blog_image/'.$blog->blog_image)}}" class="rounded card-img" alt="..."> 
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-2">
                                                <h6 style="font-weight:500;" class="card-title ">{{$blog->blog_title}}</h6>
                                                <p class="card-text text-muted text-left"  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; "> {{$blog->blog_details}}</p>    
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="pt-4 col-lg-8">
                @include('include.validation_message')
                    @include('include.auth_message')
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a href="{{route('live_webinar',['status'=>'live','keyword'=>$request['keyword'],'date'=>$request['date'],'time'=>$request['time'],'expert'=>$request['expert']])}}"> <button class="@if(!isset($request['status']) || $request['status'] == 'live') curent-appoint @else previous-appoint @endif">Live Workshop</button></a>
                            <a href="{{route('live_webinar',['status'=>'previous','keyword'=>$request['keyword'],'date'=>$request['date'],'time'=>$request['time'],'expert'=>$request['expert']])}}"> <button class="@if($request['status'] == 'previous') curent-appoint @else previous-appoint @endif">Previous Workshop</button></a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="mt-4 tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            @if(count($Workshops)>0)
                                @foreach($Workshops as $workshop)
                                    <div class="card border-0 mb-3" style="max-width:100%;" data-city="workshop_1">
                                        <div class="row no-gutters">
                                            <div class="col-md-3">
                                                <img style="height: 270px;" src="{{asset('workshop/'.$workshop->image)}}" class="card-img" alt="...">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="card-body">
                                                    <h4 class="float-left card-title">{{$workshop->title}}</h4>
                                                    <p class="text-right">Webinar</p>
                                                    <p class="text-muted">{{CommonFunction::GetSingleField('users','full_name','user_id',$workshop->expert)}}</p>
                                                    <div class="my-1 d-flex">
                                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                                    </div>
                                                    @if(!empty($workshop->description))
                                                        <div class="mt-3">
                                                            <p class="text-muted font-weight-normal" style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px;" id="oldtext">{{$workshop->description}}
                                                            </p>
                                                            <p style="display:none" id="moretext">{{$workshop->description}}
                                                            </p>
                                                            <button class="btn btn-info btn-sm" onclick="myFunction('workshop_1')" id="myBtn">Read more</button>
                                                        </div>
                                                    @endif
                                                    <div class="mt-3 mb-3 float-right expert_button">
                                                    <a href="{{route('live_webinar_details',$workshop->workshop_id)}}">View Workshop</a>
                                                        @if(Session::get('role_id') == 2 &&  Session::get('user_id') != $workshop->expert)
                                                            <a href="{{route('bookings.create',['id'=>$workshop->workshop_id])}}"class="px-4">Book Workshop</a>
                                                        @elseif(Session::get('role_id') != 2)
                                                            <a href="{{route('bookings.create',['id'=>$workshop->workshop_id])}}"class="px-4">Book Workshop</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                @endforeach
                            @else
                                <div class="card border-0  mb-3" style="max-width:100%;">
                                    <div class="row no-gutters">
                                        <h3 style="margin: auto;"> No Record Found</h3>
                                    </div>
                                </div> 
                            @endif
                        </div>            
                    </div> 
                    <nav class="mb-4 mt-4" aria-label="Page navigation example"> 
                    {{$Workshops->appends($request->all())->render('vendor.pagination.custom')}} 
                    </nav>
                    
                    
                </div>
                
            </div>
        </div>     
        <script>
function myFunction(workshop) {
  var dots = document.querySelector(`.card[data-city="${workshop}"] #oldtext`);
  var more = document.querySelector(`.card[data-city="${workshop}"] #moretext`); 
  var moreText = document.querySelector(`.card[data-city="${workshop}"] #more`);
   var btnText = document.querySelector(`.card[data-city="${workshop}"] #myBtn`);
  

  if (dots.style.display === "block") {
    dots.style.display = "none";
    more.style.display = "block";
    btnText.innerHTML = "Read less";
    moreText.style.display = "none";
  } 
  if(more.style.display === "none") {
    dots.style.display = "block";
    more.style.display = "block";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";
  }
  else{
    dots.style.display = "block";
    more.style.display = "none";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";  
  }
 
}
</script>
    </section>

@include('include.footer')
@include('include.script')
@include('include.modal')
 