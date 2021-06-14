@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/contactimg.png')}})">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Blogs</h2>
            </div>
        </div>
    </div>
</section>
<section id="blog-inner">
    <div class="container">
        <div class="row">
            <a href="{{route('page.blogDetail')}}">
                <div class="col-sm-12"> 
                    <div class="blog-success">
                        <h3>From Failure To Success</h3>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <a href="{{route('page.blogDetail')}}" class="read-more">Read More</a>
                    </div> 
                </div>
             </a>
            <a href="{{route('page.blogDetail')}}">
                <div class="col-sm-12"> 
                    <div class="blog-success">
                        <h3>From Failure To Success</h3>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <a href="{{route('page.blogDetail')}}" class="read-more">Read More</a>
                    </div> 
                </div>
            </a>
            <a href="{{route('page.blogDetail')}}">
                <div class="col-sm-12"> 
                    <div class="blog-success">
                        <h3>From Failure To Success</h3>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <a href="{{route('page.blogDetail')}}" class="read-more">Read More</a>
                    </div> 
                </div>
            </a>
            <a href="{{route('page.blogDetail')}}">
                <div class="col-sm-12"> 
                    <div class="blog-success">
                        <h3>From Failure To Success</h3>
                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <a href="{{route('page.blogDetail')}}" class="read-more">Read More</a>
                    </div> 
                </div>
            </a>
        </div>
    </div>
</section>
 
@include('include.footer')
@include('include.footer_bottom') 