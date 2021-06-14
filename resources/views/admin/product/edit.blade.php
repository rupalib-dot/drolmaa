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
                        <form action="{{route('product.update',$product->product_id)}}" method="POST" class="formLogIn" enctype="multipart/form-data">
                                @csrf  
                                @method('PUT') 
                            <div class="row">
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="mobile">Product Name</label>
                                        <input type="text" required value="{{old('product_name',$product->product_name)}}" name="product_name" class="form-control" placeholder="Product Name" aria-label="Product Name" aria-describedby="basic-addon1">
                                    </div>  
                                </div>  
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="dob">Expiry Date</label>
                                        <input type="date"  required class="form-control" value="{{old('expiry_date',$product->expiry_date)}}" name="expiry_date" placeholder="Expiry Date" aria-label="Date of Birth" aria-describedby="basic-addon1">
                                    </div> 
                                </div>
                            </div> 
                            <div class="row"> 
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Selling Price</label>
                                        <input type="text" required maxlength="5" name="selling_price" id="selling_price" value="{{old('selling_price',$product->selling_price)}}" placeholder="Selling Price" class="form-control">
                                    </div>
                                </div>  
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> MRP</label>
                                        <input type="text" required maxlength="5" name="mrp" id="mrp" value="{{old('mrp',$product->mrp)}}" placeholder="MRP" class="form-control">
                                    </div>
                                </div>  
                            </div>
                            <div class="row"> 
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Quantity</label>
                                        <input type="number" required min="1" max="100" name="quantity" id="quantity" value="{{old('quantity',$product->quantity)}}" placeholder="Quantity" class="form-control">
                                    </div>
                                </div>  
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Product Images</label>
                                        <input type="file" name="images[]" id="images" class="form-control" multiple>
                                    </div>
                                </div>  
                            </div>

                            <div class="row"> 
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Category</label>
                                        <select required class="form-control" id="exampleFormControlSelect1" name="category" aria-label="Category" aria-describedby="basic-addon2">
                                            <option value="">Category</option>
                                            @foreach($category as $category)
                                                <option {{ old('category',$product->category_id) == $category->category_id ? 'selected' : ''}} value="{{$category->category_id}}">{{ucfirst(strtolower($category->category_name))}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>    
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Description</label>
                                        <textarea required name="description" id="description" maxlength="250" placeholder="Description" class="form-control">{{old('description',$product->description)}}</textarea>
                                    </div>
                                </div>    
                            </div>

                            <div class="row"> 
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Instructions</label>
                                        <textarea required name="instructions" id="instructions" maxlength="250" placeholder="Instructions" class="form-control">{{old('instructions',$product->instructions)}}</textarea>
                                    </div>
                                </div>    
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> References</label>
                                        <textarea required name="referenceses" id="referenceses" maxlength="250" placeholder="References" class="form-control">{{old('referenceses',$product->referenceses)}}</textarea>
                                    </div>
                                </div>    
                            </div>

                            <div class="row"> 
                                <div class="col-xl-6 col-md-12 col-sm-12 col-12">
                                    <div class="form-group mb-4">
                                        <label for="name"> Rating</label>
                                        <div style="display: flex;">
                                            <input  onclick="ratingSelected(this.value)" @if($product->rating == 1 || $product->rating == 2 || $product->rating == 3 || $product->rating == 4 || $product->rating == 5) checked @endif type="checkbox" id="rating1" name="rating" data-id="1" class="form-control" value="1" id="rating">
                                            <input  onclick="ratingSelected(this.value)" @if($product->rating == 2 ||$product->rating == 3 || $product->rating == 4 || $product->rating == 5) checked @endif type="checkbox" id="rating2" name="rating" data-id="2" class="form-control" value="2" id="rating"> 
                                            <input  onclick="ratingSelected(this.value)" @if($product->rating == 3 || $product->rating == 4 || $product->rating == 5) checked @endif type="checkbox" id="rating3" name="rating" data-id="3" class="form-control" value="3" id="rating"> 
                                            <input  onclick="ratingSelected(this.value)" @if($product->rating == 4 || $product->rating == 5) checked @endif type="checkbox" id="rating4" name="rating" data-id="4" class="form-control" value="4" id="rating"> 
                                            <input  onclick="ratingSelected(this.value)" @if($product->rating == 5) checked @endif type="checkbox" id="rating5" name="rating" data-id="5" class="form-control" value="5" id="rating"> 
                                        </div> 
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
