<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="summernote/summernote.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href=" index.php" class="nav-link"> <i class="fa fa-home mx-2" aria-hidden="true"></i> Home
                        Admin</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href=" index.php?f=categories&file=main" class="nav-link"> <i class="fa fa-list mx-2" aria-hidden="true"></i>Category List</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href=" index.php?f=products&file=main" class="nav-link"> <i class="fa fa-list mx-2" aria-hidden="true"></i>Products List</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <!-- <form method="get" class="form-inline navbar-nav ml-auto" action="">
                <ul class="navbar-nav ml-auto">

                    Messages Dropdown Menu
                    <?php
                    $f = isset($_GET['f']) ? $_GET['f'] : '';
                    $folder = isset($_GET['folder']) ? $_GET['folder'] : '';
                    ?>
                    Notifications Dropdown Menu
                    <li class="nav-item dropdown">
                        <label class="sr-only" for="">label</label>
                        <input type="hidden" name="f" value="<?= $f; ?>">
                        <input type="hidden" name="folder" value="<?= $folder; ?>">
                        <input class="form-control" name="key" placeholder="Search...">
                    </li>
                    <li class="nav-item">
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i></button>
                    </li>
                </ul>
            </form> -->
        </nav>
        <!-- /.navbar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <!-- <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8"> -->
                <span class="brand-text font-weight-light">Baker Bite</span>
            </a>
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!-- <div class="image">
                        <img src="" class="img-circle elevation-2" alt="User Image">
                    </div> -->
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home Admin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon  fas fa-bars"></i>
                                <p>
                                    Categories Manager
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href=" index.php?f=categories&file=main" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?f=categories&file=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bars"></i>
                                <p>
                                    Products Manager
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="admin/index.php?f=products&file=main" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="admin/index.php?f=products&file=create" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->