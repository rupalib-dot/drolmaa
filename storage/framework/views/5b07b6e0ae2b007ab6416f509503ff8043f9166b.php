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
                                <h3>Set Your Availability</h3>
                                <p class="schedule-choose">Choose a schedule below to create a new one that you can apply to your event types </p> 
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form action="<?php echo e(route('availabilty.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                            <div class="appoinment-available" id="availability-section">
                                                <div class="appoinment-month" id="availability-section">
                                                    <ul>
                                                        <?php $currentDate = date('m');
                                                        $newDate = date('m',strtotime('+14 days',strtotime(date('Y-m-d'))));
                                                        if($currentDate == $newDate){?>
                                                            <li><a href=""><?php echo e(date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))); ?></a>
                                                            <input type="hidden" name="available_month" value="<?php echo e(date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))); ?>" id="<?php echo e(date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))); ?>"></li> 
                                                        <?php }else{?>
                                                            <li><a href=""><?php echo e(date('M', mktime(0, 0, 0, $currentDate, 1, date('Y')))); ?></a>
                                                            <input type="hidden" name="available_month" value="<?php echo e(date('M', mktime(0, 0, 0, $currentDate, 1, date('Y')))); ?>" id="<?php echo e(date('M', mktime(0, 0, 0, $currentDate, 1, date('Y')))); ?>"></li> 
                                                            <li><a href=""><?php echo e(date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))); ?></a>
                                                            <input type="hidden" name="available_month" value="<?php echo e(date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))); ?>" id="<?php echo e(date('M', mktime(0, 0, 0, $newDate, 1, date('Y')))); ?>"></li> 
                                                        <?php }?> 
                                                    </ul>
                                                </div>
                                            
                                                <div class="appointment-date">
                                                    <ul>
                                                        <?php $begin = new DateTime( date('Y-m-d') );
                                                            $end   = new DateTime(date('Y-m-d',strtotime('+14 days',strtotime(date('Y-m-d')))));
                                                            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                                $date = $i->format("Y-m-d"); ?>
                                                                <li>
                                                                    <input <?php if(old('available_date') == date('Y-m-d',strtotime($date))) { echo 'checked';} ?> type="checkbox" class="checkbox caldate" name="available_date[]" value="<?php echo e(date('Y-m-d',strtotime($date))); ?>" id="<?php echo e(date('d',strtotime($date))); ?>">
                                                                    <label class="option-item" for="<?php echo e(date('d',strtotime($date))); ?>">
                                                                        <div class="option-inner-date"><?php echo e(date('d',strtotime($date))); ?></div>
                                                                        <div class="name"><?php echo e(date('D',strtotime($date))); ?></div>
                                                                    </label> 
                                                                </li> 
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                                

                                                <div class="appoinment-hours">
                                                    <table style="width:100%" class="table-time">
                                                        <tbody>  
                                                            <?php 
                                                            // date_default_timezone_set("Asia/Kolkata");
                                                                $range=range(strtotime("09:00"),strtotime("22:00"),60*60);
                                                                foreach($range as $time){ 
                                                                    $hr = date("h:i A",$time);
                                                                    $OnehrDiff = date("h:i A",strtotime('+1 hours',strtotime(date("h:i a",$time))));?>
                                                                <tr>
                                                                    <td><input type="checkbox" name="time[]" value="<?php echo e(date('H',$time).'_'.$hr); ?>" class="avail-regular"></td>
                                                                    <td> <?php echo e($hr .' - '.$OnehrDiff); ?></td>
                                                                    <!-- <td>Available</td> -->
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                            <button class="login1 btn" type="submit" name="submit">Submit</button>
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
 <?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/expert_panel/availability/create_availability.blade.php ENDPATH**/ ?>