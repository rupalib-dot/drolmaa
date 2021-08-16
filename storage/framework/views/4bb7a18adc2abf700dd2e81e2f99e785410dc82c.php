<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>

<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/shopimg.png')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Product Details</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-product" class="about-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                <div class="product-photo">
                    <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$id)?>
                    <img style="width: 100%;height: 320px;" src="<?php if(!empty($image_name)){?><?php echo e(asset('products/'.$image_name)); ?><?php }else{?><?php echo e(asset('front_end/images/blogimg.jpg')); ?><?php }?>" alt="" class="mas-img">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-lg-6 col-xl-6">
                <div class="product-name">
                    <h3><?php echo e(ucwords(strtolower($product['product_name']))); ?> </h3>
                    <h3><?php echo e(CommonFunction::GetSingleField('category','category_name','category_id',$product['category_id'])); ?></h3>
                    <p class="mt-5"><span class="star-rating"><?php if($product['rating'] == 1): ?> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($product['rating'] == 2): ?> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($product['rating'] == 3): ?> <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> <?php elseif($product['rating'] == 4): ?> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <?php elseif($product['rating'] == 5): ?> <i class="fas fa-star"></i> <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <?php else: ?> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php endif; ?><span
                                class="cust-review ml-2"></span></p>
                    <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="indrupee mb-3"> &#8377 <span class="yerupee"><?php echo e(number_format($product['selling_price'],2,'.',',')); ?></span></P>
                        <!-- <a href="#" class="readMoreCta"> Add to Cart <i class="fas fa-shopping-cart"></i> </a> -->
                        </div>
                        <div class="col-md-2">
                            <i style="color:#952A16;font-size: 30px;" class="fas fa-heart"></i>    
                        </div>  
                    <div class="col-md-4">
                        <a type="button" onclick="addToCart('<?php echo e($id); ?>','<?php echo e(Session::get('user_id')); ?>')" class="readMoreCta">Add to Cart <i class="fas fa-shopping-cart"></i></a>
                    </div>
                     
                    </div>           
                    <hr>
                 
                    <p class="guide-text"><?php echo e($product['description']); ?></P>
                    <!-- <?php if(Session::get('role_id') == 3): ?> -->
                        <!-- <div class="check-out mb-2">
                            <button type="button" onclick="addToCart('<?php echo e($id); ?>','<?php echo e(Session::get('user_id')); ?>')" class="checkbtn btn">Add to Cart</button>
                            <button type="button" href="<?php echo e(url('checkout')); ?>" class="cartbtn btn ml-3">Checkout</button> 
                        </div> -->
                    <!-- <?php endif; ?> -->
                    <!-- <a href="#" class="wisha mr-3"><i class="fa fa-heart" aria-hidden="true"><span
                                class="ml-2 addlis">Browse
                                Wishlist</span></i></a>
                    <a href="#" class="wisha"><i class="fa fa-balance-scale" aria-hidden="true"></i><span
                            class="ml-2 addlis">Add to compare</span></i></a> -->
                </div>
            </div>
        </div>
        <hr class="mt-0">
    </div>
</section>
<section id="about-inst" class="about-inst">
    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
              <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">References</a>
              <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Review Product</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="mt-4 Des-book">
                    <h4 class="bold-heading">Description</h4>
                    <p><?php echo e($product['description']); ?>

                    </P>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <div class="mt-4 des-instru">
                    <h4 class="bold-heading">Instructions</h4>
                    <p><?php echo e($product['instructions']); ?></p> 
                </div>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="mt-4 refer-book">
                    <h4 class="bold-heading">References</h4>
                    <p><?php echo e($product['referenceses']); ?></p> 
                </div>
            </div>
          </div>
        <hr>
    </div>
</section>
<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4>You Might Also Like</h4>
            </div>
        </div>
        
    </div>
    
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
function addToCart(id, userid){  
    if(userid == ''){
        window.location.href = "<?php echo e(url('user_login')); ?>";
    }else{
        $.ajax({ 
            type:'POST',
            url: "<?php echo e(route('addtocart')); ?>",
            data:  { userid: userid, id: id ,"_token": "<?php echo e(csrf_token()); ?>"},
            dataType: "json",
            success: function(response) {   
                console.log(response.message); 
                window.location.reload();
            alert(response.message);  
            },error: function(xhr,status,error){  
                var err = eval("(" + xhr.responseText + ")");
                console.log(err);
                alert(err.message); 
            }
        });  
    }
}

 
</script>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/pages/shop_details.blade.php ENDPATH**/ ?>