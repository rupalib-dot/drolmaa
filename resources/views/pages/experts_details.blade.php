@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
    <div class="container-fluid">
        <div class="">
            <div class="col-sm-12">
                <div class="back-appoint"> 
                    <div class="dashboard-panel">
                        @include('include.validation_message')
                        @include('include.auth_message')
                        <h3 class="order-content">Expert Details</h3> 
                     
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal')
 