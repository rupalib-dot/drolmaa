<!doctype html>
<html>
<head>
    <title><?php echo e($title); ?> | Drolmaa</title>
    <?php echo $__env->make('admin.inc.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <?php echo $__env->make('admin.inc.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <?php echo $__env->make('admin.inc.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <?php echo $__env->make('admin.inc.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
function payExpert(name,userid,amountLeft){ 
    $("#payexpertModal #amount").val(amountLeft);
    $("#payexpertModal #amount").attr('max',amountLeft);
    $("#payexpertModal #userid").val(userid);
    $("#payexpertModal .name").text(name);
    $("#payexpertModal").modal('show');
}
</script>
<script>
    $(document).ready(function (e) { 
        setInterval(function(){ $("div .alert").hide(); }, 4000); 

        $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        
        $('#payExpert').submit(function(e) { 
            e.preventDefault();
            var formData = new FormData(this);  
            $.ajax({
                type:'POST',
                url: "<?php echo e(url('admin/payexpert-submit')); ?>",
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
                    $("#amount-error").text(err.errors.amount); 
                    $("#transaction_id-error").text(err.errors.transaction_id);
                    $("#transaction_date-error").text(err.errors.transaction_date);
                    $("#payment_mode-error").text(err.errors.payment_mode); 
                }
            });
        });
    });
</script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>