<?php echo $__env->make('include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('include.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="px-0 container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint">
                    <div class="row">
                        <?php echo $__env->make('include.expert_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="col-lg-10">
                            <div class="dashboard-panel">
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <h3 class="order-content">My Availability</h3> 
                                <div class="row" style="margin-bottom:20px">
                                    <div class="col-lg-12">
                                        
                                    <!-- Button trigger modal -->
                                    <button type="button" class="float-lg-right filter btn btn-primary" style="background-color: #ba4811;border-color: #ba4811;" data-toggle="modal" data-target="#exampleModal">Add Availability</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title text-light" id="exampleModalLabel">Add Availability</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-left mt-3">
                                                <h3 class="text-left">Date</h3>
                                                <form>
                                                    <div class="form-group">
                                                      <label for="exampleInputEmail1">From</label>
                                                      <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                                      <small id="emailHelp" class="form-text text-muted">We'll never share your Details with anyone else.</small>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="exampleInputPassword1">To</label>
                                                      <input type="date" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Time Slot</label>
                                                        <select class="form-control"name="time_slot" id="">
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                            <option value="10.30">10.30</option>
                                                        </select>
                                                      </div>
                                                    
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <table class="table-responsive table table-bordered appoint-table" style="width:100%">
                                    <thead>
                                        <tr>  
                                            <th>Day</th> 
                                            <th>Date</th>
                                            <th>Slot Available</th> 
                                            <th>Slot Booked</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($avail_slots)>0): ?>
                                            <?php $begin = new DateTime( date('Y-m-d') );
                                                $end   = new DateTime(date('Y-m-d',strtotime('+14 days',strtotime(date('Y-m-d')))));
                                                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                                                    $date = $i->format("Y-m-d"); ?>
                                                    <tr>
                                                        <td><?php echo e(date('l',strtotime($date))); ?></td>
                                                        <td><?php echo e(date('d M, Y',strtotime($date))); ?></td> 
                                                        <td><?php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.AVAILABLE')); ?> <?php if($count == 0): ?> No Slot Available <?php else: ?> <?php echo e($count); ?> Slots Available <?php endif; ?></td> 
                                                        <td><?php $count = CommonFunction::GetDateSlotCount('availability','date',$date,'user_id',Session::get('user_id'),'status',config('constant.AVAIL_STATUS.BOOKED')); ?> <?php if($count == 0): ?> No Slot Booked <?php else: ?> <?php echo e($count); ?> Slots Booked <?php endif; ?></td> 
                                                        <td>
                                                            <span class="view-icon" title="feedback"><a style="cursor:pointer" href="<?php echo e(route('availabilty.edit',$date)); ?>"><i class="fas fa-edit"></i></a></span>
                                                        </td>
                                                    </tr>
                                            <?php } ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8">No Record Found</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody> 
                                </table>
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
 <?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/expert_panel/availability/availability.blade.php ENDPATH**/ ?>