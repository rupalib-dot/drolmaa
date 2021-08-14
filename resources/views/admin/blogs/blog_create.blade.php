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
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Blog</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('blogs.update', isset($record_data) ? base64_encode($record_data->blog_id) : base64_encode(0) )}}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Blog Title <i>*</i></label>
                                    <input type="text" class="form-control basic" maxlength="150" name="blog_title" value="{{ old('blog_title', isset($record_data) ? $record_data->blog_title : '') }}" placeholder="Blog Title" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Blog Category <i>*</i></label>
                                    <select name="blog_category" class="form-control" required>
                                        <option value="">== Select Blog Category ==</option>
                                        @foreach($category as $cat)
                                            <option {{ old('blog_category', isset($record_data) ? $record_data->blog_type : '') == $cat->category_id  ? 'selected' : ''}} value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Blog Details <i>*</i></label>
                                    <div class="widget-content widget-content-area p-0">
                                        <textarea id="product_details" name="blog_details">{{ old('blog_details', isset($record_data) ? $record_data->blog_details : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label>Blog Photo <i>*</i></label>
                                    <input type="file" class="form-control" accept="image/*" name="blog_file" {{ isset($record_data) ? '' : 'required' }}>
                                    <input type="hidden" name="blog_img_name" value="{{ isset($record_data) ? $record_data->blog_image : '' }}">
                                    @if(isset($record_data) && !empty($record_data->blog_image))
                                        <div class="images-box-r" style="min-height: 320px;background: url({{asset('public/blog_image')}}/{{$record_data->blog_image}}"></div>
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