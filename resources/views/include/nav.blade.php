<style>
.cart_value{
    position: absolute;
    top: -8px;
    right: -10px;
    font-size: 12px;
    border: 1px solid red;
    border-radius: 100%;
    padding: 3px 7px;
    background: red;
}
</style>
<div class="search" id="search-box">
        <div class="search-overlay" onclick="closeSearch()"></div>
        <span class="close-search" onclick="closeSearch()"><i class="fa fa-times" aria-hidden="true"></i></span>
        <form role="search" id="searchform" action="/search" method="get">
            <input type="search" value="" name="q" placeholder="Search..." />
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

    </div>
    <header id="main-header" class="main-header fluid-container" role="Header">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{url('/')}}"><img class="img-fluid" src="{{asset('front_end/images/logo.svg')}}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-end menu-drol">
                        <li class="nav-item  {{ Request::is('home') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('home') ? 'last' : '' }}" href="{{url('/')}}">Home</a>
                        </li>   
                        <li class="nav-item  {{ Request::is('about_us') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('about_us') ? 'last' : '' }}" href="{{route('page.about_us')}}">About Us</a>
                        </li>
                        <li class="nav-item  {{ Request::is('services') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('services') ? 'last' : '' }}" href="{{route('page.services')}}">Services</a>
                        </li>
                        <li class="nav-item  {{ Request::is('shop') ||Request::is('shop-detail*')? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('shop')||Request::is('shop-detail*') ? 'last' : '' }}" href="{{route('page.shop')}}">Products</a>
                        </li> 
                        <li class="nav-item  {{ Request::is('contact') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('contact') ? 'last' : '' }}" href="{{route('page.contact')}}">Contact Us</a>
                        </li> 
                        <li class="nav-item  {{ Request::is('live/workshops') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('live/workshops') ? 'last' : '' }}" href="{{route('live_webinar')}}"> Live Webinar</a>
                        </li>   
                        
                        <?php if(Session::has('user_id') && Session::has('role_id')){
                            if(Session::get('role_id') == 2){?>
                                <li class="nav-item  {{ Request::is('pricing') ? 'last2' : '' }}">
                                    <a class="nav-item nav-link {{ Request::is('pricing') ? 'last' : '' }}" href="{{route('page.pricing')}}">Price List</a>
                                </li>
                                <li class="nav-item  {{ Request::is('expert/dashboard') ? 'last2' : '' }}">
                                    <div class="dropdown">
                                            <a class="px-2 text-capitalize text-light dropdown-toggle nav-item {{ Request::is('expert/dashboard') ? 'last' : '' }}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i  class=" fas fa-user-circle"></i> {{Session::get('full_name')}}</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="nav-item dropdown-item {{ Request::is('expert/dashboard') ? 'last' : '' }}" href="{{url('expert/dashboard')}}"> <i class="fas fa-chart-bar"></i> Dashboard </a>
                                                <a class="dropdown-item" onclick="openLogout()"> <i class="fas fa-sign-out-alt"></i> LogOut</a>
                                        </div>
                                    </div>
                                </li> 
                            <?php }else if(Session::get('role_id') == 3){ ?>
                                <li class="nav-item  {{ Request::is('customer/dashboard') ? 'last2' : '' }}">
                                    <div class="dropdown">
                                            <a class="px-2 text-capitalize text-light dropdown-toggle nav-item {{ Request::is('dashboard') ? 'last' : '' }}" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i  class=" fas fa-user-circle"></i> {{Session::get('full_name')}}</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="nav-item dropdown-item {{ Request::is('dashboard') ? 'last' : '' }}" href="{{url('dashboard')}}"> <i class="fas fa-chart-bar"></i> Dashboard </a>
                                                <a class="dropdown-item" onclick="openLogout()"> <i class="fas fa-sign-out-alt"></i> LogOut</a>
                                        </div>
                                    </div>
                                </li> 
                            <?php }else{ ?>
                                <li class="nav-item  {{ Request::is('admin/dashboard') ? 'last2' : '' }}">
                                    <a class="nav-item nav-link {{ Request::is('admin/dashboard') ? 'last' : '' }}" href="{{route('admin.dashboard')}}">Dashboard</a>
                                </li> 
                        <?php }} ?> 
                        <?php if(Session::has('user_id') && Session::has('role_id')){ }else{?>
                            <li class="nav-item  {{ Request::is('user_login') ? 'last2' : '' }}">
                                <a class="nav-item nav-link {{ Request::is('user_login') ? 'last' : '' }}" href="{{ route('login') }}">Login/SignUp</a>
                            </li>   
                        <?php }?>
                            <li class="nav-item"> 
                                <?php $count = CommonFunction::getCount('cart','user_id',Session::get('user_id')); ?>
                                <a class="nav-item nav-link" href="{{ route('viewcart') }}"><i style="font-size: 20px;color: white;position relative" class="fas fa-shopping-cart"></i><?php if($count > 0){ ?><b class="cart_value">{{$count}}</b> <?php } ?></a> 
                            </li>
                            <?php if(Session::get('role_id') != 2){?>
                                <li class="nav-item last1">
                                    <a class="nav-item nav-link last" href="{{route('our_experts')}}">Book An Appointment</a>
                                </li>  
                        <?php }?>
                            
                    </ul>
                  
                </div>
                tsets
        </nav>
    </header>
    <div id="logout-popup" class="logout-popup" style="display:none">

<div class="logout-popup-content">
    <span onclick="closeLogout()">
        <p>Are you sure you want to log out?</p>
        <a onclick="closeLogout()"><button class="cancel">Cancel</button></a>
        <a href="{{route('logout.account')}}"><button class="log">Logout</button></a>

    </span>
</div>
</div>
<script>
    function openLogout() {
        document.getElementById('logout-popup').style.display = 'block';
    }

    function closeLogout() {
        document.getElementById('logout-popup').style.display = 'none';
    }
    </script>