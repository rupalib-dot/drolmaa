 <style>
    .active{
            background-color: #5175ea87;
    } 
</style>
 <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">

                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item theme-logo {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{Route('admin.dashboard')}}">
                            <img src="{{asset('front_end/images/logo.svg')}}" class="navbar-logo" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">
                        <a href="{{Route('admin.dashboard')}}" class="nav-link">DROLMAA  </a>
                    </li>
                </ul> 

                <ul class="list-unstyled menu-categories" id="accordionExample"> 

                    <li class="menu {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                        <a href="{{Route('admin.dashboard')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Dashboard</span> 
                            </div>
                        </a>
                    </li>    
                    <li class="menu {{ Request::is('admin/change-password*') ? 'active' : '' }}">
                        <a href="{{Route('admin.change_password')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Change Password</span> 
                            </div>
                        </a>
                    </li>      
                    <li class="menu {{ Request::is('admin/admincustomer*') ? 'active' : '' }}">
                        <a href="{{Route('admincustomer.index')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Customer</span> 
                            </div>
                        </a>
                    </li>      
                    <li class="menu {{ Request::is('admin/adminexpert*') ? 'active' : '' }}">
                        <a href="{{Route('adminexpert.index')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Expert</span> 
                            </div>
                        </a>
                    </li>      

                    <li class="menu {{ Request::is('admin/workshop*') ? 'active' : '' }}">
                        <a href="{{Route('workshop.index')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Workshop</span> 
                            </div>
                        </a>
                    </li>   

                    <li class="menu {{ Request::is('admin/product*') ? 'active' : '' }}">
                        <a href="{{Route('product.index')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Product</span> 
                            </div>
                        </a>
                    </li>   

                    <li class="menu {{ Request::is('admin/adminappoinment*') ? 'active' : '' }}">
                        <a href="{{Route('adminappoinment.index')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Appoinment</span> 
                            </div>
                        </a>
                    </li>     

                    <li class="menu {{ Request::is('admin/contact-enquiery*') ? 'active' : '' }}">
                        <a href="{{Route('admin.contact_enquiery')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Contact Enquiery</span> 
                            </div>
                        </a>
                    </li>        

                    <li class="menu {{ Request::is('admin/settings*') ? 'active' : '' }}">
                        <a href="{{Route('settings.edit',1)}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>Settings</span> 
                            </div>
                        </a>
                    </li>    

                    <li class="menu">
                        <a onclick="openexLogout()" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                 <span>LogOut</span> 
                            </div>
                        </a> 
                    </li>  
                </ul>
                
            </nav>
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
                <p>Sure you want to log out?</p>
                <a onclick="closeexLogout()"><button class="cancel">Cancel</button></a>
                    <a href="{{route('admin.logout.account')}}"><button class="log">Logout</button></a>

            </span>
        </div>
    </div>
        </div>