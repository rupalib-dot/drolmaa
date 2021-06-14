<div class="col-md-3 appoint-dash">
    <div class="appoint-box">
        <h3>Expert Panel</h3>
    </div>
    <div class="appoint-profile">
        <div class="appoint-status" style="background-image:url({{asset('front_end/images/blogimg.jpg')}});"></div>
        <h4>{{Session::get('full_name')}}</h4>
    </div>
    <ul class="data-name">
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

        <li class="data-sheet {{ Request::is('expert/change-password*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/lock.png')}}" alt=""></span><a
                href="{{route('expert.change-password')}}">Change Password</a>
        </li>
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