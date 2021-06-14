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
                                <h3 class="order-content">My Feedbacks</h3>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @if(count($feedback_list['feedbackBy'])>0)
                                            @foreach($feedback_list['feedbackBy'] as $feedbackBy)
                                                <div class="feedback-profile">
                                                    <div class="feedback-rating">
                                                        <div class="feedback-box"
                                                            style="background-image:<?php if(!empty($feedbackBy->feedbackTo_users->user_image)){?>url({{asset('user_images/'.$feedbackBy->feedbackTo_users->user_image)}});<?php }else{?>url({{asset('front_end/images/blogimg.jpg')}});<?php }?> ">
                                                        </div>
                                                        <h3>{{$feedbackBy->feedbackTo_users->full_name}}</h3>
                                                        <p class="java-tech">Feedback On:- {{ucwords(strtolower(array_search($feedbackBy->module_type,config('constant.FEEDBACK'))))}}</p>
                                                    </div>
                                                    <div class="star">
                                                        <span class="review-star">{{$feedbackBy->rating}}</span>
                                                        @if($feedbackBy->rating == 1)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        @elseif($feedbackBy->rating == 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        @elseif($feedbackBy->rating == 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        @elseif($feedbackBy->rating == 4)
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
                                                    <p class="quote-feedback"
                                                        style="background-image:url({{asset('front_end/images/quoteimg.png')}});">
                                                       {{$feedbackBy->message}}
                                                    </p>
                                                    <p style="padding-top: 15px;text-align: right;color: var(--black1);">
                                                       {{date('M d, Y  H:i A',strtotime($feedbackBy->created_at))}}
                                                    </p>
                                                </div>
                                            @endforeach
                                        @endif
                                        @if(count($feedback_list['feedbackTo'])>0)
                                            @foreach($feedback_list['feedbackTo'] as $feedbackTo) 
                                                <div class="feedback-profile">
                                                    <div class="feedback-rating">
                                                        <div class="feedback-box"
                                                            style="background-image:<?php if(!empty($feedbackTo->feedbackBy_users->user_image)){?>url({{asset('user_images/'.$feedbackTo->feedbackBy_users->user_image)}})<?php }else{?>url({{asset('front_end/images/blogimg.jpg')}})<?php }?> ">
                                                        </div>
                                                        <h3>{{$feedbackTo->feedbackBy_users->full_name}}</h3>
                                                        <p class="java-tech">Feedback On:- {{ucwords(strtolower(array_search($feedbackTo->module_type,config('constant.FEEDBACK'))))}}</p>

                                                    </div>
                                                    <div class="star">
                                                        <span class="review-star">{{$feedbackTo->rating}}</span>
                                                        @if($feedbackTo->rating == 1)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        @elseif($feedbackTo->rating == 2)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        @elseif($feedbackTo->rating == 3)
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star checked"></span>
                                                            <span class="fa fa-star-o"></span>
                                                            <span class="fa fa-star-o"></span>
                                                        @elseif($feedbackTo->rating == 4)
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
                                                    <p class="quote-feedback"
                                                        style="background-image:url({{asset('front_end/images/quoteimg.png')}});">
                                                       {{$feedbackTo->message}}
                                                    </p>
                                                    <p style="padding-top: 15px;text-align: right;color: var(--black1);">
                                                       {{date('M d, Y  H:i A',strtotime($feedbackTo->created_at))}}
                                                    </p>
                                                </div>
                                            @endforeach
                                        @endif

                                        @if(count($feedback_list['feedbackBy'])<= 0 && count($feedback_list['feedbackTo'])<= 0)
                                            <div class="feedback-profile">
                                                NO RECORD FOUND
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="paginationPara">
                                <ul class="pagination justify-content-center">
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
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')