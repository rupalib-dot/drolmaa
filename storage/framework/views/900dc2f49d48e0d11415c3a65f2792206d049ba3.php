<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-md-10">
                            <div class="dashboard-panel">
                            <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3>Edit Your Availability</h3>
                                <p class="schedule-choose">Edit a shedule that you can apply to your event types </p> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="<?php echo e(route('availabilty.update',$id)); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                            <div class="appoinment-available" id="availability-section">
                                                <div class="appoinment-month" id="availability-section">
                                                    <ul> 
                                                        <li><a href=""><?php echo e(date('d M, Y',strtotime($id))); ?></a> 
                                                    </ul>
                                                </div> 

                                                <div class="appoinment-hours">
                                                    <table style="width:100%" class="table-time">
                                                        <tbody>  
                                                            <?php if($id == date('Y-m-d')){
                                                            // date_default_timezone_set("Asia/Kolkata");
                                                                $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                foreach($range as $time){ 
                                                                    if(date("H",$time) > date('H')){
                                                                        $hr = date("h:i A",$time); 
                                                                        $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?>
                                                                        <?php $slots = CommonFunction::GetDateSlotStatus('availability','time',date('H',$time),'date',$id,'user_id',Session::get('user_id')); ?>
                                                                        <tr> 
                                                                            <td><input type="checkbox" name="time[]" value="<?php echo e(date('H',$time).'_'.$hr); ?>" <?php if(count($avail_slots)>0): ?> <?php $__currentLoopData = $avail_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateavail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($dateavail['time'] == date('H',$time)): ?> checked <?php else: ?> <?php endif; ?> <?php if($slots == config('constant.AVAIL_STATUS.BOOKED')): ?> disabled  style="background-color: grey;" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>  class="avail-regular"></td>
                                                                            <td> <?php echo e($hr .' - '.$OnehrDiff); ?></td>
                                                                            <td> <?php echo e(array_search($slots,config('constant.AVAIL_STATUS'))); ?> </td>
                                                                        </tr> 
                                                            <?php }}} else{
                                                                 $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                 foreach($range as $time){ 
                                                                     $hr = date("h:i A",$time); 
                                                                     $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?>
                                                                     <?php $slots = CommonFunction::GetDateSlotStatus('availability','time',date('H',$time),'date',$id,'user_id',Session::get('user_id')); ?>
                                                                    <tr> 
                                                                        <td><input type="checkbox" name="time[]" value="<?php echo e(date('H',$time).'_'.$hr); ?>" <?php if(count($avail_slots)>0): ?> <?php $__currentLoopData = $avail_slots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dateavail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($dateavail['time'] == date('H',$time)): ?> checked <?php else: ?> <?php endif; ?> <?php if($slots == config('constant.AVAIL_STATUS.BOOKED')): ?> disabled  style="background-color: grey;" <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>  class="avail-regular"></td>
                                                                        <td> <?php echo e($hr .' - '.$OnehrDiff); ?></td>
                                                                        <td> <?php echo e(array_search($slots,config('constant.AVAIL_STATUS'))); ?> </td>
                                                                    </tr>
                                                            <?php }} ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="mb-3"> 
                                            <button class="login1 btn" type="submit" name="submit">Update</button>
                                            </div>
                                        </form>
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
<?php echo $__env->make('include.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/expert_panel/availability/edit_availability.blade.php ENDPATH**/ ?>