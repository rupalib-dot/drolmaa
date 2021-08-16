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
                            <div class="dashboard-panel" style="padding-top: 20px;">
                                <div class="container">
                                    <div class="justify-content-center row">
                                        <div class="col-md-3">
                                            <a href="<?php echo e(route('expworkshop.index',['status'=>$request['status'],'user'=>'admin'])); ?>"> <button class="w-100 <?php if(!isset($request['user']) || $request['user'] == 'admin'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Admin Workshop</button></a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="<?php echo e(route('expworkshop.index',['status'=>$request['status'],'user'=>'expert'])); ?>"> <button class="w-100 <?php if($request['user'] == 'expert'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">My Workshop</button></a>
                                        </div>   
                                    </div>    
                                </div> 
                                            
                                <?php echo $__env->make('include.validation_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php echo $__env->make('include.auth_message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div class="">
                                    <div class="mt-3 justify-content-around row">
                                        <div class="col-md-3">
                                            <a href="<?php echo e(route('expworkshop.index',['status'=>'upcoming','user'=>$request['user']])); ?>"> <button class="w-100 <?php if(!isset($request['status']) || $request['status'] == 'upcoming'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Upcoming Workshop</button></a>
                                        </div>
                                        <div class="col-md-3">
                                           <a href="<?php echo e(route('expworkshop.index',['status'=>'previous','user'=>$request['user']])); ?>"> <button class="w-100 <?php if($request['status'] == 'previous'): ?> curent-appoint <?php else: ?> previous-appoint <?php endif; ?>">Previous Workshop</button></a>
                                        </div>   
                                    </div> 
                                    <div class="justify-content-between row">
                                        <div class="align-self-center col-md-3">
                                <h3> <?php if($request['user'] == 'expert'): ?> My <?php else: ?> Admin  <?php endif; ?> Workshops</h3>

                                        </div>
                                        <div class="col-md-8">
                                            <form action="<?php echo e(route('expappointment.index')); ?>" class="form-appoint">

                                                <input style="margin-right: 5px !important;" type="date" name="from_date" value="<?php echo e(old('from_date',$request['from_date'])); ?>" class="mr-3">
            
                                                <input style="margin-right: 5px !important;" type="date" name="to_date" value="<?php echo e(old('to_date',$request['to_date'])); ?>">
                                                <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                                <a href="<?php echo e(url('expert/expappointment')); ?>"> <button type="button" class="filter"  style="margin-left:0px">Clear</button></a>
                                            </form>    
                                        </div>     
                                    </div>   
                                </div> 
                                
                                <!-- <form action="<?php echo e(route('expappointment.index')); ?>" class="form-appoint">

                                    <input style="margin-right: 5px !important;" type="date" name="from_date" value="<?php echo e(old('from_date',$request['from_date'])); ?>" class="mr-3">

                                    <input style="margin-right: 5px !important;" type="date" name="to_date" value="<?php echo e(old('to_date',$request['to_date'])); ?>">
                                    <select  name="payment_type" style="border: 1px solid var(--black1);padding: 9px;margin-right: 5px !important;">
                                    <option value="">Select Payment</option>
                                        <?php $__currentLoopData = config('constant.PAYMENT_MODE'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e(old('payment_type',$request['payment_type']) == $key ? 'selected' : ''); ?> value="<?php echo e($key); ?>"><?php echo e(ucfirst(strtolower($value))); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <button type="submit" class="filter" style="margin-left:0px;margin-right: 5px !important;">Filter</button> 
                                    <a href="<?php echo e(url('expert/expappointment')); ?>"> <button type="button" class="filter"  style="margin-left:0px">Clear</button></a>
                                </form> -->
                                <table class="table table-bordered appoint-table" style="width:100%; margin-top:20px">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Title</th> 
                                            <!-- <th>Experts</th>  
                                            <th>Designation</th>   -->
                                            <th>Price</th>
                                            <th>Start Date</th> 
                                            <th>End Date</th> 
                                            <th>Time</th> 
                                            <th>Booking Counts</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($Workshops)>0): ?> 
                                            <?php $i=1; ?> 
                                            <?php $__currentLoopData = $Workshops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aGetData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <tr> 
                                                    <td><?php echo e($i); ?></td>
                                                    <td><?php echo e($aGetData->title); ?></td> 
                                                    <!-- <td><?php echo e($aGetData->expertUsers->full_name); ?></td>
                                                    <td><?php echo e($aGetData->designations->designation_title); ?></td>  -->
                                                    <td><i class="fas fa-rupee-sign"></i> <?php echo e(number_format($aGetData->price,2,'.',',')); ?></td>
                                                    <td><?php echo e(date('d M,Y',strtotime($aGetData->start_date))); ?></td>
                                                    <td><?php echo e(date('d M,Y',strtotime($aGetData->date))); ?></td> 
                                                    <td><?php echo e(date('H:i A',strtotime($aGetData->time))); ?></td>
                                                    <td><?php echo e(CommonFunction::workshopBookedCount($aGetData->workshop_id)); ?></td>
                                                    <td>
                                                        <span class="view-icon" title="delete"><a onclick="return confirm('Are you sure you want to delete this workshop?')" href="<?php echo e(route('expworkshop.delete',$aGetData->workshop_id)); ?>" style="cursor:pointer"><i class="far fa-trash-alt"></i></a></span>
                                                        <span class="view-icon" title="Edit"><a href="<?php echo e(route('expworkshop.edit',$aGetData->workshop_id)); ?>" style="cursor:pointer"><i class="fas fa-edit"></i></a></span> 
                                                        <span class="view-icon" title="view"><a href="<?php echo e(route('expworkshop.show',$aGetData->workshop_id)); ?>" style="cursor:pointer"><i class="fas fa-eye"></i></a></span>   
                                                    </td>
                                                </tr> 
                                            <?php $i++; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                        <?php else: ?>
                                            <tr> 
                                                <td colspan="8">No Record Found</td>
                                            </tr> 
                                        <?php endif; ?>  
                                    </tbody>
                                </table>
                            </div>
                            <div class="paginationPara">  
                            <?php echo e($Workshops->appends($request->all())->render('vendor.pagination.custom')); ?>

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
<?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/expert_panel/workshop/list.blade.php ENDPATH**/ ?>