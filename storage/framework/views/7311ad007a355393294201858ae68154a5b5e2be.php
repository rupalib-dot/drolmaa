<script src="<?php echo e(asset('assets/js/libs/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/bootstrap/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/bootstrap/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="<?php echo e(asset('assets/plugins/apex/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/dashboard/dash_1.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap-maxlength/custom-bs-maxlength.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/form-validation.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/editors/markdown/simplemde.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/editors/markdown/custom-markdown.js')); ?>"></script>
<script>
    setTimeout(function(){
        $('.error-bg').hide();
        $('.success-bg').hide();
    } , 6000);

    checkall('todoAll', 'todochkbox');
    $('[data-toggle="tooltip"]').tooltip()
    $('selector').maxlength();
    $('.delete-user').click(function(e){
        if (confirm('Are you sure to delete ?')) {
            $(e.target).closest('form').submit()
        }
    });
    new SimpleMDE({
        element: document.getElementById("product_details"),
        spellChecker: false,
    });

    $(document).ready(function() { 
        var designation_id = $("select[name=designation]").val(); 
        if(designation_id != '')
        {
            var expert_id_hidden = $("input[name=expert_id_hidden]").val(); 
            expert_list(designation_id, expert_id_hidden);
        } 
    });

    function expert_list(designation_id, expert_id_hidden = '') 
        {
            var expert_id_hidden = $("#expert_id_hidden").val(); 
            $('#loadingBox').removeClass('d-none');
            $.ajax({
                url:"<?php echo e(route('expert.list.ajax')); ?>",
                type: "POST",
                data: {
                    designation_id: designation_id,
                    _token: '<?php echo e(csrf_token()); ?>' 
                },
                dataType : 'json',
                success: function (response) {
                    console.log(response);
                    $('.expert_list').find('option').remove();
                    $('.expert_list').append(`<option value="">Select expert</option>`);
                    response.forEach(function (ExpertList) {
                        $('.expert_list').append(`<option value="${ExpertList['user_id']}">${ExpertList['full_name']}</option>`);
                    });
                    if (expert_id_hidden != '') {
                        $('.expert_list option[value='+expert_id_hidden+']').attr('selected', 'selected');
                    }
                    $('#loadingBox').addClass('d-none');
                }
            });
        }
</script><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/admin/inc/scripts.blade.php ENDPATH**/ ?>