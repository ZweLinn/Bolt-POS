<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') === 'Laravel' ? 'Bolt POS Admin' : config('app.name') . ' Admin' }}</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #f8fafc; /* slate-50 */
        }
        .sidebar {
            background-color: #ffffff !important;
            border-right: 1px solid #e2e8f0; /* slate-200 */
        }
        .sidebar .nav-item .nav-link {
            color: #475569 !important; /* slate-600 */
            font-weight: 500;
        }
        .sidebar .nav-item .nav-link:hover {
            color: #2563eb !important; /* blue-600 */
        }
        .sidebar .nav-item.active .nav-link {
            color: #2563eb !important;
            font-weight: 700;
        }
        .sidebar-brand-text {
            color: #2563eb !important;
            font-weight: 700;
            text-transform: none !important;
            letter-spacing: -0.025em;
        }
        .sidebar-brand-text span {
            color: #334155 !important; /* slate-700 */
        }
        .sidebar-divider {
            border-top: 1px solid #e2e8f0 !important;
        }
        .topbar {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
        .btn-bolt {
            background-color: #2563eb;
            color: white;
            border: none;
        }
        .btn-bolt:hover {
            background-color: #1d4ed8;
            color: white;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-bolt text-bolt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Bolt<span>POS</span></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('category#list') }}"><i class="fa-solid fa-layer-group"></i><span>Category </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href=""><i class="fa-solid fa-plus-circle"></i><span>Add Products </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href=""><i class="fa-solid fa-list-ul"></i><span>Product List </span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-credit-card"></i><span>Payment Method </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-file-invoice-dollar"></i><span>Sale Information </span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href=""><i class="fa-solid fa-shopping-cart"></i><span>Order Board </span></a>
            </li>

        

            <li class="nav-item mt-4 px-3">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-bolt w-100 shadow-sm">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-3 d-none d-lg-inline text-slate-600 font-medium small">{{ Auth::user()->name ?? 'Admin User' }}</span>
                                <div class="img-profile rounded-circle bg-slate-200 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user text-slate-400"></i>
                                </div>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow border-0 animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item py-2" href={{ route('profile.edit') }}>
                                    <i class="fas fa-user fa-sm fa-fw mr-3 text-slate-400"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item py-2" href="">
                                    <i class="fas fa-user-plus fa-sm fa-fw mr-3 text-slate-400"></i>
                                    Add New Admin Account
                                </a>
                                <a class="dropdown-item py-2" href="">
                                    <i class="fas fa-users fa-sm fa-fw mr-3 text-slate-400"></i>
                                    Admin List
                                </a>

                                <a class="dropdown-item py-2" href="">
                                    <i class="fas fa-user-friends fa-sm fa-fw mr-3 text-slate-400"></i>
                                    User List
                                </a>

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item py-2" href={{ route('profile.edit') }}>
                                    <i class="fa-solid fa-lock fa-sm fa-fw mr-3 text-slate-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <div class="px-3 py-2">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-bolt btn-sm w-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    @yield('content')
                </div>
                
            </div>
            <!-- End of Main Content -->
            
            @include('sweetalert::alert')

            <!-- Footer -->
            <footer class="sticky-footer bg-white border-top">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-slate-500">
                        <span>&copy; {{ date('Y') }} Bolt POS. All rights reserved.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src='{{ asset("admin/vendor/jquery/jquery.min.js") }}'></script>
    <script src='{{ asset("admin/vendor/bootstrap/js/bootstrap.bundle.min.js") }}'></script>

    <!-- Core plugin JavaScript-->
    <script src='{{ asset("admin/vendor/jquery-easing/jquery.easing.min.js") }}'></script>

    <!-- Custom scripts for all pages-->
    <script src='{{ asset("admin/js/sb-admin-2.min.js") }}'></script>

</body>

</html>