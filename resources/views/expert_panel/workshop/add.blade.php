@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-md-10">
                            <div class="dashboard-panel" style="padding-top: 20px;">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h3> Add Workshop</h3>
                                <form action="{{route('expworkshop.store')}}" method="POST" class="formLogIn" enctype='multipart/form-data'>
                                    @csrf 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" value="{{old('title')}}" name="title" class="form-control" placeholder="Title" aria-label="Title" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="time" name="time" id="time" value="{{old('time')}}" placeholder="Time" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" value="{{old('start_date')}}" name="start_date" placeholder="Workshop Start Date" aria-label="Date of Birth" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" value="{{old('date')}}" name="date" placeholder="Workshop End Date" aria-label="Date of Birth" aria-describedby="basic-addon1"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="file" class="form-control" value="{{old('image')}}" name="image" placeholder="Image" aria-label="Image" aria-describedby="basic-addon1"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <textarea type="text" maxlength="255" name="description" id="description" placeholder="Description" class="form-control">{{old('description')}}</textarea>
                                            </div>
                                        </div> 
                                        
                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                                <input type="text" maxlength="4" name="price" id="price" value="{{old('price')}}" placeholder="Price" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-12">
                                             <button class="login1 btn" type="submit" name="submit">Submit</button>
                                        </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')