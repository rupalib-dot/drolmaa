<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<style> 
.checked{
   color: #ffc800;
}
</style>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
    
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php if(Session::get('role_id') == 3): ?>
                            <?php echo $__env->make('include.client_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php elseif(Session::get('role_id') == 2): ?>
                            <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <div class="col-lg-9">
                        <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="dashboard-panel">
                                <div class="row my-4">
                                    <div class="col-lg-6">
                                        <h3 class="order-content">My Wishlist</h3>
                                    </div>
                                    
                                    <div class="col-lg-6 text-lg-right">
                                        <span class="view-icon"><a style="color:white" onclick="dele_multi()" class="btn btn-danger">DELETE</a></span> 
                                    </div>
                                </div>
                                <div class="my-3 row">
                                    <div class="mt-3 col-lg-6">
                                        <a href="#"><button class="w-100 <?php if(!isset($request['type']) || $request['type'] == 'current'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Expert List</button></a>
                                    </div>
                                    <div class="mt-3 col-lg-6">
                                        
                                <a href="#"><button class="w-100 <?php if($request['type'] == 'previous'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Product List </button></a>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="shadow p-3 mb-5 bg-white rounded  p-3 card border-0  mb-3" style="max-width:100%;">
                                <div class="row no-gutters">
                                    <div class="col-md-3">
                                    <img width="100%;" height="130px;" src="#" class="card-img" alt="...">
                                        <div class="pl-0 expert_button">
                                            <a style="min-width: 100%; text-align:center" href="#">View Profile</a> 
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-body">
                                            <h5 class="card-title">Expert Name</h5>
                                            <p class="text-muted">designation</p>
                                            <p class="text-muted">user_experience Years Experience Overall</p>
                                            <div class="my-1 d-flex">
                                                <img src="<?php echo e(asset('front_end/images/link_thumb.svg')); ?>" alt="">
                                                <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">rating</span>  <i class="fas fa-star checked"></i>                                            </div>
                                         
                                               
                                                    
                                                       
                                                            <p class="text-muted mb-0"> Available Slots</p>
                                                            <!-- <p class="text-muted mb-0">Available Slots</p> -->
                                                            <!-- <p class="text-muted mb-0">Booked Slots</p> -->
                                                            <div class="pl-3 row">
                                                                <div class="pl-0 col-lg-12 expert_time_slot">                           
                                            <div class="pl-0 col-lg-12 expert_button">
                                                <a style="display:none; text-align:center" href="" target="_blank"></a>
                                                <a style="text-align:center; margin-left: 60%;" href="<?php echo e(route('appointment.create')); ?>" target="_blank">Book Appointment</a>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="paginationPara">
                            <?php echo e($favourate->appends($request->all())->render('vendor.pagination.custom')); ?>

                                <!-- <ul class="pagination justify-content-center">
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Previouss</button>
                                        </a></li>
                                    <li class="page-serial"><a class="page-start" href="#">01</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">02</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">03</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">04</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">05</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">06</a></li>
                                    <li class="page-serial"><a class="page-start" href="#">07</a></li>
                                    <li class="page-serial"><a class="page-start" href="#"><button
                                                class="page-next">Next</button>
                                        </a></li>
                                </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<script>
function dele_multi(){
    var areaofinterest = '';

	$('.mul_del').each(function(i,e) {
        if ($(e).is(':checked')) {
            var comma = areaofinterest.length===0?'':',';
            areaofinterest += (comma+e.value);
        }
    });
    if(areaofinterest != ''){
        if (confirm('Are you sure you want to delete product from wishlist?')) {
            $.ajax({ 
                type:'POST',
                url: "<?php echo e(url('del_multi_wishlist')); ?>",
                data:  { areaofinterest: areaofinterest, "_token": "<?php echo e(csrf_token()); ?>"},
                dataType: "json",
                success: function(response) {   
                    console.log(response.message); 
                    window.location.reload(); 
                    // window.location.href="<?php echo e(url('viewcart')); ?>";
                    alert(response.message);  
                },error: function(xhr,status,error){  
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err.message); 
                }
            });   
        }  
    }else{
        bootbox.alert("Please select atleast one product to delete!");
    }
}
</script>

<?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/orders/myWishlist.blade.php ENDPATH**/ ?>