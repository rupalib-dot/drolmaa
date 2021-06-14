<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/js/popper.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/plugins/blockui/jquery.blockUI.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('assets/js/authentication/form-2.js')}}"></script>
<script src="{{asset('assets/js/authentication/form-1.js')}}"></script>

<script>
    $(document).ready(function() {
        setInterval(function(){ $("div .alert").hide(); }, 4000); 
        App.init();
    });
</script>
<script src="{{asset('assets/plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('assets/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard/dash_2.js')}}"></script>
 
<!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
<script src="{{asset('assets/plugins/table/datatable/datatables.js')}}"></script>  
<!-- END PAGE LEVEL CUSTOM SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
<script src="{{asset('assets/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
<script src="{{asset('assets/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/form-validation.min.js')}}"></script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS --> 
<script>
    //First upload
    var firstUpload = new FileUploadWithPreview('myFirstImage') ;  
</script>
<script>
            $(document).ready(function (e) { 
                $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                });
                $('#upload-image-form').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        type:'POST',
                        url: "{{url('admin/add/project/doc')}}",
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
                            $("#image-input-error").text(err.errors.file); 
                            $("#actualhrs-input-error").text(err.errors.sAlctHours);
                        }
                    });
                });
            });
    </script>
 <script> $(document).ready(function() {
            $('#alter_pagination').DataTable( {
                "pagingType": "full_numbers",
                "oLanguage": {
                    "oPaginate": { 
                        "sFirst": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg>',
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                        "sLast": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
            });
        } );

        function expert_list(designation_id, expert_id_hidden = '') 
        {
            var expert_id_hidden = $("#expert_id_hidden").val();
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
    </script>
</body>
</html>