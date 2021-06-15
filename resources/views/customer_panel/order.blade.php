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
                                <h3 class="order-content">My Orders</h3>
                                <table class="table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Order No</th>
                                            <th>Date</th>
                                            <th>Status</th> 
                                            <th>Payment Type</th>
                                            <th>Total</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($order)>0)
                                            @foreach($order as $getData)
                                                <tr>
                                                    <td>{{$getData->order_no}}</td>
                                                    <td>{{date('M d, Y',strtotime($getData->created_at))}}</td>
                                                    <td>{{array_search($getData['order_status'],config('constant.STATUS'))}}</td> 
                                                    <td>{{array_search($getData['payment_type'],config('constant.PAYMENT_MODE'))}}</td>
                                                    <td><i class="fas fa-rupee-sign"></i> {{$getData->grand_total}}</td>
                                                    <td class="cancel-icon">
                                                        <span class="view-icon"><a href="{{route('customer.order_detail',$getData->order_id)}}"><i class="fas fa-eye"></i></a></span>
                                                        <!-- <span class="chat-icon"><a href="#"><i class="flaticon-chat"></i></a><span> -->
                                                        @php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.ORDER"),'module_id',$getData->order_id);@endphp
                                                        @if(empty($exist))
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" onclick="addFeedback('1','{{$getData->order_id}}','{{config("constant.FEEDBACK.ORDER")}}')"><i class="flaticon-view-details"></i></a></span> 
                                                        @else
                                                            <span class="view-icon" title="feedback"><a href="{{route('customer.feedback',['module_id'=>$getData->order_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>$getData->order_id,'module_type'=>config('constant.FEEDBACK.ORDER')])}}"><i class="flaticon-view-details"></i></a></span> 
                                                        @endif
                                                    </td>
                                                </tr> 
                                            @endforeach
                                        @else
                                            <tr>
                                                <td  colspan="6">No order available</td>
                                            </tr> 
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">
                            {{$order->appends($request->all())->render()}}
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

