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
                        <form action="{{route('category.update',$category->category_id)}}" method="POST" class="formLogIn" enctype="multipart/form-data">
                                @csrf  
                                @method('PUT') 
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="mobile">Category Name</label>
                                        <input type="text" value="{{old('category_name',$category->category_name)}}" name="category_name" class="form-control" placeholder="Category Name" aria-label="Category Name" aria-describedby="basic-addon1">
                                    </div>  
                                </div>   
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Category Images</label>
                                        <input type="file" name="category_image" id="category_image" class="form-control">
                                        <img style="width: 250px; height: 200px; margin-top: 20px;" src="<?php if(!empty($category->category_image)){?>{{asset('category/'.$category->category_image)}}<?php }else{?>{{asset('front_end/images/blogimg.jpg')}}<?php }?>">
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
