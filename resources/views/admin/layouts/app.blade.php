<!doctype html>
<html>
<head>
    <title>{{$title}} | Drolmaa</title>
    @include('admin.inc.styles')
</head>
<body>
    
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    @include('admin.inc.navbar')
    
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('admin.inc.sidebar')

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">

            @yield('content')
        </div>
        <!--  END CONTENT PART  -->

    </div>
    <!-- END MAIN CONTAINER -->

    @include('admin.inc.scripts')
    <script>
function payExpert(name,userid,amountLeft){ 
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
                url: "{{url('admin/payexpert-submit')}}",
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
