<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
            
    <nav id="sidebar">
      
        <ul class="list-unstyled menu-categories">
            <li class="menu">
                <a href="{{route('admin.dashboard')}}" data-active="{{ Request::is('admin/dashboard') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li>
            <li class="menu">
                <a href="#users" data-toggle="collapse" data-active="{{ Request::is('admin/admincustomer') || Request::is('admin/adminexpert') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('admin/admincustomer') || Request::is('admin/adminexpert') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/admincustomer') || Request::is('admin/adminexpert') ? '' : 'collapsed' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Users</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('admin/admincustomer') || Request::is('admin/adminexpert') ? 'collapse show' : '' }}" id="users" data-parent="#accordionExample">
                    <li class="{{ Request::is('admin/admincustomer') ? 'active' : '' }}">
                        <a href="{{route('admincustomer.index')}}"> Customers </a>
                    </li>
                    <li class="{{ Request::is('admin/adminexpert') ? 'active' : '' }}">
                        <a href="{{route('adminexpert.index')}}"> Experts </a>
                    </li>                                
                </ul>
            </li>
              
            <li class="menu">
                <a href="#workshop" data-toggle="collapse" data-active="{{ Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? '' : 'collapsed' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Workshops</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? 'collapse show' : '' }}" id="workshop" data-parent="#accordionExample">
                    <li class="{{ Request::is('admin/workshop/create') || Request::is('admin/workshop/*/edit') ? 'active' : '' }}">
                        <a href="{{route('workshop.create')}}"> Create Workshop </a>
                    </li>
                    <li class="{{ Request::is('admin/workshop') ? 'active' : '' }}">
                        <a href="{{route('workshop.index')}}"> Workshops Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#product" data-toggle="collapse" data-active="{{ Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? 'true' : 'false' }}" aria-expanded="{{ Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? 'true' : 'false' }}" class="dropdown-toggle {{ Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? '' : 'collapsed' }}">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Products</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? 'collapse show' : '' }}" id="product" data-parent="#accordionExample">
                    <li class="{{ Request::is('admin/product/create') || Request::is('admin/product/*/edit') ? 'active' : '' }}">
                        <a href="{{route('product.create')}}"> Create Product </a>
                    </li>
                    <li class="{{ Request::is('admin/product') ? 'active' : '' }}">
                        <a href="{{route('product.index')}}"> Products Listing  </a>
                    </li>                           
                </ul>
            </li> 

            <li class="menu">
                <a href="{{route('adminappoinment.index')}}"  data-active="{{ Request::is('admin/adminappoinment') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span>Appoinment</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{route('admin.change_password')}}"  data-active="{{ Request::is('admin/change-password') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>Change Password</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a href="{{route('admin.contact_enquiery')}}"  data-active="{{ Request::is('admin/contact-enquiery') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>Contact Enquiery</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a href="{{route('settings.edit',1)}}"  data-active="{{ Request::is('admin/settings/*/edit') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>Settings</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a onclick="openexLogout()"  data-active="{{ Request::is('/') ? 'true' : 'false' }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Sign Out</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
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
<!--  END SIDEBAR  -->