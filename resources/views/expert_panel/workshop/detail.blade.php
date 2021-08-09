@include('include.header')
@include('include.nav')
<style> 
.checked{
   color: #ffc800;
}
</style> 
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.expert_sidebar')
                        <div class="col-md-10" style="padding-top: 40px;">
                            <div class="dashboard-panel">
                                @include('include.validation_message')
                                @include('include.auth_message')
                                <h4>Workshop Details</h4> 
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead> 
                                        <tr> 
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th> 
                                            <th>Status</th>
                                            <th>Payment Id</th> 
                                            <th>Amount</th> 
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        @if(count($users_list)>0) 
                                            @php $i=1; @endphp 
                                            @foreach($users_list as $aGetData) 
                                                <tr> 
                                                    <td>{{$aGetData->booking_no}}</td> 
                                                    <td>{{$aGetData->Users->full_name}} </td>
                                                    <td>{{$aGetData->Users->email_address}}</td>
                                                    <td>+91 {{$aGetData->Users->mobile_number}}</td>  
                                                    <td>{{ucwords(strtolower(array_search($aGetData->status,config('constant.STATUS'))))}}</td>
                                                    <td>{{$aGetData->payment_id}}</td> 
                                                    <td><i class="fas fa-rupee-sign"></i> {{number_format(CommonFunction::GetSingleField('workshop','price','workshop_id',$aGetData->module_id),2,'.',',')}}</td>  
                                                </tr> 
                                            @php $i++; @endphp
                                            @endforeach 
                                        @else
                                            <tr> 
                                                <td colspan="9">No Record Found</td>
                                            </tr> 
                                        @endif  
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">  
                            {{$users_list->appends($request->all())->render('vendor.pagination.custom')}}
                                <!-- <ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Previouss</button>
                                        </a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Next</button>
                                        </a></li>
                                </ul> -->
                            </div> 
                            @if(count($feedback_list)>0)
                                <div class="dashboard-panel">
                                    <h4>Feedback Details</h4>  
                                    @foreach($feedback_list as $feedback)
                                        <?php $image_name = CommonFunction::GetSingleField('users','user_image','user_id',$feedback->feedback_by); ?>
                                        <div class="feedback-profile" style="border: 1px solid #00000040;padding: 20px;">
                                            <div class="feedback-rating"> 
                                                <h4>{{CommonFunction::GetSingleField('users','full_name','user_id',$feedback->feedback_by)}}</h4>
                                                @if($feedback->rating == 1)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($feedback->rating == 2)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($feedback->rating == 3)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($feedback->rating == 4)
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @else 
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                @endif
                                            </div>
                                            <div class="star">
                                            {{$feedback->created_at}} 
                                            </div>
                                            <p class="quote-feedback" style="padding-top: 10px;padding-left: 0px; margin-bottom: 0px;">
                                                {{$feedback->message}}
                                            </p>
                                             
                                        </div>
                                    @endforeach 
                                </div>  
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')


 

