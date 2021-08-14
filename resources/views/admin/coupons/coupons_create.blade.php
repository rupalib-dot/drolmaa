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
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Coupon</h4> 
                            </div>
                        </div>
                    </div> 
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('offers_coupons.update', isset($record_data) ? base64_encode($record_data->coupon_id) : base64_encode(0) ) }}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Title</label>
                                    <input type="text" class="form-control basic" maxlength="50" name="title" value="{{ old('title', isset($record_data) ? $record_data->title : '') }}" placeholder="Title" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Coupon Code</label>
                                    <input type="text" class="form-control basic" maxlength="10" name="coupon_code" value="{{ old('coupon_code', isset($record_data) ? $record_data->coupon_code : '') }}" placeholder="Coupon Code" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Start Date</label>
                                    <input type="date" class="form-control basic"  min="{{date('Y-m-d')}}" name="start_date" value="{{ old('start_date', isset($record_data) ? $record_data->start_date : '') }}" placeholder="Start Date" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Expiry Date</label>
                                    <input type="date" class="form-control basic"  min="{{date('Y-m-d')}}" name="expiry_date" value="{{ old('expiry_date', isset($record_data) ? $record_data->expiry_date : '') }}" placeholder="Expiry Date" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Discount in percentage</label>
                                    <input type="number" class="form-control basic"  name="discount" value="{{ old('discount', isset($record_data) ? $record_data->discount : '') }}" placeholder="Discount" required>
                                </div>

                                <div class="form-group mb-4 col-6 custom-file-container">
                                    <label>Coupon Photo <i>*</i></label>
                                    <input type="hidden" name="coupon_img_name" value="{{ isset($record_data) ? $record_data->coupon_image : '' }}">
                                    <input type="file" class="form-control" accept="image/*" name="coupon_file" {{ isset($record_data) ? '' : 'required' }}>
                                    @if(isset($record_data) && isset($record_data->coupon_image))
                                        <div class="images-box-r" style="min-height: 320px;background: url({{asset('public/coupon')}}/{{$record_data->coupon_image}}"></div>
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