<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style> 
.fas, .far{
   color: #952A16;
}
</style>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/shopimg.png')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Shops</h2>
            </div>
        </div>
    </div>
</section>
<section id="about-product" class="about-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center product-name">
                    <h3>Products</h3>
                    <!--  with Medicine -->
                </div>
            </div>
        </div>
    </div>
</section>
<section id="product-des" class="product-des">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
                <div class="full-box" style="padding-bottom: 10px;">
                    <div class="categ-pro">
                        <p class="lag-catag">Categories</p>
                    </div>
                    <hr>
                    <div class="search-input">
                        <form action="<?php echo e(route('page.shop')); ?>" class="form-appoint">
                            <div class="input-group">
                                <input type="text" class="form-control" value="<?php echo e($request->keyword); ?>" name="keyword" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary ss" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php if(count($category)>0): ?>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="theropy-tool" >
                                <p class="the-para"><?php echo e($cat->category_name); ?></p> 
                                <?php $keyword = $request->keyword;  
                                $getData = \DB::table('products')->where(['category_id' => $cat->category_id]) 
                                ->Where(function($query) use ($keyword) {
                                    if (isset($keyword) && !empty($keyword)) { 
                                        $query->where('product_name','LIKE', "%". $keyword."%");
                                    }  
                                })->where('status',config('constant.BLK_UNBLK.UNBLOCK'))->where('deleted_at',NULL)->get(); 
                                if(count($getData)>0){
                                    foreach($getData as $data){?>
                                        <div class="form-check list-regular"> 
                                            <a href="<?php echo e(route('page.shopDetail',$data->product_id)); ?>">
                                                <label style="cursor: pointer;padding-left: 0px;" class="form-check-label text-color" for="flexCheckChecked1">
                                                <i class="fas fa-chevron-right mr-2"></i> <?php echo e(ucwords(strtolower($data->product_name))); ?>

                                                </label>
                                            </a>
                                        </div> 
                                <?php }} ?>
                            </div> 
                        <hr> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="theropy-tool" > 
                            <?php $keyword = $request->keyword;  
                            $getData = \DB::table('products') 
                            ->Where(function($query) use ($keyword) {
                                if (isset($keyword) && !empty($keyword)) { 
                                    $query->where('product_name','LIKE', "%". $keyword."%");
                                }  
                            })->where('status',config('constant.BLK_UNBLK.UNBLOCK'))->where('deleted_at',NULL)->get(); 
                            if(count($getData)>0){
                                foreach($getData as $data){?>
                                    <div class="form-check list-regular"> 
                                        <a href="<?php echo e(route('page.shopDetail',$data->product_id)); ?>">
                                            <label style="cursor: pointer;padding-left: 0px;" class="form-check-label text-color" for="flexCheckChecked1">
                                            <i class="fas fa-chevron-right mr-2"></i> <?php echo e(ucwords(strtolower($data->product_name))); ?>

                                            </label>
                                        </a>
                                    </div> 
                            <?php }} ?>
                        </div>  
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <?php if(count($products)>0): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 col-sm-6 col-lg-3 col-xl-3"> 
                                    <div class="product-box" >
                                        <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$prod->product_id);
                                        $favExist = CommonFunction::GetMultiWhereData('favourate','product_id',$prod->product_id,'user_id',Session::get('user_id'))?>
                                        <img style="height: 00px;min-height: 160px;width: 100%;max-width: 100% !important;position: relative;" src="<?php if(!empty($image_name)){?><?php echo e(asset('products/'.$image_name)); ?><?php }else{?><?php echo e(asset('front_end/images/blogimg.jpg')); ?><?php }?>" alt="" class="img-fluid m-icos">
                                        <div class="overlay"></div> 
                                        <div class="wis-lis">  
                                            <?php if(!empty($favExist)): ?>
                                                <i onclick="addTofavourat('<?php echo e($prod->product_id); ?>','<?php echo e(Session::get('user_id')); ?>')" style="color:#952A16;font-size: 30px;" class="fas fa-heart"></i> 
                                            <?php else: ?>
                                                <img onclick="addTofavourat('<?php echo e($prod->product_id); ?>','<?php echo e(Session::get('user_id')); ?>')" src="<?php echo e(asset('front_end/images/like.png')); ?>" alt="" class=" img-fluid like-img">
                                            <?php endif; ?>
                                            <a href="<?php echo e(route('page.shopDetail',$prod->product_id)); ?>"><img src="<?php echo e(asset('front_end/images/view.png')); ?>" alt="" class=" img-fluid like-img"> </a>
                                            <button type="button" class="btn btn-danger btn_small btn-sm"onclick="addToCart('<?php echo e($prod->product_id); ?>','<?php echo e(Session::get('user_id')); ?>')">Add To Cart</button>
                                            
                                            </div>
                                    </div>
                                    <a href="<?php echo e(route('page.shopDetail',$prod->product_id)); ?>">
                                        <h5 style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis; max-width: 150px;" class="tool-the"><?php echo e(ucwords(strtolower($prod->product_name))); ?></h5>
                                        <p class="tool-para"> <?php echo e(CommonFunction::GetSingleField('category','category_name','category_id',$prod->category_id)); ?></p>
                                        <p class="indrupee"> &#8377 <span class="yerupee"><?php echo e(number_format($prod->selling_price,2,'.',',')); ?></span></P>
                                        <p class="mb-5"><span class="star-rating"><?php if($prod->rating == 1): ?> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($prod->rating == 2): ?> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php elseif($prod->rating == 3): ?> <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i>  <i class="far fa-star"></i> <?php elseif($prod->rating == 4): ?> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="far fa-star"></i> <?php elseif($prod->rating == 5): ?> <i class="fas fa-star"></i> <i class="fas fa-star"></i>  <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <?php else: ?> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <i class="far fa-star"></i> <?php endif; ?></p>
                                    </a>
                            </div> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        No Record Found
                    <?php endif; ?>
                </div>
                <div class="paginationPara">
                    <?php echo e($products->appends($request->all())->render('vendor.pagination.custom')); ?>

                </div>
                <ul class="mb-4 pagination justify-content-start">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="active   page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>
        
</section>

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
function addTofavourat(id, userid){ 
    if(userid == ''){
        window.location.href = "<?php echo e(url('user_login')); ?>";
    }else{
        $.ajax({ 
            type:'POST',
            url: "<?php echo e(route('addtofavourate')); ?>",
            data:  { userid: userid, id: id, "_token": "<?php echo e(csrf_token()); ?>"}, 
            dataType: "json", 
            success: function(response) {  
                console.log(response.message); 
                window.location.reload();
            alert(response.message); 
            },
            error: function(xhr,status,error){  
                var err = eval("(" + xhr.responseText + ")");
                console.log(err);
                alert(err.message);    
            }
        }); 
    }
}
</script>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/pages/shop.blade.php ENDPATH**/ ?>