@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                    @if(Session::get('role_id') == 3)
                            @include('include.client_sidebar')
                        @elseif(Session::get('role_id') == 2)
                            @include('include.expert_sidebar')
                        @endif
                        <div class="col-lg-10">
                            <div class="dashboard-panel">
                            @include('include.validation_message')
                                @include('include.auth_message')
                                <h3 class="order-content">My Orders</h3>
                                <form action="{{route('appointment.index')}}" class="form-appoint">
                                    <select name="payment_type" style="border: 1px solid var(--black1);padding: 9px;margin-right: 5px !important;">
                                        <option value="">Order Number</option>
                                        @foreach(config('constant.PAYMENT_MODE') as $value => $key)
                                            <option {{ old('payment_type',$request['payment_type']) == $key ? 'selected' : ''}} value="{{$key}}">{{ucfirst(strtolower($value))}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="type" value="{{$request['type']}}" class="">

                                    <input style="margin-right: 5px !important;" type="date" name="from_date" value="{{old('from_date',$request['from_date'])}}" class="mr-2">
                                    <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                    <a href="{{url('appointment')}}"> <button type="button" class="filter" style="">Clear </button></a>
                                </form>
                                <table class="d-lg-table table-responsive table table-bordered appoint-table" style="width:100%">
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
                                                    <td><i class="fas fa-rupee-sign"></i> {{number_format($getData->grand_total,2,'.',',')}}</td>
                                                    <td class="cancel-icon">
                                                        <span class="view-icon" title="View Order"><a href="{{route('customer.order_detail',$getData->order_id)}}"><i class="fas fa-eye"></i></a></span>
                                                        <!-- <span class="chat-icon"><a href="#"><i class="flaticon-chat"></i></a><span> -->
                                                        @if($getData->order_status == config('constant.STATUS.PENDING')) 
                                                            <span onclick="return confirm('Are you sure you want to cancel this order?')" class="view-icon" title="Cancel"><a href="{{route('order-status-change',['id'=>$getData->order_id,'status'=>config('constant.STATUS.CANCELLED')])}}"><i class="far fa-times-circle"></i></a></span> 
                                                        @endif
                                                        @php $exist = CommonFunction::GetRow('feedback','feedback_by',Session::get('user_id'),'module_type',config("constant.FEEDBACK.ORDER"),'module_id',$getData->order_id);@endphp
                                                        @if(empty($exist))
                                                            <span class="view-icon" title="Feedback"><a style="cursor:pointer" onclick="addFeedback('1','{{$getData->order_id}}','{{config("constant.FEEDBACK.ORDER")}}')"><i class="flaticon-view-details"></i></a></span> 
                                                        @else
                                                            <span class="view-icon" title="Feedback"><a href="{{route('customer.feedback',['module_id'=>$getData->order_id,'feedback_by'=>Session::get('user_id'),'feedback_to'=>'1','module_type'=>config('constant.FEEDBACK.ORDER')])}}"><i class="flaticon-view-details"></i></a></span> 
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
                            {{$order->appends($request->all())->render('vendor.pagination.custom')}}
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

