@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/perticuler_blog.svg')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading"> Blog Detail</h2>
            </div>
        </div>
    </div>
</section>
<section id="single-blog" class="single-blog" role="single-blog">
    <div class="container">
    @include('include.validation_message')
                    @include('include.auth_message')
        <div class="row">
            <div class="col-md-8">
                <div class="single-contact">
                    <img style="height: 300px;" src="{{asset('public/blog_image/'.$blog->blog_image)}}" alt="" class="img-fluid">
                    <ul class="comment-date" style="padding-left: 0px;margin-bottom: 20px;margin-top: 20px;">
                        <li> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>{{date('M d, Y',strtotime($blog->created_at))}}</li>
                        <li> <span><i class="fa fa-comment-o" aria-hidden="true"></i></span>{{count($blogs_comment)}} Comments</li>
                    </ul> 
                    <h4>{{$blog->blog_title}}</h4>
                    <p class="sucess-para"> {{$blog->blog_details}} </p>
                    <!-- Button trigger modal -->
                    <button type="button" class="my-3 border-0 float-right text-decoration-underline  text-dark " data-toggle="modal" data-target="#exampleModal">View All</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLabel"> Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            @if(count($blogs_comment)>0)
                                @foreach($blogs_comment as $blogcomment)
                                <?php $byimage = CommonFunction::GetSingleField('users','user_image','user_id',$blogcomment->user_id);
                                if(!empty($byimage)){
                                    $images = asset('public/user_images/'.$byimage);
                                }else{
                                    $images = asset('front_end/images/blogimg.jpg');
                                }
                                ?>

                                <div class="row py-3" style="border-bottom: 1px solid #00000063;">
                                <div class="col-lg-4" style="font-size: 15px; "> <img style="border-radius: 100%;  width: 50px; height: 50px;" src="{{$images}}"></div> 
                                <div class="col-lg-4" style="font-size: 15px;   font-weight: 700;"> <p>{{CommonFunction::GetSingleField('users','full_name','user_id',$blogcomment->user_id)}}</p></div> 
                                    <div class="col-lg-12" style="font-size: 15px;"><p>{{$blogcomment->comment_details}}</p></div>
                                </div>
                                @endforeach
                            @else
                            <p> No comment found</p>
                            @endif
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <h3 class="success-heading">Leave a Reply</h3>
                    <p class="email-para">Your email address will not be published. Required fields are marked *
                    </p>
                    <form action="{{route('page.postComment',$blogId)}}" method="post" class="form-contact">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="full_name" value="NULL">
                            <input  type="hidden" name="email_address" value="NULL">
                            <input type="hidden" name="user_id" value="{{Session::get('user_id')}}"> 
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea name="comment" class="form-control" rows="5" id="comment" required>{{old('comment')}}</textarea>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div> -->
                        </div> 
                                <button name="submit" type="submit" class="submit-contact">Post Comment</button>
                            
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="resend-post">
                    <h4 class="mb-3">Recent Post</h4>
                        @if(count($recent_blogs))
                            @foreach($recent_blogs as $recent_blog)
                                <div class="card p-1 mb-3" style="max-width: 540px;">
                                    <div class="d-flex">
                                        <img src="{{asset('public/blog_image/'.$recent_blog->blog_image)}}" alt="" class="img-fluid one">
                                        <div class="post-right">
                                            <a href="{{route('page.blogDetail',$recent_blog->blog_id)}}" target="_blank" rel="noopener noreferrer"><h5>{{$recent_blog->blog_title}}</h5></a>
                                            <p style="display:block;white-space: nowrap; overflow: hidden;  max-width: 170px; "> {{$recent_blog->blog_details}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                                 
                    <div class="text-center">
                    <a href="{{route('page.bloglist',$blog->blog_type)}}" class="btn btn-danger text-center">Browse More</a>
                    </div>
                </div>
                <div class="offer-class">
                    <img src="{{asset('front_end/images/group4.png')}}" alt="" class="img-fluid cutoff">
                    <div class="question-fill">
                   
                        <h4 class="any-ques">Talk to our Expert</h4>
                        <form action="{{route('contact-submit')}}" method="post" class="form-contact">
                            @csrf
                            <input type="hidden" value="{{config('constant.ENQUIERY.TALK TO EXPERT')}}" name="module_type">
                            <input type="hidden" value="0" name="module_id">
                            <input type="hidden" value="0" name="topic_id"> 
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                <input type="text" maxlength="30" class="form-control" value="{{old('name')}}" placeholder="Name" name="name"  required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email" aria-describedby="emailHelp" placeholder="Enter email"required>
                                </div>
                            </div> 
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                <input type="text"  maxlength="12" class="form-control" value="{{old('phone')}}" placeholder="Phone" name="phone"  required>
                                </div>
                            </div> 
                            <div class="col-sm-12">
                            <textarea class="form-control" name="message" maxlength="250" id="exampleFormControlTextarea1" rows="3" required>{{old('message')}}</textarea>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" name="submit" class="send-ques">Send</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.footer_bottom') 