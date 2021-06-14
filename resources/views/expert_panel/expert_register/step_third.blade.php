@include('include.header')
@include('include.nav')
<section id="clientMemberLogin" class="clientMemberLogin padding-top" role="Member log In">

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="back1">
                    @include('include.validation_message')
                    <div class="clientTextF">
                        <h4 class="wel-heading">Welcome to</h4>
                        <h3>DrolMaa Constellation Club</h3>
                        <p class="clientP">Expert Register</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading width">Personal Details</p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="detail-heading width">Professional Details </p>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-detail">
                                <span class="count-back"><i class="fa fa-check" aria-hidden="true"></i></span>

                            </div>
                            <p class="pro-heading">Documents </p>
                        </div>

                        <div class="col-md-3 d-flex justify-content-center cont">
                            <div class="expert-count">
                                <span class="count-back">4</span>

                            </div>
                            <p>Payment & Submit
                            </p>
                        </div>
                    </div>
                    <form action="{{route('expert.third.step.post')}}" method="POST" enctype='multipart/form-data'
                        class="formLogIn">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type='file' name="aadhar_card_pic" placeholder="Browse computer" id="adharinput"
                                        class="form-control"> <span id='val'></span>
                                    <span id='adharbtn'><i class="flaticon-upload"></i></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-4">
                                    <input type='file' name="pan_card_pic" placeholder="Browse computer" id="paninput"
                                        class="form-control"> <span id='val1'></span>
                                    <span id='panbtn'><i class="flaticon-upload"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="input-group mb-4">
                                    <input type='file' name="licance_pic" placeholder="Browse computer" id="licenceinput"
                                        class="form-control"> <span id='val2'></span>
                                    <span id='licencebtn'><i class="flaticon-upload"></i></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                            <div class="input-group mb-4">
                                    <input type='file' name="professional_certificate_pic" placeholder="Browse computer" id="voterinput"
                                        class="form-control"> <span id='val3'></span>
                                    <span id='voterbtn'><i class="flaticon-upload"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="back-next-next">
                            <a href="{{route('expert.second.step')}}" class="back">Back</a>
                            <button type="submit" class="next">Next</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('include.footer')
@include('include.footer_bottom')