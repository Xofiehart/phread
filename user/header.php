<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="">

            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand-lg bg-body-tertiary" id="accordionSidebar">
                    <div class="container-fluid">

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <!-- Sidebar - Brand -->
                                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                                    <div class="sidebar-brand-icon rotate-n-15">

                                    </div>

                                </a>

                                <!-- Divider -->
                                <hr class="sidebar-divider my-0">

                                <!-- Nav Item - Dashboard -->
                                <li class="nav-item active">
                                    <a class="nav-link" href="dashboard.php">

                                        <span>Dashboard</span></a>
                                </li>

                                <!-- Divider -->
                                <hr class="sidebar-divider">

                                <!-- Heading -->


                                <!-- Nav Item - Pages Collapse Menu -->


                                <!-- Nav Item - Utilities Collapse Menu -->
                                <?php
                                if ($_SESSION['role'] == 'admin') {
                                    echo ' 
                                    <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">

                                        <span>Users</span>
                                    </a>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <h6 class="collapse-header">Admin Action:</h6>
                                            <a class="collapse-item" href="users.php">Delete</a>
                                            <!-- <a class="collapse-item" href="cards.html">Re</a> -->
                                        </div>
                                    </div>
                                </li>
                                    <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">

                                        <span>Moderate</span>
                                    </a>
                                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <h6 class="collapse-header">User Input</h6>
                                            <a class="collapse-item" href="posts.php">Posts</a>
                                            <a class="collapse-item" href="comments.php">Comments</a>
                                            <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a> -->
                                        </div>
                                    </div>

                                </li>';
                                }
                                ?>

                                <!-- Divider -->
                                <hr class="sidebar-divider">

                                <!-- Heading -->

                                <!-- Nav Item - Pages Collapse Menu -->
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">

                                        <span>Stories</span>
                                    </a>
                                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <h6 class="collapse-header">Stories:</h6>
                                            <a class="collapse-item" href="./createPost.php">New Story</a>
                                            <a class="collapse-item" href="moderatePost.php">Review</a>
                                        </div>
                                    </div>
                                </li>

                                <!-- Nav Item - Charts -->
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">

                                        <span>Logout</span></a>
                                </li>

                                <!-- Nav Item - Tables -->
                                <li class="nav-item">
                                    <a class="nav-link" href="../index.php">

                                        <span>Home</span></a>
                                </li>

                                <!-- Divider -->
                                <hr class="sidebar-divider d-none d-md-block">

                                <!-- Sidebar Toggler (Sidebar) -->
                                <div class="text-center d-none d-md-inline">
                                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                                </div>




                        </div>
                    </div>
                </nav>
                <!-- Topbar -->

                <!-- End of Topbar -->



            </div>