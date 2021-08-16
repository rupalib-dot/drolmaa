@include('include.header')
@include('include.nav')
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url({{asset('front_end/images/perticuler_blog.svg')}})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="hall-heading">{{CommonFunction::GetSingleField('category','category_name','category_id',$catid)}} Blogs</h2>
            </div>
        </div>
    </div>
</section>
<section id="blog-inner">
    <div class="container">
        <div class="row">
            <?php if(count($blogs) >0 ){
                foreach($blogs as $blog){ ?>
                    <a href="{{route('page.blogDetail',$blog->blog_id)}}">
                        <div class="col-md-4"> 
                            <div class="card blog-success" style=" height: 320px;">
                                <img style=" height: 120px;" src="{{asset('public/blog_image/'.$blog->blog_image)}}" class="card-img-top" alt="...">
                                <div class="card-body">    
                                        <h3 class="card-title text-dark">{{$blog->blog_title}}</h3>
                                        <p class="text-left"  style="display:block;white-space: nowrap; overflow: hidden;text-overflow: ellipsis;max-width: 400px; "> {{$blog->blog_details}}</p>
                                        <a href="{{route('page.blogDetail',$blog->blog_id)}}" class="read-more">Read More</a>
                                </div>
                            </div> 
                        </div>
                    </a>
            <?php }}else{?>
                <div class="col-md-12">  
                    <h3 style="text-align: center;">No Record Found</h3> 
                </div>
            <?php } ?>
        </div>
    </div>
</section>
 
@include('include.footer')
@include('include.footer_bottom') 