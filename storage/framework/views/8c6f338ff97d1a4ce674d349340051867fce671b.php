<div class="col-md-2 appoint-dash">
    <div class="appoint-box">
        <h3>Customer Panel</h3>
    </div>
    <div class="appoint-profile">
        <div class="appoint-status" style="background-image:url(<?php echo e(asset('front_end/images/blogimg.jpg')); ?>);"></div>
        <h4><?php echo e(Session::get('full_name')); ?></h4>
    </div>
    <ul class="data-name">

    <li class="data-sheet <?php echo e(Request::is('dashboard*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/lock.png')); ?>" alt=""></span><a
                href="<?php echo e(route('customer.dashboard')); ?>">Dashboard</a>
        </li>

        <li class="sidebar-dropdown data-sheet <?php echo e(Request::is('profile/*/edit') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/profile.png')); ?>" alt=""></span>
            <a href="<?php echo e(url('profile')); ?>/<?php echo e(Session::get('user_id')); ?>/edit">My Profile
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
        </li>
        <li class="nav-item sidebar-dropdown data-sheet <?php echo e(Request::is('custransaction*') ? 'active' : ''); ?>" >
            <span class="icons"><img src="<?php echo e(asset('front_end/images/profile.png')); ?>" alt=""></span>
           <a href="<?php echo e(route('customer.transactions')); ?>"> Transactions</a>
            <a  href="#submenu1" data-toggle="collapse" data-target="#submenu1"> <i class="fas fa-chevron-down"></i> </a>
            
            <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
              <li class="nav-item" style="padding: 5px 0px;border: none;">
              <a class="nav-link" href="<?php echo e(route('custransaction.index',['type'=>'order'])); ?>" >Orders</a>
            </li>
              <li class="nav-item" style="padding: 0px 0px;border: none;">
              <a class="nav-link"  href="<?php echo e(route('custransaction.index',['type'=>'appointment'])); ?>">Appoinments</a>
            </li>
            <li class="nav-item" style="padding: 0px 0px;border: none;">
              <a class="nav-link" href="<?php echo e(route('custransaction.index',['type'=>'booking'])); ?>">Bookings</a>
            </li>
            </ul>
        
<!-- 
        <li class="sidebar-dropdown data-sheet <?php echo e(Request::is('custransaction*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/profile.png')); ?>" alt=""></span><a
                href="#">Transactions
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                    <a href="<?php echo e(route('custransaction.index',['type'=>'order'])); ?>">Orders</a>
                </li>
                <li>
                    <a href="<?php echo e(route('custransaction.index',['type'=>'appointment'])); ?>">Appoinments</a>
                </li>
                <li>
                    <a href="<?php echo e(route('custransaction.index',['type'=>'booking'])); ?>">Bookings</a>
                </li>
              </ul>
            </div> 
        </li>

        <li>
            <a href="<?php echo e(route('custransaction.index',['type'=>'order'])); ?>">Orders</a>
        </li>
        <li>
            <a href="<?php echo e(route('custransaction.index',['type'=>'appointment'])); ?>">Appoinments</a>
        </li>
        <li>
            <a href="<?php echo e(route('custransaction.index',['type'=>'booking'])); ?>">Bookings</a>
        </li> -->
                
        <li class="data-sheet <?php echo e(Request::is('appointment*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/calender.png')); ?>" alt=""></span><a
                href="<?php echo e(route('appointment.index')); ?>">My Appointments</a>
        </li>
        <li class="data-sheet <?php echo e(Request::is('orders*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/orderimg.png')); ?>" alt=""></span>
            <a href="<?php echo e(route('customer.order')); ?>">My Orders</a>
        </li>
        <li class="data-sheet <?php echo e(Request::is('bookings*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/booking.png')); ?>" alt=""></span>
            <a href="<?php echo e(route('bookings.index')); ?>">My Workshop</a>
        </li>
        <li class="data-sheet <?php echo e(Request::is('feedbacks*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/feedback.png')); ?>" alt=""></span><a
                href="<?php echo e(route('customer.feedback')); ?>">My Feedbacks</a>
        </li>
        <li class="data-sheet <?php echo e(Request::is('wishlist*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/feedback.png')); ?>" alt=""></span><a
                href="<?php echo e(route('customer.myWishlist')); ?>">My Wishlist</a>
        </li>
        <!-- <li class="data-sheet <?php echo e(Request::is('change-password*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/lock.png')); ?>" alt=""></span><a
                href="<?php echo e(route('customer.change-password')); ?>">Change Password</a>
        </li> -->
        <li>
            <span class="icons"><img src="<?php echo e(asset('front_end/images/logout.png')); ?>" alt=""></span>
            <a onclick="openLogout()">LogOut</a>
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
                <a href="<?php echo e(route('logout.account')); ?>"><button class="log">Logout</button></a>

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
</script><?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/include/client_sidebar.blade.php ENDPATH**/ ?>