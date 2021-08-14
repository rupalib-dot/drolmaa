<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
            
    <nav id="sidebar">
      
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="<?php echo e(route('admin.dashboard')); ?>" data-active="<?php echo e(Request::is('admin/dashboard') ? 'true' : 'false'); ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a href="#banners" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/banners/create') || Request::is('admin/banners') || Request::is('admin/banners/*/edit')|| Request::is('admin/banners*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/banners/create') || Request::is('admin/banners') || Request::is('admin/banners/*/edit')|| Request::is('admin/banners*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/banners/create') || Request::is('admin/banners') || Request::is('admin/banners/*/edit')|| Request::is('admin/banners*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Banners</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/banners/create') || Request::is('admin/banners') || Request::is('admin/banners/*/edit')|| Request::is('admin/banners*') ? 'collapse show' : ''); ?>" id="banners" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/banners/create') || Request::is('admin/banners/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('banners.create')); ?>"> Create Banner </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/banners') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('banners.index')); ?>"> Banners Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#faq" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/faq/create') || Request::is('admin/faq') || Request::is('admin/faq/*/edit')|| Request::is('admin/faq*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/faq/create') || Request::is('admin/faq') || Request::is('admin/faq/*/edit')|| Request::is('admin/faq*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/faq/create') || Request::is('admin/faq') || Request::is('admin/faq/*/edit')|| Request::is('admin/faq*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>FAQ</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/faq/create') || Request::is('admin/faq') || Request::is('admin/faq/*/edit')|| Request::is('admin/faq*') ? 'collapse show' : ''); ?>" id="faq" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/faq/create') || Request::is('admin/faq/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('faq.create')); ?>"> Create FAQ </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/faq') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('faq.index')); ?>"> FAQ Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#testimonial" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/testimonial/create') || Request::is('admin/testimonial') || Request::is('admin/testimonial/*/edit')|| Request::is('admin/testimonial*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/testimonial/create') || Request::is('admin/testimonial') || Request::is('admin/testimonial/*/edit')|| Request::is('admin/testimonial*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/testimonial/create') || Request::is('admin/testimonial') || Request::is('admin/testimonial/*/edit')|| Request::is('admin/testimonial*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Testimonial</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/testimonial/create') || Request::is('admin/testimonial') || Request::is('admin/testimonial/*/edit')|| Request::is('admin/testimonial*') ? 'collapse show' : ''); ?>" id="testimonial" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/testimonial/create') || Request::is('admin/testimonial/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('testimonial.create')); ?>"> Create testimonial </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/testimonial') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('testimonial.index')); ?>"> testimonial Listing  </a>
                    </li>                           
                </ul>
            </li>
            
            <li class="menu">
                <a href="#cancel_reason" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/cancel_reason/create') || Request::is('admin/cancel_reason') || Request::is('admin/cancel_reason/*/edit')|| Request::is('admin/cancel_reason*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/cancel_reason/create') || Request::is('admin/cancel_reason') || Request::is('admin/cancel_reason/*/edit')|| Request::is('admin/cancel_reason*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/cancel_reason/create') || Request::is('admin/cancel_reason') || Request::is('admin/cancel_reason/*/edit')|| Request::is('admin/cancel_reason*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Cancel Reason</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/cancel_reason/create') || Request::is('admin/cancel_reason') || Request::is('admin/cancel_reason/*/edit')|| Request::is('admin/cancel_reason*') ? 'collapse show' : ''); ?>" id="cancel_reason" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/cancel_reason/create') || Request::is('admin/cancel_reason/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('cancel_reason.create')); ?>"> Create cancel_reason </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/cancel_reason') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('cancel_reason.index')); ?>"> cancel_reason Listing  </a>
                    </li>                           
                </ul>
            </li>
            
            <li class="menu">
                <a href="#blogs" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/blogs/create') || Request::is('admin/blogs') || Request::is('admin/blogs/*/edit')|| Request::is('admin/blogs*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/blogs/create') || Request::is('admin/blogs') || Request::is('admin/blogs/*/edit')|| Request::is('admin/blogs*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/blogs/create') || Request::is('admin/blogs') || Request::is('admin/blogs/*/edit')|| Request::is('admin/blogs*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>blogs</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/blogs/create') || Request::is('admin/blogs') || Request::is('admin/blogs/*/edit')|| Request::is('admin/blogs*') ? 'collapse show' : ''); ?>" id="blogs" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/blogs/create') || Request::is('admin/blogs/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('blogs.create')); ?>"> Create blogs </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/blogs') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('blogs.index')); ?>"> blogs Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#services" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/services/create') || Request::is('admin/services') || Request::is('admin/services/*/edit')|| Request::is('admin/services*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/services/create') || Request::is('admin/services') || Request::is('admin/services/*/edit')|| Request::is('admin/services*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/services/create') || Request::is('admin/services') || Request::is('admin/services/*/edit')|| Request::is('admin/services*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>services</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/services/create') || Request::is('admin/services') || Request::is('admin/services/*/edit')|| Request::is('admin/services*') ? 'collapse show' : ''); ?>" id="services" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/services/create') || Request::is('admin/services/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('services.create')); ?>"> Create services </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/services') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('services.index')); ?>"> services Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#training" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/training/create') || Request::is('admin/training') || Request::is('admin/training/*/edit')|| Request::is('admin/training*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/training/create') || Request::is('admin/training') || Request::is('admin/training/*/edit')|| Request::is('admin/training*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/training/create') || Request::is('admin/training') || Request::is('admin/training/*/edit')|| Request::is('admin/training*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>training</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/training/create') || Request::is('admin/training') || Request::is('admin/training/*/edit')|| Request::is('admin/training*') ? 'collapse show' : ''); ?>" id="training" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/training/create') || Request::is('admin/training/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('training.create')); ?>"> Create training </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/training') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('training.index')); ?>"> training Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#health_tips" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/health_tips/create') || Request::is('admin/health_tips') || Request::is('admin/health_tips/*/edit')|| Request::is('admin/health_tips*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/health_tips/create') || Request::is('admin/health_tips') || Request::is('admin/health_tips/*/edit')|| Request::is('admin/health_tips*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/health_tips/create') || Request::is('admin/health_tips') || Request::is('admin/health_tips/*/edit')|| Request::is('admin/health_tips*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>health_tips</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/health_tips/create') || Request::is('admin/health_tips') || Request::is('admin/health_tips/*/edit')|| Request::is('admin/health_tips*') ? 'collapse show' : ''); ?>" id="health_tips" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/health_tips/create') || Request::is('admin/health_tips/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('health_tips.create')); ?>"> Create health_tips </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/health_tips') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('health_tips.index')); ?>"> health_tips Listing  </a>
                    </li>                           
                </ul>
            </li>
           
            <li class="menu">
                <a href="#offers_coupons" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/offers_coupons/create') || Request::is('admin/offers_coupons') || Request::is('admin/offers_coupons/*/edit')|| Request::is('admin/offers_coupons*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/offers_coupons/create') || Request::is('admin/offers_coupons') || Request::is('admin/offers_coupons/*/edit')|| Request::is('admin/offers_coupons*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/offers_coupons/create') || Request::is('admin/offers_coupons') || Request::is('admin/offers_coupons/*/edit')|| Request::is('admin/offers_coupons*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Offers Coupons</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/offers_coupons/create') || Request::is('admin/offers_coupons') || Request::is('admin/offers_coupons/*/edit')|| Request::is('admin/offers_coupons*') ? 'collapse show' : ''); ?>" id="offers_coupons" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/offers_coupons/create') || Request::is('admin/offers_coupons/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('offers_coupons.create')); ?>"> Create offers Coupons </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/offers_coupons') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('offers_coupons.index')); ?>"> offers Coupons Listing  </a>
                    </li>                           
                </ul>
            </li>
           

            <li class="menu">            
                <a href="#users" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/admincustomer*') || Request::is('admin/adminexpert')|| Request::is('admin/adminexpert*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/admincustomer') || Request::is('admin/adminexpert') || Request::is('admin/adminexpert*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/admincustomer') || Request::is('admin/adminexpert')|| Request::is('admin/adminexpert*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        <span>Users</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/admincustomer') || Request::is('admin/adminexpert')|| Request::is('admin/adminexpert*') ? 'collapse show' : ''); ?>" id="users" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/admincustomer') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admincustomer.index')); ?>"> Customers </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/adminexpert')|| Request::is('admin/adminexpert*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('adminexpert.index')); ?>"> Experts </a>
                    </li>                                
                </ul>
            </li>
            <li class="menu">
                <a href="#transactions" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/transactions*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/transactions*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/transactions*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Transactions</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/transactions*') ? 'collapse show' : ''); ?>" id="transactions" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/transactions*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('transaction.index',['type'=>'order'])); ?>"> Orders  </a>
                    </li> 
                    <li class="<?php echo e(Request::is('admin/transactions*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('transaction.index',['type'=>'registration'])); ?>"> Subscription  </a>
                    </li>    
                    <li class="<?php echo e(Request::is('admin/transactions*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('transaction.index',['type'=>'booking'])); ?>"> Bookings  </a>
                    </li>    
                    <li class="<?php echo e(Request::is('admin/transactions*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('transaction.index',['type'=>'appointment'])); ?>"> Appointments </a>
                    </li>                           
                </ul>
            </li>
            <li class="menu">
                <a href="#order" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/adminOrder') || Request::is('admin/adminOrder*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/adminOrder') || Request::is('admin/adminOrder*')  ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/adminOrder') || Request::is('admin/adminOrder*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Orders</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/adminOrder') || Request::is('admin/adminOrder*') ? 'collapse show' : ''); ?>" id="order" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/adminOrder')|| Request::is('admin/adminOrder*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('adminOrder.index')); ?>"> Orders Listing  </a>
                    </li>                           
                </ul>
            </li>
            <li class="menu">
                <a href="#workshop" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Workshops</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/workshop/create') || Request::is('admin/workshop') || Request::is('admin/workshop/*/edit')|| Request::is('admin/workshop*') ? 'collapse show' : ''); ?>" id="workshop" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/workshop/create') || Request::is('admin/workshop/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('workshop.create')); ?>"> Create Workshop </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/workshop') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('workshop.index')); ?>"> Workshops Listing  </a>
                    </li>                           
                </ul>
            </li>

            <li class="menu">
                <a href="#category" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/category/create') || Request::is('admin/category') || Request::is('admin/category/*/edit')|| Request::is('admin/category*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/category/create') || Request::is('admin/category') || Request::is('admin/category/*/edit')|| Request::is('admin/category*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/category/create') || Request::is('admin/category') || Request::is('admin/category/*/edit')|| Request::is('admin/category*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <span>Category</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/category/create') || Request::is('admin/category') || Request::is('admin/category/*/edit')|| Request::is('admin/category*') ? 'collapse show' : ''); ?>" id="category" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/category/create') || Request::is('admin/category/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('category.create')); ?>"> Create category </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/category') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('category.index')); ?>"> Categorys Listing  </a>
                    </li>                           
                </ul>
            </li> 

            <li class="menu">
                <a href="#product" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        <span>Products</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/product/create') || Request::is('admin/product') || Request::is('admin/product/*/edit')|| Request::is('admin/product*') ? 'collapse show' : ''); ?>" id="product" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/product/create') || Request::is('admin/product/*/edit') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('product.create')); ?>"> Create Product </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/product') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('product.index')); ?>"> Products Listing  </a>
                    </li>                           
                </ul>
            </li> 

            <li class="menu">
                <a href="#appoinment" data-toggle="collapse" data-active="<?php echo e(Request::is('admin/adminappoinment') || Request::is('admin/adminappoinment*') ? 'true' : 'false'); ?>" aria-expanded="<?php echo e(Request::is('admin/adminappoinment') || Request::is('admin/adminappoinment*')  ? 'true' : 'false'); ?>" class="dropdown-toggle <?php echo e(Request::is('admin/adminappoinment') || Request::is('admin/adminappoinment*') ? '' : 'collapsed'); ?>">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                        <span>Appoinments</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled <?php echo e(Request::is('admin/adminappoinment') || Request::is('admin/adminappoinment*') ? 'collapse show' : ''); ?>" id="appoinment" data-parent="#accordionExample">
                    <li class="<?php echo e(Request::is('admin/adminappoinment')|| Request::is('admin/adminappoinment*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('adminappoinment.index')); ?>"> Appoinments Listing  </a>
                    </li>                           
                </ul>
            </li>
 

            <li class="menu">
                <a href="<?php echo e(route('admin.change_password')); ?>"  data-active="<?php echo e(Request::is('admin/change-password') ? 'true' : 'false'); ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg> 

                        <span>Change Password</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a href="<?php echo e(route('admin.contact_enquiery')); ?>"  data-active="<?php echo e(Request::is('admin/contact-enquiery') ? 'true' : 'false'); ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg> 
                        <span>Contact Inquiry</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a href="<?php echo e(route('settings.edit',1)); ?>"  data-active="<?php echo e(Request::is('admin/settings/*/edit') ? 'true' : 'false'); ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>Settings</span>
                    </div>
                </a>
            </li> 

            <li class="menu">
                <a onclick="return confirm('Are you sure you want to logout?')" href="<?php echo e(route('admin.logout.account')); ?>"  data-active="<?php echo e(Request::is('/') ? 'true' : 'false'); ?>" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Sign Out</span>
                    </div>
                </a>
            </li>
        </ul>
    </nav>  
<!--  END SIDEBAR  -->
</div>
<?php /**PATH C:\xampp\htdocs\drolmaa\resources\views/admin/inc/sidebar.blade.php ENDPATH**/ ?>