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
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Cancel Reasons </h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('cancel_reason.update', isset($record_data) ? base64_encode($record_data->cancel_reasons_id) : base64_encode(0) ) }}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT') 
                            <div class="row">
                                <div class="form-group mb-4 col-12 custom-file-container">
                                    <label>Cancel Reason Details</label>
                                    <div class="widget-content widget-content-area p-0">
                                        <textarea id="product_details" maxlength="1000" name="cancel_reasons_detail">{{ old('cancel_reasons_detail', isset($record_data) ? $record_data->cancel_reasons_detail : '') }}</textarea>
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