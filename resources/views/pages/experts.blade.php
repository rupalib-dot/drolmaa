@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
   <div class="container-fluid">
    <div class="row">
        <div class="header_expert">
           <div class="mt-3 mb-3 text-center">
               <h3>Expert Listing</h3>
           </div>
           <div class="container mb-4">
                <div class="input-group">
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Enter City*" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Designation" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2  col-md-3">
                    <input type="text" class="form-control" placeholder="Speciality" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="my-2 col-md-3">
                    <button type="button" class="w-100 btn btn-outline-danger">Search</button>    
                     </div>  
                </div>
           </div>
        </div>
    </div>
   </div>
   <div class="container">
       <div class="row">
           <div class="pt-4 col-lg-4">
               <div class=" filter_exper_list border border-2 w-100">
                    <div class="text-muted px-3 pt-3">
                        <h3>Filter</h3>
                    </div>
                    <hr/>
                    <div class="p-3">
                        <h6>SPECIALIZATION</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <hr/>
                        <h6>LOCALITY</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >lorem ipsum</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >lorem ipsum</span>
                        </div>
                        <hr/>
                        <h6>AVAILABILITY</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Today</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Tomorrow</span>
                            <!-- <span class="ml-5">Add</span> -->
                        </div>
                        <hr/>
                        <h6>CLINIC FEES</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Psychiatrist</span>
                        </div>
                        <hr/>
                        <h6>GENDER</h6>
                        <div class="input-group filter_exper_value_one ">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Male</span>
                        </div>
                        <div class="input-group filter_exper_value_one mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text  bg-transparent border-0">
                                    <input type="checkbox" aria-label="Checkbox for following text input"/>
                                </div>
                            </div>
                            <span class="ml-2 align-middle" >Female</span>
                        </div>
                        <hr/>
                    </div>
                </div>
           </div>
                <div class="pt-4  col-lg-8">
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{asset('front_end/images/expert_profile.svg')}}" class="card-img" alt="...">
                            <div class="pl-0 col-lg-7 expert_button">
                                        <a href="/" target="_blank">View Profile</a>
                                        <a href="/" target="_blank">Book Appointment</a>
                                        </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. Urmil Bishnoi</h5>
                                    <p class="text-muted">Ph.D Psychology, M.Phil - Psychology</p>
                                    <p class="text-muted">7 Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                    </div>
                                        <p class="text-muted mb-0">Availability ( Today)</p>
                                        <div class="pl-3 row">
                                        <div class="pl-0 col-lg-5 expert_time_slot">
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                        </div>
                                        
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{asset('front_end/images/expert_profile.svg')}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. Urmil Bishnoi</h5>
                                    <p class="text-muted">Ph.D Psychology, M.Phil - Psychology</p>
                                    <p class="text-muted">7 Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                    </div>
                                        <p class="text-muted mb-0">Availability ( Today)</p>
                                        <div class="pl-3 row">
                                        <div class="pl-0 col-lg-5 expert_time_slot">
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                        </div>
                                        <div class="pl-0 col-lg-7 expert_button">
                                        <a href="/" target="_blank">View Profile</a>
                                        <a href="/" target="_blank">Book Appointment</a>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{asset('front_end/images/expert_profile.svg')}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. Urmil Bishnoi</h5>
                                    <p class="text-muted">Ph.D Psychology, M.Phil - Psychology</p>
                                    <p class="text-muted">7 Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                    </div>
                                        <p class="text-muted mb-0">Availability ( Today)</p>
                                        <div class="pl-3 row">
                                        <div class="pl-0 col-lg-5 expert_time_slot">
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                        </div>
                                        <div class="pl-0 col-lg-7 expert_button">
                                        <a href="/" target="_blank">View Profile</a>
                                        <a href="/" target="_blank">Book Appointment</a>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="card border-0  mb-3" style="max-width:100%;">
                        <div class="row no-gutters">
                            <div class="col-md-3">
                            <img src="{{asset('front_end/images/expert_profile.svg')}}" class="card-img" alt="...">
                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title">Dr. Urmil Bishnoi</h5>
                                    <p class="text-muted">Ph.D Psychology, M.Phil - Psychology</p>
                                    <p class="text-muted">7 Years Experience Overall</p>
                                    <div class="my-1 d-flex">
                                        <img src="{{asset('front_end/images/link_thumb.svg')}}" alt="">
                                        <span class="align-self-center"><span class="ml-2 text-success font-weight-bold">93%</span> (407 ratings)</span>
                                    </div>
                                        <p class="text-muted mb-0">Availability ( Today)</p>
                                        <div class="pl-3 row">
                                        <div class="pl-0 col-lg-5 expert_time_slot">
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                            <p> 05:30 PM</p>
                                        </div>
                                        <div class="pl-0 col-lg-7 expert_button">
                                        <a href="/" target="_blank">View Profile</a>
                                        <a href="/" target="_blank">Book Appointment</a>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <nav class="mb-4 mt-4" aria-label="Page navigation example">
  <ul class="pagination justify-content-start">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="active   page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
                </div>
                
       </div>
   </div>
</section>
@include('include.footer')
@include('include.script')
@include('include.modal')
 