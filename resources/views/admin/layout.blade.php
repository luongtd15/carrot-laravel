<!-----------------------------------------------------------------------------------
    Item Name: Carrot - Multipurpose eCommerce HTML Template.
    Author: ashishmaraviya
    Version: 2.1
    Copyright 2024
----------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v21/admin-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 15:41:02 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="admin, dashboard, ecommerce, panel" />
    <meta name="description" content="Carrot - Admin.">
    <meta name="author" content="ashishmaraviya">

    <title>
        @yield('title')
    </title>

    <link rel="shortcut icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}">

    <!-- Icon CSS -->
    <link href="{{ asset('admin/assets/css/vendor/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ asset('admin/assets/css/vendor/datatables.bootstrap5.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/responsive.datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/simplebar.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/apexcharts.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/css/vendor/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">

    <!-- Main CSS -->
    <link id="main-css" href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <main class="wrapper sb-default ecom">
        <!-- Loader -->
        <div id="cr-overlay">
            <div class="loader"></div>
        </div>

        <!-- Header -->
        <header class="cr-header">
            <div class="container-fluid">
                <div class="cr-header-items">
                    <div class="left-header">
                        <a href="javascript:void(0)" class="cr-toggle-sidebar">
                            <span class="outer-ring">
                                <span class="inner-ring"></span>
                            </span>
                        </a>
                        <div class="header-search-box">
                            <div class="header-search-drop">
                                <a href="javascript:void(0)" class="open-search"><i class="ri-search-line"></i></a>
                                <form class="cr-search">
                                    <input class="search-input" type="text" placeholder="Search...">
                                    <a href="javascript:void(0)" class="search-btn"><i class="ri-search-line"></i>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="right-header">
                        <div class="cr-right-tool display-screen">
                            <a class="cr-screen full" href="javascript:void(0)"><i class="ri-fullscreen-line"></i></a>
                            <a class="cr-screen reset" href="javascript:void(0)"><i
                                    class="ri-fullscreen-exit-line"></i></a>
                        </div>
                        <div class="cr-right-tool display-dark">
                            <a class="cr-mode dark" href="javascript:void(0)"><i class="ri-moon-clear-line"></i></a>
                            <a class="cr-mode light" href="javascript:void(0)"><i class="ri-sun-line"></i></a>
                        </div>
                        <div class="cr-right-tool cr-user-drop">
                            <div class="cr-hover-drop">
                                <div class="cr-hover-tool">
                                    <img class="user" src="{{ asset('admin/assets/img/user/1.jpg') }}"
                                        alt="user">
                                </div>
                                <div class="cr-hover-drop-panel right">
                                    <div class="details">
                                        <h6>Wiley Waites</h6>
                                        <p>wiley@example.com</p>
                                    </div>
                                    <ul class="border-top">
                                        <li><a href="team-profile.html">Profile</a></li>
                                        <li><a href="faq.html">Help</a></li>
                                        <li><a href="chatapp.html">Messages</a></li>
                                        <li><a href="project-overview.html">Projects</a></li>
                                        <li><a href="team-update.html">Settings</a></li>
                                    </ul>
                                    <ul class="border-top">
                                        <li><a href="signin.html"><i class="ri-logout-circle-r-line"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- sidebar -->
        <div class="cr-sidebar-overlay">

        </div>
        <div class="cr-sidebar" data-mode="light">
            <div class="cr-sb-logo">
                <a href="index.html" class="sb-full"><img src="{{ asset('admin/assets/img/logo/full-logo.png') }}"
                        alt="logo"></a>
                <a href="index.html" class="sb-collapse"><img
                        src="{{ asset('adminassets/img/logo/collapse-logo.png') }}" alt="logo"></a>
            </div>

            <div class="cr-sb-wrapper">
                <div class="cr-sb-content">
                    <ul class="cr-sb-list">
                        <li class="cr-sb-item sb-drop-item">
                            <a href="{{ route('dashboard') }}" class="cr-drop-toggle">
                                <i class="ri-dashboard-3-line"></i><span class="condense">Dashboard</span></a>
                        </li>
                        <li class="cr-sb-item-separator"></li>
                        <li class="cr-sb-item sb-drop-item">
                            <a href="javascript:void(0)" class="cr-drop-toggle">
                                <i class="ri-bookmark-line"></i><span class="condense">Categories<i
                                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                            <ul class="cr-sb-drop condense">
                                <li><a href="{{ route('admin.categories.index') }}" class="cr-page-link drop"><i
                                            class="ri-checkbox-blank-circle-line"></i>List</a></li>
                                <li><a href="{{ route('admin.categories.create') }}" class="cr-page-link drop"><i
                                            class="ri-checkbox-blank-circle-line"></i>Add</a></li>
                            </ul>
                        </li>
                        <li class="cr-sb-item-separator"></li>
                        <li class="cr-sb-item sb-drop-item">
                            <a href="javascript:void(0)" class="cr-drop-toggle">
                                <i class="ri-product-hunt-line"></i><span class="condense">Products<i
                                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                            <ul class="cr-sb-drop condense">
                                <li><a href="{{ route('admin.products.index') }}" class="cr-page-link drop"><i
                                            class="ri-checkbox-blank-circle-line"></i>List</a></li>
                                <li><a href="{{ route('admin.products.create') }}" class="cr-page-link drop"><i
                                            class="ri-checkbox-blank-circle-line"></i>Add</a></li>
                            </ul>
                        </li>
                        <li class="cr-sb-item-separator"></li>
                        <li class="cr-sb-item sb-drop-item">
                            <a href="javascript:void(0)" class="cr-drop-toggle">
                                <i class="ri-shield-user-line"></i><span class="condense">Users<i
                                        class="drop-arrow ri-arrow-down-s-line"></i></span></a>
                            <ul class="cr-sb-drop condense">
                                <li><a href="{{ route('admin.users.index') }}" class="cr-page-link drop"><i
                                            class="ri-checkbox-blank-circle-line"></i>List</a></li>
                                <li><a href="{{ route('admin.users.create') }}" class="cr-page-link drop"><i
                                            class="ri-checkbox-blank-circle-line"></i>Add</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        @yield('content')

        <!-- Footer -->
        <footer>
            <div class="container-fluid">
                <div class="copyright">
                    <p><span id="copyright_year"></span> © Carrot, All rights Reserved.</p>
                    <p>Design by MaraviyaInfotech.</p>
                </div>
            </div>
        </footer>

        <!-- Feature tools -->
        <div class="cr-tools-sidebar-overlay"></div>
        <div class="cr-tools-sidebar">
            <a href="javascript:void(0)" class="cr-tools-sidebar-toggle in-out">
                <i class="ri-settings-4-line"></i>
            </a>
            <div class="cr-bar-title">
                <h6>Tools</h6>
                <a href="javascript:void(0)" class="close-tools"><i class="ri-close-line"></i></a>
            </div>
            <div class="cr-tools-detail">
                <div class="cr-tools-block">
                    <h3>Sidebar</h3>
                    <div class="cr-tools-info">
                        <div class="cr-tools-item sidebar active" data-sidebar-mode-tool="light">
                            <img src="assets/img/tools/side-light.png" alt="light">
                            <p>light</p>
                        </div>
                        <div class="cr-tools-item sidebar" data-sidebar-mode-tool="dark">
                            <img src="assets/img/tools/side-dark.png" alt="dark">
                            <p>dark</p>
                        </div>
                        <div class="cr-tools-item sidebar" data-sidebar-mode-tool="bg-1">
                            <img src="assets/img/tools/side-bg-1.png" alt="background">
                            <p>Bg-1</p>
                        </div>
                        <div class="cr-tools-item sidebar" data-sidebar-mode-tool="bg-2">
                            <img src="assets/img/tools/side-bg-2.png" alt="background">
                            <p>Bg-2</p>
                        </div>
                        <div class="cr-tools-item sidebar" data-sidebar-mode-tool="bg-3">
                            <img src="assets/img/tools/side-bg-3.png" alt="background">
                            <p>Bg-3</p>
                        </div>
                        <div class="cr-tools-item sidebar" data-sidebar-mode-tool="bg-4">
                            <img src="assets/img/tools/side-bg-4.png" alt="background">
                            <p>Bg-4</p>
                        </div>
                    </div>
                </div>
                <div class="cr-tools-block">
                    <h3>Header</h3>
                    <div class="cr-tools-info">
                        <div class="cr-tools-item header active" data-header-mode="light">
                            <img src="assets/img/tools/header-light.png" alt="light">
                            <p>light</p>
                        </div>
                        <div class="cr-tools-item header" data-header-mode="dark">
                            <img src="assets/img/tools/header-dark.png" alt="dark">
                            <p>dark</p>
                        </div>
                    </div>
                </div>
                <div class="cr-tools-block">
                    <h3>Backgrounds</h3>
                    <div class="cr-tools-info">
                        <div class="cr-tools-item bg active" data-bg-mode="default">
                            <img src="assets/img/tools/bg-0.png" alt="default">
                            <p>Default</p>
                        </div>
                        <div class="cr-tools-item bg" data-bg-mode="bg-1">
                            <img src="assets/img/tools/bg-1.png" alt="bg-1">
                            <p>Bg-1</p>
                        </div>
                        <div class="cr-tools-item bg" data-bg-mode="bg-2">
                            <img src="assets/img/tools/bg-2.png" alt="bg-2">
                            <p>Bg-2</p>
                        </div>
                        <div class="cr-tools-item bg" data-bg-mode="bg-3">
                            <img src="assets/img/tools/bg-3.png" alt="bg-3">
                            <p>Bg-3</p>
                        </div>
                        <div class="cr-tools-item bg" data-bg-mode="bg-4">
                            <img src="assets/img/tools/bg-4.png" alt="bg-4">
                            <p>Bg-4</p>
                        </div>
                        <div class="cr-tools-item bg" data-bg-mode="bg-5">
                            <img src="assets/img/tools/bg-5.png" alt="bg-5">
                            <p>Bg-5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Vendor Custom -->
    <<script src="{{ asset('admin/assets/js/vendor/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/owl.carousel.min.js') }}"></script>

    <!-- Data Tables -->
    <script src="{{ asset('admin/assets/js/vendor/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/datatables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/datatables.responsive.min.js') }}"></script>

    <!-- Calendar -->
    <script src="{{ asset('admin/assets/js/vendor/jquery.simple-calendar.js') }}"></script>

    <!-- Date Range Picker -->
    <script src="{{ asset('admin/assets/js/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/js/vendor/date-range.js') }}"></script>

    <!-- Main Custom -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>
    <script src="{{ asset('admin/assets/js/data/ecommerce-chart-data.js') }}"></script>

    @yield('script')
</body>


<!-- Mirrored from maraviyainfotech.com/projects/carrot/carrot-v21/admin-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Nov 2024 15:41:34 GMT -->

</html>
