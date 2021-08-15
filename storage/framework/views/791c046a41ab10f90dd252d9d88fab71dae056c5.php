<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style> 
.razorpay-payment-button{
    color: #fff;
    background-color: #d87611;
    border-color: #d87611;  
    font-weight: 400; 
    text-align: center;
    vertical-align: middle; 
    user-select: none; 
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem; 
}
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.client_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-lg-10">
                            <div class="profile-form">
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3 class="order-content text-center">Welcome to y DrolMaa Constellation Club || </h3>
                     <div class="my-3">
                        <div class="profile-form">
                        <h3 class="order-content"><?php echo e($title); ?></h3>
                           
                        <div class="row layout-top-spacing" style="margin-top:40px"> 
                                    <div class="widget-heading col-lg-12">
                                        <h5 class="">Transactions</h5>
                                    </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="<?php echo e(route('custransaction.index',['type'=>'order'])); ?>">
                                        <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                                <div class="widget-heading">
                                                    <p class="w-value"><i class="fas fa-id-card"></i></p>
                                                    <h5 class=""> 
                                                    Orders
                                                    </h5>
                                                </div> 
                                        </div>
                                    </a>
                                </div>
                               
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <a href="<?php echo e(route('custransaction.index',['type'=>'appointment'])); ?>">
                                    <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                             <div class="widget-heading">
                                                <p class="w-value"><i class="far fa-calendar-check"></i></p>
                                                <h5 class="">Appoinments</h5>
                                            </div> 
                                       </div>
                                </a>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <a href="<?php echo e(route('custransaction.index',['type'=>'booking'])); ?>">
                                         <div class="widget widget-one_hybrid widget-followers" style="height: 95%;">
                                            <div class="widget-heading">
                                                <p class="w-value"><i class="fas fa-vote-yea"></i></p>
                                                <h5 class="">Bookings</h5>
                                            </div> 
                                        </div>
                                    </a>
                                </div>
                                
                             </div>
                           </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/customer_panel/transactions.blade.php ENDPATH**/ ?>