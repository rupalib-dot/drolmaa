@include('include.header')
@include('include.nav')
    
    <section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        @include('include.client_sidebar')
                        <div class="col-md-9">
                            <div class="dashboard-panel">
                                <h3 class="order-content">{{ucwords($type)}} Transaction Listing</h3>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <?php if($type == 'order'){ ?>
                                                <th>Amount Spend</th>
                                                <th>Amount Refund</th>
                                                <th>Total Spend</th>  
                                            <?php }else if($type == 'booking'){ ?>
                                                <!-- <th>Total Collection</th>     -->
                                            <?php }else if($type == 'appointment'){  ?>
                                                <th>Amount Spend </th>
                                                <th>Amount Refund</th>
                                                <th>Total Spend</th>   
                                            <?php  } ?> 
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <tr> 
                                            <?php if($type == 'order'){ ?>
                                                <td> {{$amountearned}}</td> 
                                                <td> {{$amountrefund}}</td>
                                                <td> {{$TotalColection}} </td>  
                                            <?php }else if($type == 'booking'){ ?>
                                                <td> Total Spend:- {{$TotalColection}} </td>  
                                            <?php }else if($type == 'appointment'){  ?>
                                                <td> {{$amountearned}}</td> 
                                                <td> {{$amountrefund}}</td>
                                                <td> {{$TotalColection}} </td>  
                                            <?php  } ?>
                                        <tr>
                                    </tbody>
                                </table>
                                <table class="table table-bordered appoint-table">
                                    <thead>  
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Payment Id</th>
                                            <th>Amount</th> 
                                            <?php if($type == 'order'){ ?>   
                                                    <th>Refund Id</th>
                                                    <th>Refund Amount</th>  
                                            <?php }else if($type == 'appointment'){ ?> 
                                                    <th>Refund Id</th>
                                                    <th>Refund Amount</th>    
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @if(count($transactions)>0) 
                                            @php $i=1; @endphp 
                                            @foreach($transactions as $aGetData)  
                                                <tr> 
                                                    <?php if($type == 'order'){ ?>
                                                        <td><a style="color:blue" href="{{route('adminOrder.show',$aGetData->order_id)}}">{{$aGetData->order_no}}</a></td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->created_at))}}</td>
                                                        <td>{{$aGetData->payment_id}}</td> 
                                                        <td>{{$aGetData->grand_total}}</td> 
                                                        <td>@if(!empty($aGetData->refund_id)) {{$aGetData->refund_id}} @else N/A @endif</td>
                                                        <td>@if(!empty($aGetData->amount_refund)) {{$aGetData->refund_amount}} @else N/A @endif</td>   
                                                    <?php }else if($type == 'registration'){ ?>
                                                        <td><a style="color:blue" href="{{route('adminexpert.show',$aGetData->user_id)}}">{{$i}}</a></td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->created_at))}}</td>
                                                        <td>{{$aGetData->payment_id}}</td>
                                                        <td>{{$aGetData->register_amount}}</td>
                                                    <?php }else if($type == 'booking'){ ?>
                                                        <td><a style="color:blue" href="{{route('workshop.show',$aGetData->workshop_id)}}">{{$aGetData->booking_no}}</a></td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->date))}}</td>
                                                        <td>{{$aGetData->payment_id}}</td> 
                                                        <td>{{$aGetData->price}}</td>
                                                    <?php }else if($type == 'appointment'){  ?>
                                                        <td><a style="color:blue" href="{{route('adminappoinment.show',$aGetData->appointment_id)}}">{{$aGetData->appoinment_no}}</a></td>
                                                        <td>{{date('d M, Y',strtotime($aGetData->date))}}</td>
                                                        <td>{{$aGetData->payment_id}}</td> 
                                                        <td>{{$aGetData->amount}}</td>
                                                        <td>@if(!empty($aGetData->refund_id)) {{$aGetData->refund_id}}  @else N/A @endif </td>
                                                        <td>@if(!empty($aGetData->amount_refund)) {{$aGetData->amount_refund}}  @else N/A @endif</td>  
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
                            {{$transactions->appends($request->all())->render()}}
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
