<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/contactimg.jpg')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Contact</h2>
            </div>
        </div>
    </div>
</section>

<section id="contact-inner-map" class="contact-inner-map">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="p-3  heading_contact_form">
                    <h3>Get in Touch with Us</h3>
                    <p>Any question or remarks? Just write us a message!</p>
                </div>
                <div class="p-3  contact_page_details">
                    <ul>
                        <li>
                            <div class="row">
                                <div class="">
                                    <img src="<?php echo e(asset('front_end/images/phone_contact.png')); ?>" alt="">
                                </div>
                                <div class="ml-3">
                                    <h5>Phone:</h5>
                                    <p>1-800-000-111</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="">
                                    <img src="<?php echo e(asset('front_end/images/mail_contact.png')); ?>" alt="">
                                </div>
                                <div class="ml-3">
                                    <h5>Email:</h5>
                                    <p>drolmaa@gmail.com</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="">
                                    <img src="<?php echo e(asset('front_end/images/map_contact.png')); ?>" alt="">
                                </div>
                                <div class="ml-3">
                                    <h5>Address:</h5>
                                    <p>40 Park Ave, Brooklyn, New York</p>
                                </div>
                            </div>
                            
                        </li>
                    </ul>
                </div>
                <div class="m-2 mb-3 social_contact_page">
                    <h4>Social Media</h4>
                    <div class="d-flex">
                        <div class="mr-2">
                            <a href="#"><img src="<?php echo e(asset('front_end/images/insta_contact.png')); ?>" alt=""></a>
                        </div>
                        <div class="mr-2">
                            <a href="#"><img src="<?php echo e(asset('front_end/images/twitter_contact.png')); ?>" alt=""></a>
                        </div>
                        <div class="mr-2">
                            <a href="#"><img src="<?php echo e(asset('front_end/images/fb_contact.png')); ?>" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-3  contact_right_side">
                    <div class="heading_contact_form">
                        <h5 class="text-light">Send Message</h5>
                    </div>
                    <form action="<?php echo e(route('contact-submit')); ?>" method="post" class="py-3 form-contact">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e(config('constant.ENQUIERY.CONTACT')); ?>" name="module_type">
                        <input type="hidden" value="0" name="module_id">
                        <div class="form-group">
                            <input type="text" placeholder="Name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                          </div>
                          <div class="form-group">
                            <input type="number" placeholder="Phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"required>
                          </div>

                        <div class="form-group">
                          <input type="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="message" id="exampleFormControlTextarea1" rows="4"
                                placeholder="Message" <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> autofocus <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>><?php echo e(old('message')); ?></textarea>
                                <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                                <p class="text-danger"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="button_contact_page btn btn-outline-danger">Submit</button>
                      </form>
                </div>        
            </div>
        </div>
    </div>
</section>
<section id="contact-inner-map" class="mt-3 contact-inner-map">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3561.0538075353047!2d75.80605011432236!3d26.80641528317342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396dca1fe06c75bb%3A0x297fdc671e9bbd9a!2si4%20Consulting%20Pvt.%20Ltd.%20%7C%20Web%2C%20Mobile%20App%20Development%20%26%20Digital%20Marketing%20Agency%20in%20Jaipur!5e0!3m2!1sen!2sin!4v1618895896661!5m2!1sen!2sin"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
 
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/pages/contact.blade.php ENDPATH**/ ?>