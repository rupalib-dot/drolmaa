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
                            <form action="{{route('workshop.update',$workshop->workshop_id)}}" method="POST" class="formLogIn">
                                @csrf  
                                @method('PUT')
                                <div class="row">   
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" value="{{old('title',$workshop->title)}}" name="title" class="form-control" placeholder="Title" aria-label="Title"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <select onchange="expert_list(this.value)" class="form-control" id="exampleFormControlSelect1"
                                                placeholder="Designation" name="designation" aria-label="Designation"
                                                aria-describedby="basic-addon2">
                                                <option value="">Designation</option>
                                                @foreach($designation_list as $designation)
                                                    <option {{ old('designation',$workshop->designation) == $designation->designation_id ? 'selected' : ''}} value="{{$designation->designation_id}}">{{ucfirst(strtolower($designation->designation_title))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="hidden" name="expert_id_hidden" id="expert_id_hidden" value="{{old('expert',$workshop->expert)}}">
                                            <select class="form-control expert_list" id="exampleFormControlSelect1"
                                                placeholder="Expert" name="expert" aria-label="Expert"
                                                aria-describedby="basic-addon2">
                                                <option>select Designation First</option> 
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="date" min="{{date('Y-m-d')}}" class="form-control" value="{{old('date',$workshop->date)}}" name="date" placeholder="Appointment Date"
                                                aria-label="Date of Birth" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="time" name="time" id="time" value="{{old('time',$workshop->time)}}" placeholder="Time" class="form-control">
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" name="price" id="price" value="{{old('price',$workshop->price)}}" placeholder="Price" class="form-control">
                                        </div>
                                    </div>  
                                    
                                    <button class="login1 btn" type="submit" name="submit">Update</button>
                            </form> 
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   

<script>
$(document).ready(function() {
    var designation_id = $("select[name=designation]").val();
    if(designation_id != '')
    {
        var expert_id_hidden = $("input[name=expert_id_hidden]").val();
        expert_list(designation_id, expert_id_hidden);
    } 
});
</script> 