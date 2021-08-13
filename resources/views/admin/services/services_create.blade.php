@extends('admin.layouts.app')

@section('content')
<style>
i{
    color:red;
}
</style>
    <div class="container-fluid">
        <div class="row layout-top-spacing" id="cancel-row">
            <div id="ftFormArray" class="col-lg-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Service</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('services.update', isset($record_data) ? base64_encode($record_data->services_id) : base64_encode(0) )}}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Title <i>*</i></label>
                                    <input type="text" class="form-control basic" maxlength="100" name="services_title" value="{{ old('services_title', isset($record_data) ? $record_data->services_title : '') }}" placeholder="Title" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Service For <i>*</i></label>
                                    <select class="form-control basic" name="services_for" placeholder="Title" required> 
                                        <option value="">== Select Services For==</option> 
                                        <option {{ old('services_for', isset($record_data) ? $record_data->services_for : '') == 2  ? 'selected' : ''}} value="2">Expert</option>
                                        <option {{ old('services_for', isset($record_data) ? $record_data->services_for : '') == 3  ? 'selected' : ''}} value="3">Customer</option>  
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Description <i>*</i></label>
                                    <div class="widget-content widget-content-area p-0">
                                        <textarea id="product_details" name="services_detail">{{ old('services_detail', isset($record_data) ? $record_data->services_detail : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label>Photo <i>*</i></label>
                                    <input type="file" class="form-control" accept="image/*" name="services_file" {{ isset($record_data) ? '' : 'required' }}>
                                    <input type="hidden" name="services_img_name" value="{{ isset($record_data) ? $record_data->services_photo : '' }}">
                                    @if(isset($record_data) && !empty($record_data->services_photo))
                                        <img class="images-box-r" src="{{asset('public/services')}}/{{$record_data->services_photo}}" width="400" style="padding-top:10px;"/>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Save & Exit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  