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
                <a class="navbar-brand" href="#"><img class="img-fluid" src="images/logo.svg"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto justify-content-end">
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#">Tools</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#"> Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#"> Collaboration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-item nav-link" href="#">Login</a>
                        </li>
                        <li class="nav-item last1">
                            <a class="nav-item nav-link last" href="#">Appointment</a>
                        </li>
                        <li class="nav-item last2">
                            <a class="nav-item nav-link last" href="#">Pricing</a>
                        </li>
                    </ul>
                    <div class="common-search">
                        <button type="button" onclick="openSearch()"><i class="fa fa-search"></i></button>
                    </div>
                </div>
        </nav>
    </header>