<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $(".data-name").toggle(200);
  });
});
</script>
<style>
.main {
  left:-500px;
}
</style>
<div class="col-lg-2 appoint-dash">
    <div class="justify-content-between appoint-box">
        <h3>Expert Panel</h3>
        <button type="submit" style="background-color:var(--yellow)" class="btn"><i class="fas fa-bars"></i></button>
>>>>>>> 13ee27a07205336cb77c3d4c18b50f1044cf6e82
    </div>
    <div class="appoint-profile">
        <div class="appoint-status" style="background-image:url({{asset('front_end/images/blogimg.jpg')}});"></div>
        <h4>{{Session::get('full_name')}}</h4>
    </div>
   
    <ul class="data-name">
    <li class="data-sheet {{ Request::is('expert/dashboard*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/lock.png')}}" alt=""></span><a
                href="{{route('expert.dashboard')}}">Dashboard</a>
        </li>
        <li class="sidebar-dropdown data-sheet {{ Request::is('expert/profile/*/edit') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/profile.png')}}" alt=""></span><a
                href="{{url('expert/profile')}}/{{Session::get('user_id')}}/edit">My Profile
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Personal Details</a>
                </li>
                <li>
                  <a href="#">Professional Details</a>
                </li>
                <li>
                  <a href="#">Document</a>
                </li>
              </ul>
            </div> 
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" >Reports </a>
            <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
              <li class="nav-item"><a class="nav-link" href="">Sub item</a></li>
              <li class="nav-item"><a class="nav-link" href="">Sub item</a></li>
            </ul>
          </li> -->
        <li class="nav-item sidebar-dropdown data-sheet {{ Request::is('expert/exptransaction*') ? 'active' : '' }}" >
            <span class="icons"><img src="{{asset('front_end/images/profile.png')}}" alt=""></span>
            <a href="{{route('expert.transactions')}}">Transactions</a>
            <a  href="#submenu1" data-toggle="collapse" data-target="#submenu1"> <i class="ml-2 fas fa-chevron-down"></i> </a>
            <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
              <li class="nav-item" style="padding: 5px 0px;border: none;"><a class="nav-link" href="{{route('exptransaction.index',['type'=>'registration'])}}" >Subscriptions</a></li>
              <li class="nav-item" style="padding: 0px 0px;border: none;"><a class="nav-link" href="{{route('exptransaction.index',['type'=>'appointment'])}}">Appoinments</a></li>
              <!-- <li class="nav-item" style="padding: 0px 0px;border: none;"><a class="nav-link" href="{{route('exptransaction.index',['type'=>'order'])}}">Order</a></li> -->
              <!-- <li class="nav-item" style="padding: 0px 0px;border: none;"><a class="nav-link" href="{{route('exptransaction.index',['type'=>'booking'])}}">Workshop</a></li> -->
            
            </ul> 
        </li>

        <!-- <li>
            <a href="{{route('exptransaction.index',['type'=>'registration'])}}"> Subscriptions  </a>
        </li>   
        <li>
            <a href="{{route('exptransaction.index',['type'=>'appointment'])}}">Appoinments</a>
        </li>  -->

        <li class="data-sheet {{ Request::is('orders*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/orderimg.png')}}" alt=""></span>
            <a href="{{route('customer.order')}}">My Orders</a>
        </li>
        <li class="nav-item sidebar-dropdown data-sheet {{ Request::is('expert/expworkshop*') ? 'active' : '' }}" >
            <span class="icons"><img src="{{asset('front_end/images/profile.png')}}" alt=""></span>
            <a href="{{route('workshopHome')}}">Workshop</a>
            <a  href="#submenu2" data-toggle="collapse" data-target="#submenu2"> <i class="ml-2 fas fa-chevron-down"></i> </a>
            <ul class="list-unstyled flex-column pl-3 collapse" id="submenu2" aria-expanded="false">
              <li class="nav-item" style="padding: 5px 0px;border: none;"><a class="nav-link" href="{{route('expworkshop.create')}}" >Create Workshop</a></li>
              <li class="nav-item" style="padding: 0px 0px;border: none;"><a class="nav-link" href="{{route('expworkshop.index')}}">Workshop List</a></li>
            </ul> 
        </li>
 
        <li class="data-sheet {{ Request::is('wishlist*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/feedback.png')}}" alt=""></span><a
                href="{{route('customer.myWishlist')}}">My Wishlist</a>
        </li>
         <li class="data-sheet {{ Request::is('expert/expappointment*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/calender.png')}}" alt=""></span><a href="{{route('expappointment.index')}}">My Appointments</a></span>
        </li>
        <li class="data-sheet {{ Request::is('expert/feedbacks*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/feedback.png')}}" alt=""></span><a href="{{route('expert.feedback')}}">My Feedbacks</a>
        </li> 
        <li class="data-sheet {{ Request::is('expert/availabilty*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/calender.png')}}" alt=""></span><a href="{{route('availabilty.index')}}">Availability
            </a>
        </li>

        <!-- <li class="data-sheet {{ Request::is('expert/change-password*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/lock.png')}}" alt=""></span><a
                href="{{route('expert.change-password')}}">Change Password</a>
        </li> -->
        <li>
        <span class="icons"><img src="{{asset('front_end/images/logout.png')}}" alt=""></span><a onclick="openexLogout()">LogOut</a>
        </li>
    </ul>

    <script>
    function openexLogout() {
        document.getElementById('exlogout-popup').style.display = 'block';
    }

    function closeexLogout() {
        document.getElementById('exlogout-popup').style.display = 'none';
    }
    </script>
  

    <div id="exlogout-popup" class="exlogout-popup" style="display:none">
        <div class="exlogout-popup-content">
            <span onclick="closeexLogout()">
                <p>Are you sure you want to log out?</p>
                <a onclick="closeexLogout()"><button class="cancel">Cancel</button></a>
                    <a href="{{route('logout.account')}}"><button class="log">Logout</button></a>

            </span>
        </div>
    </div>
</div>
