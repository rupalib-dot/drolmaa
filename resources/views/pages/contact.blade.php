@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/contactimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Contact</h2>
            </div>
        </div>
    </div>
</section>
<section id="get-touch" class="get-touch" role="get-touch">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Get in Touch with Us</h3>
                <p>Any question or remarks? Just write us a message!</p>
            </div>
        
    
            <div class="col-md-4">
                <div class="single-cta">
                    <span class="icon">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </span>
                    <span class="cta-text">
                        <h4> Address:</h4>
                        <span>40 Park Ave, Brooklyn, New York</span>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-cta">
                    <span class="icon">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </span>
                    <span class="cta-text">
                        <h4> Phone:</h4>
                        <span><a href="tel:1-800-000-111" class="infodes">1-800-000-111</a></span>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-cta">
                    <span class="icon">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                    <span class="cta-text">
                        <h4> Email:</h4>
                        <span><a href="mailto:drolmaa@gmail.com" class="infodes">drolmaa@gmail.com</a></span>
                    </span>
                </div>
            </div>
        </div>
    
        @include('include.validation_message')
        @include('include.auth_message')
    <form action="{{route('contact-submit')}}" method="post" class="form-contact">
    @csrf
        <input type="hidden" value="{{config('constant.ENQUIERY.CONTACT')}}" name="module_type">
        <input type="hidden" value="0" name="module_id">
        <div class="row">
            <div class="col-md-4">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" value="{{old('name')}}" placeholder="Name" name="name" aria-label="Name"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" value="{{old('phone')}}" name="phone" placeholder="Phone" aria-label="Phone"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-4">
                    <input type="text" class="form-control" value="{{old('email')}}" name="email" placeholder="Email" aria-label="Email"
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col-sm-12">
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"
                    placeholder="Message">{{old('message')}}</textarea>
            </div>
            <button name="submit" class="submit-contact">Sumbit</button>
        </div>
        </div>

</section>
<section id="contact-inner-map" class="contact-inner-map">
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
 
@include('include.footer')
@include('include.footer_bottom') 