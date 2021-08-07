@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint"> 
                    <div class="dashboard-panel">
                        @include('include.validation_message')
                        @include('include.auth_message')
                        <h3 class="order-content">Live Webinar</h3> 
                     
                        <table class="table table-bordered appoint-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Designation</th>
                                    <th style="width: 150px;">Rating</th>
                                    <th>Address Details</th> 
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($workshop_detail)>0)
                                    @foreach($workshop_detail as $workshops) 
                                        <tr>
                                            
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">No Record Found</td>
                                    </tr>
                                @endif
                            </tbody> 
                        </table>
                    </div>
                    <div class="paginationPara">
                    {{$workshop_detail->appends($request->all())->render('vendor.pagination.custom')}} 
                    </div>  
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal')
 