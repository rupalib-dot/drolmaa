<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/perticuler_blog.svg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Single Blog</h2>
            </div>
        </div>
    </div>
</section>
<section id="single-blog" class="single-blog" role="single-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="single-contact">
                    <img src="<?php echo e(asset('front_end/images/group1.png')); ?>" alt="" class="img-fluid">
                    <ul class="comment-date" style="padding-left: 0px;margin-bottom: 20px;margin-top: 20px;">
                        <li> <span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>May 30, 2020</li>
                        <li> <span><i class="fa fa-comment-o" aria-hidden="true"></i></span>No Comments</li>
                    </ul>
                    <h3 class="success-heading">From Failure To Success</h3>
                    <p class="sucess-para">Enim malesuada ipsum nec in ornare sodales ipsum sodales nec sodales in a
                        adipiscing ornare metus
                        congue curabitur molestie donec auctor. Tempus — nibh, eros non sem sed sit porttitor diam
                        commodo, cursus: ultricies non curabitur et sodales, congue sapien curabitur.
                    </p>
                    <p class="sucess-two">
                        Adipiscing mattis gravida sodales leo rutrum gravida eu malesuada fusce morbi — malesuada.
                        Rutrum
                        fusce nec sit at congue enim malesuada orci magna metus sit. Arcu at odio, porta et amet eu
                        vitae
                        vivamus.
                    </p>
                    <div class="d-flex comment-tweet">
                        <p>Bill White</p>
                        <p><span class="tweet"><i class="fa fa-twitter" aria-hidden="true"></i></span>Tweet</p>
                    </div>
                    <p class="sucess-three">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <img src="<?php echo e(asset('front_end/images/group2.png')); ?>" alt="" class="img-fluid two">
                    <h3 class="success-heading">From Failure To Success</h3>
                    <p class="sucess-three">Enim malesuada ipsum nec in ornare sodales ipsum sodales nec sodales in a
                        adipiscing ornare metus
                        congue curabitur molestie donec auctor. Tempus — nibh, eros non sem sed sit porttitor diam
                        commodo, cursus: ultricies non curabitur et sodales, congue sapien curabitur.
                    </p>
                    <!-- Button trigger modal -->
                    <button type="button" class="my-3 border-0 float-right text-decoration-underline  text-dark " data-toggle="modal" data-target="#exampleModal">View All</button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLabel">Our Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            ...
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <h3 class="success-heading">Leave a Reply</h3>
                    <p class="email-para">Your email address will not be published. Required fields
                        are marked *
                    </p>
                    <form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control" rows="5" id="comment"></textarea>
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
                        <button class="submit-contact">Post Comment</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="resend-post">
                    <h4 class="mb-3">Recent Post</h4>
                    <div class="card p-1 mb-3" style="max-width: 540px;">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('front_end/images/group3.png')); ?>" alt="" class="img-fluid one">
                                        <div class="post-right">
                                           <a href="http://" target="_blank" rel="noopener noreferrer"><h5>From Failure To Success</h5></a>
                                            <p>Enim malesuada ipsum nec in ornare sodales ipsum</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-1 mb-3" style="max-width: 540px;">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('front_end/images/group3.png')); ?>" alt="" class="img-fluid one">
                                        <div class="post-right">
                                           <a href="http://" target="_blank" rel="noopener noreferrer"><h5>From Failure To Success</h5></a>
                                            <p>Enim malesuada ipsum nec in ornare sodales ipsum</p>
                                        </div>
                                    </div>
                                </div><div class="card p-1 mb-3" style="max-width: 540px;">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('front_end/images/group3.png')); ?>" alt="" class="img-fluid one">
                                        <div class="post-right">
                                           <a href="http://" target="_blank" rel="noopener noreferrer"><h5>From Failure To Success</h5></a>
                                            <p>Enim malesuada ipsum nec in ornare sodales ipsum</p>
                                        </div>
                                    </div>
                                </div><div class="card p-1 mb-3" style="max-width: 540px;">
                                    <div class="d-flex">
                                        <img src="<?php echo e(asset('front_end/images/group3.png')); ?>" alt="" class="img-fluid one">
                                        <div class="post-right">
                                           <a href="http://" target="_blank" rel="noopener noreferrer"><h5>From Failure To Success</h5></a>
                                            <p>Enim malesuada ipsum nec in ornare sodales ipsum</p>
                                        </div>
                                    </div>
                                </div>
                               <div class="text-center">
                               <a href="" class="btn btn-danger text-center">Browse More</a>
                               </div>
                </div>
                <div class="offer-class">
                    <img src="<?php echo e(asset('front_end/images/group4.png')); ?>" alt="" class="img-fluid cutoff">
                    <div class="question-fill">
                        <h4 class="any-ques">Talk to our Expert</h4>
                        <form action="/action_page.php" class="form-single">
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group mb-4">
                                    <input type="number" class="form-control" placeholder="Phone" aria-label="number"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <!-- <div class="col-sm-12">
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                        aria-describedby="basic-addon1">
                                </div>
                            </div> -->
                            <div class="col-sm-12">
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                    placeholder="Message"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button type="btn" class="send-ques">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/pages/blog_details.blade.php ENDPATH**/ ?>