<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      $("button").click(function(){
        $(".data-name").toggleClass("left_toggle");
        // $(".col-md-9").toggleClass("top_right");
      });
    });
    </script>
    <style>
        .left_toggle{
            display:none;
        }
        .top_right{
            top: -650px;
        }
    </style>
<div class="col-md-2 appoint-dash">
    <div class="justify-content-between appoint-box">
        <h5 class="mt-2">Expert Panel</h5>
        <button class="bg-dark navbar-toggler" type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
    </div>
    <div class="appoint-profile">
        <div class="appoint-status" style="background-image:url(<?php echo e(asset('front_end/images/blogimg.jpg')); ?>);"></div>
        <h4><?php echo e(Session::get('full_name')); ?></h4>
    </div>
   
    <ul class="data-name">
    <li class="data-sheet <?php echo e(Request::is('expert/dashboard*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/lock.png')); ?>" alt=""></span><a
                href="<?php echo e(route('expert.dashboard')); ?>">Dashboard</a>
        </li>
        <li class="sidebar-dropdown data-sheet <?php echo e(Request::is('expert/profile/*/edit') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/profile.png')); ?>" alt=""></span><a
                href="<?php echo e(url('expert/profile')); ?>/<?php echo e(Session::get('user_id')); ?>/edit">My Profile
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
        <li class="nav-item sidebar-dropdown data-sheet <?php echo e(Request::is('expert/exptransaction*') ? 'active' : ''); ?>" >
            <span class="icons"><img src="<?php echo e(asset('front_end/images/profile.png')); ?>" alt=""></span>
            <a href="<?php echo e(route('expert.transactions')); ?>">Transactions</a>
            <a  href="#submenu1" data-toggle="collapse" data-target="#submenu1"> <i class="ml-2 fas fa-chevron-down"></i> </a>
            <ul class="list-unstyled flex-column pl-3 collapse" id="submenu1" aria-expanded="false">
              <li class="nav-item" style="padding: 5px 0px;border: none;"><a class="nav-link" href="<?php echo e(route('exptransaction.index',['type'=>'registration'])); ?>" >Subscriptions</a></li>
              <li class="nav-item" style="padding: 0px 0px;border: none;"><a class="nav-link" href="<?php echo e(route('exptransaction.index',['type'=>'appointment'])); ?>">Appoinments</a></li>
            </ul> 
        </li>

        <!-- <li>
            <a href="<?php echo e(route('exptransaction.index',['type'=>'registration'])); ?>"> Subscriptions  </a>
        </li>   
        <li>
            <a href="<?php echo e(route('exptransaction.index',['type'=>'appointment'])); ?>">Appoinments</a>
        </li>  -->

        <li class="data-sheet <?php echo e(Request::is('orders*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/orderimg.png')); ?>" alt=""></span>
            <a href="<?php echo e(route('customer.order')); ?>">My Orders</a>
        </li>
        <li class="nav-item sidebar-dropdown data-sheet <?php echo e(Request::is('expert/expworkshop*') ? 'active' : ''); ?>" >
            <span class="icons"><img src="<?php echo e(asset('front_end/images/profile.png')); ?>" alt=""></span>
            <a href="<?php echo e(route('workshopHome')); ?>">Workshop</a>
            <a  href="#submenu2" data-toggle="collapse" data-target="#submenu2"> <i class="ml-2 fas fa-chevron-down"></i> </a>
            <ul class="list-unstyled flex-column pl-3 collapse" id="submenu2" aria-expanded="false">
              <li class="nav-item" style="padding: 5px 0px;border: none;"><a class="nav-link" href="<?php echo e(route('expworkshop.create')); ?>" >Create Workshop</a></li>
              <li class="nav-item" style="padding: 0px 0px;border: none;"><a class="nav-link" href="<?php echo e(route('expworkshop.index')); ?>">Workshop List</a></li>
            </ul> 
        </li>
 
        <li class="data-sheet <?php echo e(Request::is('wishlist*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/feedback.png')); ?>" alt=""></span><a
                href="<?php echo e(route('customer.myWishlist')); ?>">My Wishlist</a>
        </li>
         <li class="data-sheet <?php echo e(Request::is('expert/expappointment*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/calender.png')); ?>" alt=""></span><a href="<?php echo e(route('expappointment.index')); ?>">My Appointments</a></span>
        </li>
        <li class="data-sheet <?php echo e(Request::is('expert/feedbacks*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/feedback.png')); ?>" alt=""></span><a href="<?php echo e(route('expert.feedback')); ?>">My Feedbacks</a>
        </li> 
        <li class="data-sheet <?php echo e(Request::is('expert/availabilty*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/calender.png')); ?>" alt=""></span><a href="<?php echo e(route('availabilty.index')); ?>">Availability
            </a>
        </li>

        <!-- <li class="data-sheet <?php echo e(Request::is('expert/change-password*') ? 'active' : ''); ?>">
            <span class="icons"><img src="<?php echo e(asset('front_end/images/lock.png')); ?>" alt=""></span><a
                href="<?php echo e(route('expert.change-password')); ?>">Change Password</a>
        </li> -->
        <li>
        <span class="icons"><img src="<?php echo e(asset('front_end/images/logout.png')); ?>" alt=""></span><a onclick="openexLogout()">LogOut</a>
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
                    <a href="<?php echo e(route('logout.account')); ?>"><button class="log">Logout</button></a>

            </span>
        </div>
    </div>
</div>
<?php /**PATH J:\xampp\htdocs\drolmaa\resources\views/include/expert_sidebar.blade.php ENDPATH**/ ?>