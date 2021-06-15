@extends('admin.layouts.app')
@section('content') 
    <div class="container-fluid">
        <div class="row layout-top-spacing" id="cancel-row">
            <div id="ftFormArray" class="col-lg-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{$title}}</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{route('workshop.update',$workshop->workshop_id)}}" method="POST" class="formLogIn">
                            @csrf  
                            @method('PUT') 
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="mobile">Title</label>
                                        <input type="text" value="{{old('title',$workshop->title)}}" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                                    </div>  
                                </div>
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="dob">Designation</label>
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
                            </div> 
                                
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="mobile">Expert</label>
                                        <input type="hidden" name="expert_id_hidden" id="expert_id_hidden" value="{{old('expert',$workshop->expert)}}">
                                            <select class="form-control expert_list" id="exampleFormControlSelect1"
                                                placeholder="Expert" name="expert" aria-label="Expert"
                                                aria-describedby="basic-addon2">
                                                <option>select Designation First</option> 
                                            </select>
                                    </div>  
                                </div>
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="dob">Workshop Date</label>
                                        <input type="date" min="{{date('Y-m-d')}}" class="form-control" value="{{old('date',$workshop->date)}}" name="date" placeholder="Workshop Date" aria-label="Date of Birth" aria-describedby="basic-addon1">
                                    </div> 
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Workshop Time</label>
                                        <input type="time" name="time" id="time" value="{{old('time',$workshop->time)}}" placeholder="Time" class="form-control">
                                    </div>
                                </div> 
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                    <label for="name"> Price (<i class="fas fa-rupee-sign"></i>)</label>
                                        <input type="text" maxlength="4" name="price" id="price" value="{{old('price',$workshop->price)}}" placeholder="Price" class="form-control">
                                    </div>
                                </div>  
                            </div>

 
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group mb-4">
                                <input type="submit" name="submit" class="mt-4 mb-4 btn btn-primary">
                                </div>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div>  
    

@endsection  
