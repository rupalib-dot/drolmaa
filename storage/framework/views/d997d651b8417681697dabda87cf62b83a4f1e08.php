<script>
function addFeedback(feedback_to,moduleId,moduleType){
    $("#exampleModal #module_id").val(moduleId);
    $("#exampleModal #module_type").val(moduleType);
    $("#exampleModal #feedback_to").val(feedback_to);
    $("#exampleModal").modal('show');
}
function ratingSelected(rating){  
    if(rating == 1){
        $('#rating1').addClass('active');
        $('#rating2').removeClass('active');
        $('#rating3').removeClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop("checked", true);
        $('#rating2').prop('checked', false);
        $('#rating3').prop('checked', false);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 2){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').removeClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', false);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 3){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').removeClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', false);
        $('#rating5').prop('checked', false);
    }else if(rating == 4){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').addClass('active');
        $('#rating5').removeClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', true);
        $('#rating5').prop('checked', false);
    }else if(rating == 5){
        $('#rating1').addClass('active');
        $('#rating2').addClass('active');
        $('#rating3').addClass('active');
        $('#rating4').addClass('active');
        $('#rating5').addClass('active');
        $('#rating1').prop('checked', true);
        $('#rating2').prop('checked', true);
        $('#rating3').prop('checked', true);
        $('#rating4').prop('checked', true);
        $('#rating5').prop('checked', true);
    }
}
</script>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
             
            <form method="POST" id="feedback" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body"> 
                    <input id="module_id" name="module_id" type="hidden">
                    <input id="module_type" name="module_type" type="hidden"> 
                    <input id="feedback_to" name="feedback_to" type="hidden"> 
                    
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <div class="sDoc_File"> 
                                <label for="exampleFormControlFile1">Rating </label>
                                <div class="row">
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating1" name="rating" data-id="1" class="form-control" value="1" id="rating">
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating2" name="rating" data-id="2" class="form-control" value="2" id="rating"> 
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating3" name="rating" data-id="3" class="form-control" value="3" id="rating"> 
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating4" name="rating" data-id="4" class="form-control" value="4" id="rating"> 
                                    <input onclick="ratingSelected(this.value)" type="checkbox" id="rating5" name="rating" data-id="5" class="form-control" value="5" id="rating">  
                                </div>
                                <span class="text-danger" id="rating-error"></span>
                            </div>  
                        </div>
                    </div> 
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group mb-4">
                            <label for="name">Message</label>
                            <textarea class="form-control" name="note" id="note" rows="3" placeholder="Message"><?php echo e(old('message')); ?></textarea>
                            <span class="text-danger" id="note-error"></span>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function (e) { 
        setInterval(function(){ $("div .alert").hide(); }, 4000); 

        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        
        $('#feedback').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "<?php echo e(url('feedback-submit')); ?>",
                data: formData,
                cache:false,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {     
                    window.location.reload();
                    alert(response.message);  
                },
                error: function(xhr,status,error){  
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    $("#note-error").text(err.errors.note); 
                    $("#rating-error").text(err.errors.rating);
                }
            });
        });
    });
</script><?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/include/modal.blade.php ENDPATH**/ ?>