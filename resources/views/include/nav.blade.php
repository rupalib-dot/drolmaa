<div class="search" id="search-box">
        <div class="search-overlay" onclick="closeSearch()"></div>
        <span class="close-search" onclick="closeSearch()"><i class="fa fa-times" aria-hidden="true"></i></span>
        <form role="search" id="searchform" action="/search" method="get">
            <input type="search" value="" name="q" placeholder="Search..." />
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>

    </div>
    <header id="main-header" class="main-header fluid-container" role="Header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{url('/')}}"><img class="img-fluid" src="{{asset('front_end/images/logo.svg')}}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item  {{ Request::is('about_us') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('about_us') ? 'last' : '' }}" href="{{route('page.about_us')}}">About Us</a>
                        </li>
                        <li class="nav-item  {{ Request::is('services') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('services') ? 'last' : '' }}" href="{{route('page.services')}}">Services</a>
                        </li>
                        <li class="nav-item  {{ Request::is('shop') ||Request::is('shop-detail*')? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('shop')||Request::is('shop-detail*') ? 'last' : '' }}" href="{{route('page.shop')}}">Shops</a>
                        </li>
                        <li class="nav-item  {{ Request::is('tools') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('tools') ? 'last' : '' }}" href="{{route('page.tools')}}">Tools</a>
                        </li>
                        <li class="nav-item  {{ Request::is('blog') ||Request::is('blog-detail*') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('blog')||Request::is('blog-detail*') ? 'last' : '' }}" href="{{route('page.blog')}}"> Blogs</a>
                        </li>
                        <li class="nav-item  {{ Request::is('collaboration') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('collaboration') ? 'last' : '' }}" href="{{route('page.collaboration')}}"> Collaborations</a>
                        </li>
                        <li class="nav-item  {{ Request::is('contact') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('contact') ? 'last' : '' }}" href="{{route('page.contact')}}">Contact Us</a>
                        </li> 
                        <?php if(Session::has('user_id') && Session::has('role_id')){
                            if(Session::get('role_id') == 2){?>
                                <li class="nav-item  {{ Request::is('expert/profile/*/edit') ? 'last2' : '' }}">
                                    <a class="nav-item nav-link {{ Request::is('expert/profile/*/edit') ? 'last' : '' }}" href="{{url('expert/profile')}}/{{Session::get('user_id')}}/edit">Dashboard</a>
                                </li>
                            <?php }else if(Session::get('role_id') == 3){?>
                                <li class="nav-item  {{ Request::is('profile/*/edit') ? 'last2' : '' }}">
                                    <a class="nav-item nav-link {{ Request::is('profile/*/edit') ? 'last' : '' }}" href="{{url('profile')}}/{{Session::get('user_id')}}/edit">Dashboard</a>
                                </li> 
                        <?php }else{?>
                            <li class="nav-item  {{ Request::is('admin/dashboard') ? 'last2' : '' }}">
                                <a class="nav-item nav-link {{ Request::is('admin/dashboard') ? 'last' : '' }}" href="{{route('admin.dashboard')}}">Dashboard</a>
                            </li> 
                        <?php }}else{?>
                            <li class="nav-item  {{ Request::is('user_login') ? 'last2' : '' }}">
                                <a class="nav-item nav-link {{ Request::is('user_login') ? 'last' : '' }}" href="{{ route('login') }}">Login</a>
                            </li>
                        <?php }?> 
                        <li class="nav-item  {{ Request::is('pricing') ? 'last2' : '' }}">
                            <a class="nav-item nav-link {{ Request::is('pricing') ? 'last' : '' }}" href="{{route('page.pricing')}}">Pricing</a>
                        </li>
                        @if(Session::get('role_id') == 3)
                            <li class="nav-item last1">
                                <a class="nav-item nav-link last" href="{{route('appointment.create')}}">Appointment</a>
                            </li>
                        @endif
                        <!-- last2  last-->
                        @if(Session::get('role_id') == 3)
                            <li class="nav-item"> 
                                <a class="nav-item nav-link" href="{{ route('viewcart') }}">{{CommonFunction::getCount('cart','user_id',Session::get('user_id'))}}<i style="font-size: 20px;color: white;" class="fas fa-shopping-cart"></i></a>
                            </li>
                        @endif
                    </ul>
                    <!-- <div class="common-search">
                        <button type="button" onclick="openSearch()"><i class="fa fa-search"></i></button>
                    </div> -->
                </div>
        </nav>
    </header>