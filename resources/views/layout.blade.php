<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v21/carrot-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 15:29:37 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="ecommerce, market, shop, mart, cart, deal, multipurpose, marketplace">
    <meta name="description" content="Carrot - Multipurpose eCommerce HTML Template.">
    <meta name="author" content="ashishmaraviya">

    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/logo/favicon.png') }}">

    <!-- Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/remixicon.css') }}">

    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/aos.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/range-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery.slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="body-bg-6">

    <!-- Loader -->
    <div id="cr-overlay">
        <span class="loader"></span>
    </div>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="top-header">
                        <a href="{{ route('home') }}" class="cr-logo">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo" class="logo">
                            <img src="{{ asset('assets/img/logo/dark-logo.png') }}" alt="logo" class="dark-logo">
                        </a>

                        <form class="cr-search" action="{{ route('search') }}">
                            <input class="search-input" type="text" placeholder="Search For items..." name='q'>
                            <button type='submit' class="search-btn">
                                <i class="ri-search-line"></i>
                            </button>
                        </form>

                        <div class="cr-right-bar">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle cr-right-bar-item" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                        <span>Account</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <ul class="dropdown-menu">
                                            @if (isset(Auth::user()->role) && Auth::user()->role == 'user')
                                                <li>
                                                    <a
                                                        href="{{ route('user.profile.edit', Auth::user()->id) }}">{{ Str::limit(Auth::user()->name, 12, '...') }}</a>
                                                </li>
                                                <li><a href="{{ route('orders', ['user' => Auth::user()->id]) }}">My
                                                        Orders</a></li>
                                                <style>
                                                    .dropdown-button {
                                                        display: block;
                                                        width: 100%;
                                                        padding: 0.5rem 1rem;
                                                        clear: both;
                                                        font-weight: 200;
                                                        color: #212529;
                                                        text-align: left;
                                                        white-space: nowrap;
                                                        background-color: transparent;
                                                        border: none;
                                                        border-radius: 0;
                                                        font-size: small;
                                                        margin: 5px;
                                                    }

                                                    .dropdown-button:hover,
                                                    .dropdown-button:focus {
                                                        color: #d13636;
                                                    }
                                                </style>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-button">Logout</button>
                                                    </form>
                                                </li>
                                            @else
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('register') }}">Register</a>
                                                </li>
                                            @endif
                                            {{-- <li>
                                                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                            </li> --}}
                                        </ul>
                                    </ul>
                                </li>
                            </ul>

                            <a href="{{ route('cart') }}" class="cr-right-bar-item">
                                <i class="ri-shopping-cart-line"></i>
                                <span>Cart</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="cr-fix" id="cr-main-menu-desk">
            <div class="container">
                <div class="cr-menu-list">
                    <div class="cr-category-icon-block">
                        <div class="cr-category-menu">
                            <div class="cr-category-toggle">
                                <i class="ri-menu-2-line"></i>
                            </div>
                        </div>

                        <div class="cr-cat-dropdown">
                            <div class="cr-cat-block">
                                <div class="cr-cat-tab">
                                    <div class="cr-tab-list nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            Dairy &amp; Bakery</button>
                                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false" tabindex="-1">
                                            Fruits &amp; Vegetable</button>
                                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-messages" type="button" role="tab"
                                            aria-controls="v-pills-messages" aria-selected="false" tabindex="-1">
                                            Snack &amp; Spice</button>
                                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-settings" type="button" role="tab"
                                            aria-controls="v-pills-settings" aria-selected="false" tabindex="-1">
                                            Juice &amp; Drinks </button>
                                        <a class="nav-link" href="shop-left-sidebar.html">
                                            View All </a>
                                    </div>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">
                                            <div class="tab-list row">
                                                <div class="col">
                                                    <h6 class="cr-col-title">Dairy</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Milk</a></li>
                                                        <li><a href="shop-left-sidebar.html">Ice cream</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Cheese</a></li>
                                                        <li><a href="shop-left-sidebar.html">Frozen
                                                                custard</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Frozen
                                                                yogurt</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <h6 class="cr-col-title">Bakery</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Cake and
                                                                Pastry</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Rusk Toast</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Bread &amp;
                                                                Buns</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Chocolate
                                                                Brownie</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Cream Roll</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                            aria-labelledby="v-pills-profile-tab">
                                            <div class="tab-list row">
                                                <div class="col">
                                                    <h6 class="cr-col-title">Fruits</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Cauliflower</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Bell
                                                                Peppers</a></li>
                                                        <li><a href="shop-left-sidebar.html">Broccoli</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Cabbage</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Tomato</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <h6 class="cr-col-title">Vegetable</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Cauliflower</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Bell
                                                                Peppers</a></li>
                                                        <li><a href="shop-left-sidebar.html">Broccoli</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Cabbage</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Tomato</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                            aria-labelledby="v-pills-messages-tab">
                                            <div class="tab-list row">
                                                <div class="col">
                                                    <h6 class="cr-col-title">Snacks</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">French
                                                                fries</a></li>
                                                        <li><a href="shop-left-sidebar.html">potato
                                                                chips</a></li>
                                                        <li><a href="shop-left-sidebar.html">Biscuits &amp;
                                                                Cookies</a></li>
                                                        <li><a href="shop-left-sidebar.html">Popcorn</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Rice Cakes</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <h6 class="cr-col-title">Spice</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Cinnamon
                                                                Powder</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Cumin
                                                                Powder</a></li>
                                                        <li><a href="shop-left-sidebar.html">Fenugreek
                                                                Powder</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Pepper
                                                                Powder</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Long Pepper</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                            aria-labelledby="v-pills-settings-tab">
                                            <div class="tab-list row">
                                                <div class="col">
                                                    <h6 class="cr-col-title">Juice</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Mango Juice</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Coconut
                                                                Water</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Tetra Pack</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Apple
                                                                Juices</a></li>
                                                        <li><a href="shop-left-sidebar.html">Lychee
                                                                Juice</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col">
                                                    <h6 class="cr-col-title">soft drink</h6>
                                                    <ul class="cat-list">
                                                        <li><a href="shop-left-sidebar.html">Breizh Cola</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Green Cola</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Jolt Cola</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Mecca Cola</a>
                                                        </li>
                                                        <li><a href="shop-left-sidebar.html">Topsia Cola</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <nav class="navbar navbar-expand-lg">
                        <a href="javascript:void(0)" class="navbar-toggler shadow-none">
                            <i class="ri-menu-3-line"></i>
                        </a>
                        <div class="cr-header-buttons">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" href="javascript:void(0)">
                                        <i class="ri-user-3-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="register.html">Register</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="checkout.html">Checkout</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="login.html">Login</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <a href="wishlist.html" class="cr-right-bar-item">
                                <i class="ri-heart-line"></i>
                            </a>
                            <a href="javascript:void(0)" class="cr-right-bar-item Shopping-toggle">
                                <i class="ri-shopping-cart-line"></i>
                            </a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="{{ route('categories') }}">
                                        Category
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($categories as $category)
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('category.show', $category->id) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products') }}">
                                        Products
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="">
                                        Contact Us
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                    <div class="cr-calling">
                        <i class="ri-phone-line"></i>
                        <a href="javascript:void(0)">+123 ( 456 ) ( 7890 )</a>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- Mobile menu -->
    <div class="cr-sidebar-overlay"></div>
    <div id="cr_mobile_menu" class="cr-side-cart cr-mobile-menu">
        <div class="cr-menu-title">
            <span class="menu-title">My Menu</span>
            <button type="button" class="cr-close">×</button>
        </div>
        <div class="cr-menu-inner">
            <div class="cr-menu-content">
                <ul>
                    <li class="dropdown drop-list">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">Category</a>
                        <ul class="sub-menu">
                            <li><a href="shop-left-sidebar.html">Shop Left sidebar</a></li>
                            <li><a href="shop-right-sidebar.html">Shop Right sidebar</a></li>
                            <li><a href="shop-full-width.html">Full Width</a></li>
                        </ul>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">product</a>
                        <ul class="sub-menu">
                            <li><a href="product-left-sidebar.html">product Left sidebar</a></li>
                            <li><a href="product-right-sidebar.html">product Right sidebar</a></li>
                            <li><a href="product-full-width.html">Product Full Width </a></li>
                        </ul>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">Pages</a>
                        <ul class="sub-menu">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="contact-us.html">Contact Us</a></li>
                            <li><a href="cart.html">Cart</a></li>
                            <li><a href="checkout.html">Checkout</a></li>
                            <li><a href="track-order.html">Track Order</a></li>
                            <li><a href="wishlist.html">Wishlist</a></li>
                            <li><a href="faq.html">Faq</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="policy.html">Policy</a></li>
                        </ul>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)" class="dropdown-list">Blog</a>
                        <ul class="sub-menu">
                            <li><a href="blog-left-sidebar.html">Left Sidebar</a></li>
                            <li><a href="blog-right-sidebar.html">Right Sidebar</a></li>
                            <li><a href="blog-full-width.html">Full Width</a></li>
                            <li><a href="blog-detail-left-sidebar.html">Detail Left Sidebar</a></li>
                            <li><a href="blog-detail-right-sidebar.html">Detail Right Sidebar</a></li>
                            <li><a href="blog-detail-full-width.html">Detail Full Width</a></li>
                        </ul>
                    </li>
                    <li class="dropdown drop-list">
                        <span class="menu-toggle"></span>
                        <a href="javascript:void(0)">Element</a>
                        <ul class="sub-menu">
                            <li><a href="elements-products.html">Products</a></li>
                            <li><a href="elements-typography.html">Typography</a></li>
                            <li><a href="elements-buttons.html">Buttons</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Hero slider -->


    @yield('content')

    <!-- Footer -->
    <footer class="footer padding-t-100 bg-off-white">
        <div class="container">
            <div class="row footer-top padding-b-100">
                <div class="col-xl-6 col-lg-6 col-sm-12 col-12 cr-footer-border">
                    <div class="cr-footer-logo">
                        <div class="image">
                            <img src="{{ asset('assets/img/logo/logo.png') }}" alt="logo" class="logo">
                            <img src="{{ asset('assets/img/logo/dark-logo.png') }}" alt="logo"
                                class="dark-logo">
                        </div>
                        <p>Carrot is the biggest market of grocery products. Get your daily needs from our store.</p>
                    </div>
                    <div class="cr-footer">
                        <h4 class="cr-sub-title cr-title-hidden">
                            Contact us
                            <span class="cr-heading-res"></span>
                        </h4>
                        <ul class="cr-footer-links cr-footer-dropdown">
                            <li class="location-icon">
                                51 Green St.Huntington ohaio beach ontario, NY 11746 KY 4783, USA.
                            </li>
                            <li class="mail-icon">
                                <a href="javascript:void(0)">carrotclothes@email.com</a>
                            </li>
                            <li class="phone-icon">
                                <a href="javascript:void(0)"> +91 123 4567890</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-sm-12 col-12 cr-footer-border">
                    <div class="cr-footer">
                        <h4 class="cr-sub-title">
                            Company
                            <span class="cr-heading-res"></span>
                        </h4>
                        <ul class="cr-footer-links cr-footer-dropdown">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="track-order.html">Delivery Information</a></li>
                            <li><a href="policy.html">Privacy Policy</a></li>
                            <li><a href="terms.html">Terms & Conditions</a></li>
                            <li><a href="contact-us.html">contact Us</a></li>
                            <li><a href="faq.html">Support Center</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-sm-12 col-12 cr-footer-border">
                    <div class="cr-footer">
                        <h4 class="cr-sub-title">
                            Category
                            <span class="cr-heading-res"></span>
                        </h4>
                        <ul class="cr-footer-links cr-footer-dropdown">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

            </div>
            <div class="cr-last-footer">
                <p>&copy; <span id="copyright_year"></span> <a href="index.html">Carrot</a>, All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Tab to top -->
    <a href="#Top" class="back-to-top result-placeholder">
        <i class="ri-arrow-up-line"></i>
        <div class="back-to-top-wrap">
            <svg viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>
    </a>

    <!-- Cart -->


    <script src="{{ asset('assets/js/vendor/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/mixitup.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendor/range-slider.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/aos.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/slick.min.js') }}"></script>

    <!-- Main Custom -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('script')
</body>


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v21/carrot-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 15:30:08 GMT -->

</html>
