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
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Health Tips</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('health_tips.update', isset($record_data) ? base64_encode($record_data->health_tips_id) : base64_encode(0) ) }}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-12 custom-file-container">
                                    <label for="email1">Title <i>*</i></label>
                                    <input type="text" class="form-control basic" maxlength="50" name="health_tips_title" value="{{ old('health_tips_title', isset($record_data) ? $record_data->health_tips_title : '') }}" placeholder="Title" required>
                                </div>
                                <div class="form-group mb-4 col-12 custom-file-container">
                                    <label>Description <i>*</i></label> 
                                    <div class="widget-content widget-content-area p-0">
                                        <textarea id="product_details" name="health_tips_desc">{{ old('health_tips_desc', isset($record_data) ? $record_data->health_tips_desc : '') }}</textarea>
                                    </div>
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