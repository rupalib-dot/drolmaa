@include('include.header')
@include('include.nav')
<section id="appointment" class="appointment padding-top" role="appointments">
        <div class="container-fluid">
            <div class="row">
                <div class="header_workshop">
                    <div class="mt-3 mb-3 text-center">
                        <h3>Training Listing</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="margin-bottom:50px"> 
                <!-- <div class="pt-4 col-lg-12">  -->
                    <!-- <div class="tab-content" id="nav-tabContent"> -->
                        <!-- <div class="mt-4 tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"> -->
                            @if(count($trainings)>0)
                                @foreach($trainings as $training)
                                    <div class="pt-4 col-lg-6"> 
                                        <div class="card border-0 mb-3" style="max-width:100%;" data-city="workshop_1">
                                            <div class="row no-gutters">
                                                <div class="col-md-3">
                                                    <img style="height: 100px;" src="{{asset('training/'.$training->training_image)}}" class="card-img" alt="...">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card-body">
                                                        <h4 class="float-left card-title">{{$training->training_title}}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                       
                                @endforeach
                            @else
                                <div class="card border-0  mb-3" style="max-width:100%;">
                                    <div class="row no-gutters">
                                        <h3 style="margin: auto;"> No Record Found</h3>
                                    </div>
                                </div> 
                            @endif
                            <hr>
                        <!-- </div>            
                    </div>  -->
                    <nav class="mb-4 mt-4" aria-label="Page navigation example"> 
                    {{$trainings->appends($request->all())->render('vendor.pagination.custom')}} 
                    </nav>
                    
                    
                <!-- </div> -->
                
            </div>
        </div>     
        <script>
function myFunction(workshop) {
  var dots = document.querySelector(`.card[data-city="${workshop}"] #oldtext`);
  var more = document.querySelector(`.card[data-city="${workshop}"] #moretext`); 
  var moreText = document.querySelector(`.card[data-city="${workshop}"] #more`);
   var btnText = document.querySelector(`.card[data-city="${workshop}"] #myBtn`);
  

  if (dots.style.display === "block") {
    dots.style.display = "none";
    more.style.display = "block";
    btnText.innerHTML = "Read less";
    moreText.style.display = "none";
  } 
  if(more.style.display === "none") {
    dots.style.display = "block";
    more.style.display = "block";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";
  }
  else{
    dots.style.display = "block";
    more.style.display = "none";
    btnText.innerHTML = "Read more";
    moreText.style.display = "inline";  
  }
 
}
</script>
    </section>

@include('include.footer')
@include('include.script')
@include('include.modal')
 