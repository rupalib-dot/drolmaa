<div class="col-md-3 appoint-dash">
    <div class="appoint-box">
        <h3>Customer Panel</h3>
    </div>
    <div class="appoint-profile">
        <div class="appoint-status" style="background-image:url({{asset('front_end/images/blogimg.jpg')}});"></div>
        <h4>{{Session::get('full_name')}}</h4>
    </div>
    <ul class="data-name">
        <li class="sidebar-dropdown data-sheet {{ Request::is('profile/*/edit') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/profile.png')}}" alt=""></span><a
                href="{{url('profile')}}/{{Session::get('user_id')}}/edit">My Profile
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
        <li class="data-sheet {{ Request::is('appointment*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/calender.png')}}" alt=""></span><a
                href="{{route('appointment.index')}}">My Appointments</a>
        </li>
        <li class="data-sheet {{ Request::is('orders*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/orderimg.png')}}" alt=""></span><a
                href="{{route('customer.order')}}">My Orders</a>
        </li>
        <li class="data-sheet {{ Request::is('bookings*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/booking.png')}}" alt=""></span><a
                href="{{route('bookings.index')}}">My Bookings</a>
        </li>
        <li class="data-sheet {{ Request::is('feedbacks*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/feedback.png')}}" alt=""></span><a
                href="{{route('customer.feedback')}}">My Feedbacks</a>
        </li>
        <li class="data-sheet {{ Request::is('wishlist*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/feedback.png')}}" alt=""></span><a
                href="{{route('customer.myWishlist')}}">My whishlist</a>
        </li>
        <li class="data-sheet {{ Request::is('change-password*') ? 'active' : '' }}">
            <span class="icons"><img src="{{asset('front_end/images/lock.png')}}" alt=""></span><a
                href="{{route('customer.change-password')}}">Change Password</a>
        </li>
        <li>
            <span class="icons"><img src="{{asset('front_end/images/logout.png')}}" alt=""></span><a
                onclick="openLogout()">LogOut</a>
        </li>
    </ul>

    <script>
    function openLogout() {
        document.getElementById('logout-popup').style.display = 'block';
    }

    function closeLogout() {
        document.getElementById('logout-popup').style.display = 'none';
    }
    </script>

    <div id="logout-popup" class="logout-popup" style="display:none">

        <div class="logout-popup-content">
            <span onclick="closeLogout()">
                <p>Are you sure you want to log out?</p>
                <a onclick="closeLogout()"><button class="cancel">Cancel</button></a>
                <a href="{{route('logout.account')}}"><button class="log">Logout</button></a>

            </span>
        </div>
    </div>
</div>
<script>
$(".sidebar-dropdown data-sheet > a").click(function() {
    $(".sidebar-submenu").slideUp(200);
    if (
        $(this)
        .parent()
        .hasClass("active")
    ) {
        $(".sidebar-dropdown data-sheet").removeClass("active");
        $(this)
            .parent()
            .removeClass("active");
    } else {
        $(".sidebar-dropdown data-sheet").removeClass("active");
        $(this)
            .next(".sidebar-submenu")
            .slideDown(200);
        $(this)
            .parent()
            .addClass("active");
    }
});
</script>