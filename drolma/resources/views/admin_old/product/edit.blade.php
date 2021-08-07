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
                            <form action="{{route('product.update',$product->product_id)}}" method="POST" class="formLogIn" enctype="multipart/form-data">
                                @csrf  
                                @method('PUT')
                                <div class="row">    
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" value="{{old('product_name',$product->product_name)}}" name="product_name" class="form-control" placeholder="Product Name" aria-label="Product Name"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>  
                                    
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="date" min="{{date('Y-m-d')}}" class="form-control" value="{{old('expiry_date',$product->expiry_date)}}" name="expiry_date" placeholder="Expiry Date"
                                                aria-label="Date of Birth" aria-describedby="basic-addon1">
                                        </div>
                                    </div> 

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" name="selling_price" id="selling_price" value="{{old('selling_price',$product->selling_price)}}" placeholder="Selling Price" class="form-control">
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="text" name="mrp" id="mrp" value="{{old('mrp',$product->mrp)}}" placeholder="MRP" class="form-control">
                                        </div>
                                    </div>  

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="number" name="quantity" id="quantity" value="{{old('quantity',$product->quantity)}}" placeholder="Quantity" class="form-control">
                                        </div>
                                    </div>   
                                    
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                                        </div>
                                    </div>    

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                            <textarea name="description" id="description" placeholder="Description" class="form-control">{{old('description',$product->description)}}</textarea>
                                        </div>
                                    </div>  

                                    <div class="col-md-12">
                                        <div class="input-group mb-4">
                                            <button class="login1 btn" type="submit" name="submit">Update</button> 
                                        </div>
                                    </div>    

                            </form> 
                        </div>
                    </div>
 
                </div> 
            </div>
        

@include('admin.layouts.footer')   
 