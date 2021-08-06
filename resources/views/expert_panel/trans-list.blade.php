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
                            <div class="dashboard-panel">
                                <h3 class="order-content">{{ucwords($type)}} Transaction Listings</h3>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <?php if($type == 'registration'){ ?>
                                                <!-- <th>Total Collection</th>     -->
                                            <?php }else if($type == 'appointment'){  ?>
                                                <th>Amount earned </th>
                                                <th>Amount Paid By Admin</th> 
                                                <th>Amount Left</th>
                                            <?php  } ?> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr> 
                                            <?php if($type == 'registration'){ ?>
                                                <td> Total Spend:- <i class="fas fa-rupee-sign"></i> {{number_format($TotalColection,2,'.',',')}} </td>  
                                            <?php }else if($type == 'appointment'){  ?>
                                                <td> <i class="fas fa-rupee-sign"></i> {{number_format($TotalColection,2,'.',',')}}</td>  
                                                <td> <i class="fas fa-rupee-sign"></i> {{number_format($totalPaidamount,2,'.',',')}} </td> 
                                                <td><i class="fas fa-rupee-sign"></i> {{number_format(($TotalColection - $totalPaidamount),2,'.',',')}}</td>
                                            <?php  } ?>
                                        <tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <th>ID</th>  
                                            <?php if($type == 'appointment'){ ?> 
                                                <th>Date</th>
                                                <th>Appointment No</th>
                                                <th>Appoinment Date</th>
                                                <th>Payment Id</th>
                                                <th>Amount</th> 
                                                <th>Refund Id</th>
                                                <th>Refund Amount</th>    
                                            <?php } if($type == 'registration'){ ?>
                                                <th>Payment Id</th>
                                                <th style="width: 15%;">Amount</th> 
                                                <th>Start Date</th> 
                                                <th>End Date</th> 
                                                <th>Month</th>  
                                                <th>Plan Detail</th>  
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @if(count($transactions)>0) 
                                            @php $i=1; @endphp 
                                            @foreach($transactions as $aGetData)  
                                                <tr> 
                                                    <td>{{$i}}</td>
                                                    <?php if($type == 'registration'){ ?> 
                                                        <td>{{$aGetData->payment_id}}</td>
                                                        <td><i class="fas fa-rupee-sign"></i> {{number_format($aGetData->register_amount,2,'.',',')}}</td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->start_date))}}</td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->end_date))}}</td>
                                                        <td>{{$aGetData->month}} Month</td>
                                                        <td>{{ucwords($aGetData->plan_detail)}}</td>
                                                    <?php }else if($type == 'appointment'){  ?>
                                                        <td>{{date('d M, Y',strtotime($aGetData->created_at))}}</td>
                                                        <td>{{$aGetData->appoinment_no}}</td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->date))}}</td>
                                                        <td>{{$aGetData->payment_id}}</td> 
                                                        <td><i class="fas fa-rupee-sign"></i> {{number_format($aGetData->amount,2,'.',',')}}</td>
                                                        <td>@if(!empty($aGetData->refund_id)) {{$aGetData->refund_id}}  @else N/A @endif </td>
                                                        <td>@if(!empty($aGetData->amount_refund)) <i class="fas fa-rupee-sign"></i> {{number_format($aGetData->amount_refund,2,'.',',')}}  @else N/A @endif</td>  
                                                    <?php  } ?>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach 
                                        @else
                                            <tr> 
                                                <td colspan="7">No Record Found</td>
                                            </tr> 
                                        @endif  
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">
                            {{$transactions->appends($request->all())->render('vendor.pagination.custom')}}
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal') 
