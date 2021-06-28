<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{asset('front_end/js/file-upload-with-preview.min.js')}}"></script>
<script src="{{asset('front_end/js/common-script.js')}}"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/owl.carousel.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>
<script src="{{asset('front_end/js/file-upload-with-preview.min.js')}}"></script>
<script src="{{asset('front_end/js/common-script.js')}}"></script>
<script>
setTimeout(function(){
    $('.error-bg').hide();
    $('.success-bg').hide();
} , 6000);
var myUpload = new FileUploadWithPreview('myUploader');

function getDate(date,time_hidden = ''){
    var time_hidden = $("input[name=time_hidden]").val();
    var expert_id = $("input[name=expert_id_hidden]").val();  
    if(expert_id == ''){
        var expert_id = $("select[name=expert]").val();
        if(expert_id == ""){
            alert('Select expert first');
        }
    }
        $('#loadingBox').removeClass('d-none');

    $.ajax({
        url:"{{route('timeslot.list.ajax')}}",
        type: "POST",
        data: {
            date: date,
            expert_id: expert_id,
            _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function (response) {
            console.log(response);  
                $('.time_list').find('option').remove();
                $('.time_list').append(`<option value="">Select Time Slot</option>`);
                response.forEach(function (timeSlotList) {
                    $('.time_list').append(`<option value="${timeSlotList['time_slot']}_${timeSlotList['time']}">${timeSlotList['time_slot']}</option>`);
                });

                if (time_hidden != '') {
                    alert(time_hidden);
                    $('.time_list option[value="' + time_hidden + '"]').attr('selected', 'selected');
                }
                $('#loadingBox').addClass('d-none');
            
        }
    });
}
function expert_list(designation_id, expert_id_hidden = '') 
{
    var expert_id_hidden = $("#expert_id_hidden").val();
    var date = $("input[name=date]").val(); 
    if(date != ""){
        var time_hidden = $("#time_hidden").val();
        var expert_id = $("select[name=expert]").val();
        getDate(date,time_hidden,expert_id);
    }
    $('#loadingBox').removeClass('d-none');
    $.ajax({
        url:"{{route('expert.list.ajax')}}",
        type: "POST",
        data: {
            designation_id: designation_id,
            _token: '{{csrf_token()}}' 
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
                $('.expert_list option[value=' + expert_id_hidden + ']').attr('selected', 'selected');
            }
            $('#loadingBox').addClass('d-none');
        }
    });
}

function workshop_details(module_id) 
{  
    $.ajax({
        url:"{{route('workshop.detail.ajax')}}",
        type: "POST",
        data: {
            module_id: module_id,
            _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function (response) { 
            if(response.success == true){ 
                $('#title').text(response.message.title);
                $('#designation').text(response.message.designation);
                $('#expert').text(response.message.expert);
                $('#price').text(response.message.price);
                $('#date').text(response.message.date);
                $('#time').text(response.message.time);
                $('#module_id').val(response.message.module_id);
                $('#module_type').val(response.message.module_type); 
                $('#payment').attr('action',response.message.action);  
                $('.paymentWidget').attr('src',"https://checkout.razorpay.com/v1/checkout.js");
                $('.paymentWidget').attr('data-amount',response.message.amount);
                $('.paymentWidget').attr('data-buttontext',response.message.buttonText);  
                $('.paymentWidget').attr('data-key',"{{env('RAZORPAY_KEY')}}");
                $('.paymentWidget').attr('data-name',"i4consulting.org");
                $('.paymentWidget').attr('data-description',"Rozerpay" ); 
                $('.paymentWidget').attr('data-image',"https://www.itsolutionstuff.com/frontTheme/images/logo.png"); 
                $('.paymentWidget').attr('data-theme.color',"#ff7529" );
                $('.razorpay-payment-button').val(response.message.buttonText); 
               
                $('.workshop_detail').show();
                // $('.workshop_detail').html(response); 
            }else if(response.success == false){  
                $('#title').text("");
                $('#designation').text("");
                $('#expert').text("");
                $('#price').text("");
                $('#date').text("");
                $('#time').text("");
                $('#module_id').val("");
                $('#module_type').val(""); 
                $('#payment').attr('action',"");  
                $('.paymentWidget').attr('src',"https://checkout.razorpay.com/v1/checkout.js");
                $('.paymentWidget').attr('data-amount',"");
                $('.paymentWidget').attr('data-buttontext',"");  
                $('.paymentWidget').attr('data-key',"{{env('RAZORPAY_KEY')}}");
                $('.paymentWidget').attr('data-name',"i4consulting.org");
                $('.paymentWidget').attr('data-description',"Rozerpay" ); 
                $('.paymentWidget').attr('data-image',"https://www.itsolutionstuff.com/frontTheme/images/logo.png"); 
                $('.paymentWidget').attr('data-theme.color',"#ff7529" );
                $('.razorpay-payment-button').val(""); 
               
                $('.workshop_detail').hide();
                alert(response.message);
              
            }
        },error: function(xhr,status,error){  
            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err.message); 
        }
    });
}

function state_list(country_id, state_id_hidden = '') 
{
    var state_id_hidden = $("#state_id_hidden").val();
    $('#loadingBox').removeClass('d-none');
    $.ajax({
        url:"{{route('state.list.ajax')}}",
        type: "POST",
        data: {
            country_id: country_id,
            _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function (response) {
            console.log(response);
            $('.state_list').find('option').remove();
            $('.state_list').append(`<option value="">Select State</option>`);
            response.forEach(function (StateList) {
                $('.state_list').append(`<option value="${StateList['state_id']}">${StateList['state_name']}</option>`);
            });

            if (state_id_hidden != '') {
                $('.state_list option[value=' + state_id_hidden + ']').attr('selected', 'selected');
            }
            $('#loadingBox').addClass('d-none');
        }
    });
} 

function city_list(state_id, city_id_hidden = '') 
{
    var city_id_hidden = $("#city_id_hidden").val();
    $('#loadingBox').removeClass('d-none');
    $.ajax({
        url:"{{route('city.list.ajax')}}",
        type: "POST",
        data: {
            state_id: state_id,
            _token: '{{csrf_token()}}' 
        },
        dataType : 'json',
        success: function (response) {
            $('.city_list').find('option').remove();
            $('.city_list').append(`<option value="">Select City</option>`);
            response.forEach(function (CityList) {
                $('.city_list').append(`<option value="${CityList['city_id']}">${CityList['city_name']}</option>`);
            });

            if (city_id_hidden != '') {
                $('.city_list option[value=' + city_id_hidden + ']').attr('selected', 'selected');
            }
            $('#loadingBox').addClass('d-none');
        }
    });
}
</script>

<div class="loading_bg loader-block d-none" id="loadingBox">
    <div class="loading_popup">
        <div><img src="{{asset('front_end/images/loder.gif')}}" width="90"></div>
        <strong class="loading_text">Processing, Please wait....</strong>
    </div>
</div>