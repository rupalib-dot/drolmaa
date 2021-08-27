@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/perticuler_blog.svg')}})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="hall-heading">Blogs Category</h2>
            </div>
        </div>
    </div>
</section>
<section id="blog-inner">
    <div class="container">
        <div class="row">
            <?php if(count($category) >0 ){
                foreach($category as $categorys){?>
                    <a href="{{route('page.bloglist',$categorys->category_id)}}">
                        <div class="col-md-4"> 
                            <div class="card blog-success">
                                <img height= 235px; src="{{asset('category/'.$categorys->category_image)}}" class="card-img-top" alt="...">
                                <div class="card-body">    
                                        <h3 class="card-title text-dark">{{$categorys->category_name}}</h3> 
                                        <a href="{{route('page.bloglist',$categorys->category_id)}}" class="read-more">View Blogs</a>
                                </div>
                            </div> 
                        </div>
                    </a>
            <?php } } ?> 
        </div>
    </div>
</section>
 
@include('include.footer')
@include('include.footer_bottom') 