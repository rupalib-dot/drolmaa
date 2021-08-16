<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="contact-page-inner" id="contact-page-inner" role="contact"
    style="background-image:url(<?php echo e(asset('front_end/images/shopimg.png')); ?>)">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="hall-heading">Order NO:- <?php echo e($order['order_no']); ?></h2>
            </div>
        </div>
    </div>
</section>
<section id="about-product" class="about-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-6" style="text-align: right;margin-bottom: 30px;"></div> 
            <div class="col-lg-6" style="text-align: right;margin-bottom: 30px;"> <a href="<?php echo e(route('customer.order')); ?>"><button class="update btn ">Back</button></a> </div>
        </div>
        <div class="m-1 row order-details_aftr" >    
            <div class="col-lg-6">  
                <p>Name :- <?php echo e($order['full_name']); ?></p>
                <p>Company Name :- <?php if($order['company_name'] == ''): ?> N/A <?php else: ?> <?php echo e($order['company_name']); ?> <?php endif; ?> </p>
                <p>Mobile Number :- +91 <?php echo e($order['mobile_number']); ?></p>
                <p>Email Address :- <?php echo e($order['email_address']); ?></p> 
                <p>Gender :- <?php echo e(array_search($order['user_gender'],config('constant.GENDER'))); ?></p>  
                <p>Pincode :- <?php echo e($order['pincode']); ?></p> 
                <p>Payment Id :- <?php echo e($order['payment_id']); ?></p>
                <p>Payment Mode :- <?php echo e(array_search($order['payment_type'],config('constant.PAYMENT_MODE'))); ?></p>
                <p>Payment Status :- <?php echo e(ucwords($order['payment_status'])); ?></p> 
                <p>Grand Total :- <i class="fas fa-rupee-sign"></i> <?php echo e(number_format($order['grand_total'],2,'.',',')); ?></p> 
            </div>
            <div class="col-lg-6">
                <p>Address Line1 :- <?php echo e($order['address1']); ?></p>
                <p>Address Line2 :- <?php echo e($order['address2']); ?></p> 
                <p>Country :- <?php echo e(CommonFunction::GetSingleField('country','country_name','country_id',$order['country_id'])); ?></p>
                <p>State :- <?php echo e(CommonFunction::GetSingleField('state','state_name','state_id',$order['state_id'])); ?></p>
                <p>City :- <?php echo e(CommonFunction::GetSingleField('city','city_name','city_id',$order['city_id'])); ?></p>  
                <p>Order Status :- <?php echo e(array_search($order['order_status'],config('constant.STATUS'))); ?></p>
                <p>Order Date :- <?php echo e(date('M d, Y',strtotime($order['created_at']))); ?></p>
                <p>Refund Id :-<?php if($order['refund_id'] == ''): ?> N/A <?php else: ?> <?php echo e($order['refund_id']); ?> <?php endif; ?> </p>
                <p>Refund Amount :- <?php if($order['refund_amount'] == ''): ?> N/A <?php else: ?><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($order['refund_amount'],2,'.',',')); ?><?php endif; ?> </p> 
            </div>  
        </div>
    </div>
</section>
<section id="your-cart" class="your-cart">
    <div class="container"> 
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="cart-box">
                    <table class="d-lg-table table-responsive table box-demo" style="margin-bottom:0px">
                        <thead class="text-black">
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th> 
                                <th scope="col">Total Price</th>   
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($orderDetail)>0): ?>
                                <?php $__currentLoopData = $orderDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getOrderData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <?php $image_name = CommonFunction::GetSingleField('product_images','image_name','product_id',$getOrderData->product_id); ?>
                                        <td><img style="    width: 100px; height: 100px;" src="<?php if(!empty($image_name)){?><?php echo e(asset('products/'.$image_name)); ?><?php }else{?><?php echo e(asset('front_end/images/blogimg.jpg')); ?><?php }?>" alt="" class="img-pro"> <p class="fnt mt-2"><?php echo e($getOrderData->product_name); ?></p> </td>
                                        <td class="py-0"> <?php echo e($getOrderData->quantity); ?> </td>
                                        <td class="py-0"> <p class="indrupee"> &#8377 <span class="yerupee"><?php echo e(number_format($getOrderData->price,2,'.',',')); ?></span></p> </td>
                                        <td class="text-red py-0"> <p class="indrupee">&#8377 <span class="yerupee"><?php echo e(number_format($getOrderData->total_price,2,'.',',')); ?></span></p></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"> No Record Found</td> 
                                </tr>
                                
                            <?php endif; ?>
                        </tbody>
                    </table>  
                </div>
            </div> 
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('include.footer_bottom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
 <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/orders/orderDetail.blade.php ENDPATH**/ ?>