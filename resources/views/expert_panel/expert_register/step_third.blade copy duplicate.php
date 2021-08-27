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
                                <div class="file-upload">
                                    <div class="file-upload-select">
                                        <div class="file-select-button">Professional License (if any </div>
                                        <div class="file-select-name"><i class="flaticon-upload"></i></div>
                                        <input type="file" name="file-upload-input" id="file-upload-input"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="file-upload">
                                    <div class="file-upload-select1">
                                        <div class="file-select-button">Pan card</div>
                                        <div class="file-select-name1"><i class="flaticon-upload"></i></div>
                                        <input type="file" name="file-upload-input" id="file-upload-input1"
                                            class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="file-upload">
                                    <div class="file-upload-select2">
                                        <div class="file-select-button">Adhar card</div>
                                        <div class="file-select-name2"><i class="flaticon-upload"></i></div>
                                        <input type="file" name="file-upload-input" id="file-upload-input2"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="file-upload">
                                    <div class="file-upload-select3">
                                        <div class="file-select-button">Professional Certificate</div>
                                        <div class="file-select-name3"><i class="flaticon-upload"></i></div>
                                        <input type="file" name="file-upload-input" id="file-upload-input3"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4 back-next-next">
                                <a href="{{route('expert.second.step')}}" class="back">Back</a>
                                <button type="submit" class="next">Next</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
</section>
<script>
let fileInput = document.getElementById("file-upload-input");
let fileSelect = document.getElementsByClassName("file-upload-select")[0];
fileSelect.onclick = function() {
    fileInput.click();
}
fileInput.onchange = function() {
    let filename = fileInput.files[0].name;
    let selectName = document.getElementsByClassName("file-select-name")[0];
    selectName.innerText = filename;
}
</script>

<script>
let fileInput1 = document.getElementById("file-upload-input1");
let fileSelect1 = document.getElementsByClassName("file-upload-select1")[0];
fileSelect1.onclick = function() {
    fileInput1.click();
}
fileInput1.onchange = function() {
    let filename1 = fileInput1.files[0].name;
    let selectName1 = document.getElementsByClassName("file-select-name1")[0];
    selectName1.innerText = filename1;
}
</script>
<script>
let fileInput2 = document.getElementById("file-upload-input2");
let fileSelect2 = document.getElementsByClassName("file-upload-select2")[0];
fileSelect2.onclick = function() {
    fileInput2.click();
}
fileInput2.onchange = function() {
    let filename2 = fileInput2.files[0].name;
    let selectName2 = document.getElementsByClassName("file-select-name2")[0];
    selectName2.innerText = filename2;
}
</script>
<script>
let fileInput3 = document.getElementById("file-upload-input3");
let fileSelect3 = document.getElementsByClassName("file-upload-select3")[0];
fileSelect3.onclick = function() {
    fileInput3.click();
}
fileInput2.onchange = function() {
    let filename3 = fileInput3.files[0].name;
    let selectName3 = document.getElementsByClassName("file-select-name3")[0];
    selectName3.innerText = filename3;
}
</script>
@include('include.footer')
@include('include.footer_bottom')