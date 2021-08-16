<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
        <div class="container-fluid">
            <div class="row">
                <div class="header_workshop">
                    <div class="mt-3 mb-3 text-center">
                        <h3>Training Listing</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="margin-bottom:50px"> 
                <!-- <div class="pt-4 col-lg-12">  -->
                    <!-- <div class="tab-content" id="nav-tabContent"> -->
                        <!-- <div class="mt-4 tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> -->
                            <?php if(count($trainings)>0): ?>
                                <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="pt-4 col-lg-6"> 
                                        <div class="card border-0 mb-3" style="max-width:100%;" data-city="workshop_1">
                                            <div class="row no-gutters">
                                                <div class="col-md-3">
                                                    <img style="height: 100px;" src="<?php echo e(asset('training/'.$training->training_image)); ?>" class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card-body">
                                                        <h4 class="float-left card-title"><?php echo e($training->training_title); ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                       
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="card border-0  mb-3" style="max-width:100%;">
                                    <div class="row no-gutters">
                                        <h3 style="margin: auto;"> No Record Found</h3>
                                    </div>
                                </div> 
                            <?php endif; ?>
                            <hr>
                        <!-- </div>            
                    </div>  -->
                    <nav class="mb-4 mt-4" aria-label="Page navigation example"> 
                    <?php echo e($trainings->appends($request->all())->render('vendor.pagination.custom')); ?> 
                    </nav>
                    
                    
                <!-- </div> -->
                
            </div>
        </div>     
        <script>
function myFunction(workshop) {
  var dots = document.querySelector(`.card[data-city="${workshop}"] #oldtext`);
  var more = document.querySelector(`.card[data-city="${workshop}"] #moretext`); 
  var moreText = document.querySelector(`.card[data-city="${workshop}"] #more`);
   var btnText = document.querySelector(`.card[data-city="${workshop}"] #myBtn`);
  

  if (dots.style.display === "block") {
    dots.style.display = "none";
    more.style.display = "block";
    btnText.innerHTML = "Read less";
    moreText.style.display = "none";
  } 
  if(more.style.display === "none") {
    dots.style.display = "block";
    more.style.display = "block";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";
  }
  else{
    dots.style.display = "block";
    more.style.display = "none";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";  
  }
 
}
</script>
    </section>

<?php echo $__env->make('include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/pages/training.blade.php ENDPATH**/ ?>