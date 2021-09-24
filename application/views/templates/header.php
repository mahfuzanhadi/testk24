<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Test PT K-24 Indonesia</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('/assets/img/favicon.png') ?> " rel="icon">
    <link href="<?= base_url('/assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('/assets/vendor/bootstrap/css/bootstrap.min.css') ?> " rel="stylesheet">
    <link href="<?= base_url('/assets/vendor/icofont/icofont.min.css') ?> " rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.bootstrap.min.css" />

    <link href="assets/css/all.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('/assets/css/style.css') ?>" rel="stylesheet">

    <!-- Javascript -->
    <script src="<?= base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('assets/js/bootbox.min.js') ?>"></script>

    <!-- =======================================================
  * Template Name: Sailor - v2.3.1
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="d-flex flex-column min-vh-100">
    <?php

    $url = $this->uri->segment(1);

    ?>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container d-flex align-items-center">

            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="<?= base_url('/assets/img/logo.png') ?>" alt="" class="img-fluid"></a> -->

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="nav-item <?= ($url === 'member') ? 'active' : '' ?>"><a href="<?= base_url('member') ?>">Members</a></li>
                    <li class="nav-item <?= ($url === 'user') ? 'active' : '' ?>"><a href="<?= base_url('User') ?>">Users</a></li>
                    <li class="nav-item <?= ($url === 'json') ? 'active' : '' ?>"><a href="<?= base_url('json') ?>">JSON</a></li>

                </ul>

            </nav><!-- .nav-menu -->

            <nav class="nav-menu d-none d-lg-block" style="margin-left: 45rem;">
                <ul>
                    <li class="drop-down"><a href="#"><?= $this->session->userdata('username'); ?></a>
                        <ul>
                            <li><a href="<?= base_url('auth/logout') ?>">Log out</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

        </div>
    </header><!-- End Header -->

    <main id="main">