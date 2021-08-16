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
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Training</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('training.update', isset($record_data) ? base64_encode($record_data->training_id) : base64_encode(0) ) }}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Title</label>
                                    <input type="text" class="form-control basic" maxlength="50" name="training_title" value="{{ old('training_title', isset($record_data) ? $record_data->training_title : '') }}" placeholder="Title" required>
                                </div>
                                <div class="form-group mb-4 col-6 custom-file-container">
                                    <label>Image</label>
                                    <input type="hidden" name="training_img_name" value="{{ isset($record_data) ? $record_data->training_image : '' }}">
                                    <input type="file" class="form-control" accept="image/*" name="training_file" multiple {{ isset($record_data) ? '' : 'required' }}>
                                    @if(isset($record_data) && isset($record_data->training_image))
                                        <div class="images-box-r" style="min-height: 320px;background: url({{asset('public/training')}}/{{$record_data->training_image}}"></div>
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