<?php
    session_start();
    ob_start();
    include("includes/connection.php");
    include("includes/function.php");
    include("includes/cek-lowongan.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PT Selaras Mitra Integra - Control Panel</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="../ico/2.ico" type="image/x-icon">
    <link rel="icon" href="../ico/2.ico" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Ion Calendar -->
    <link href="css/plugins/datepicker3.css" rel="stylesheet">
    <!-- Font Open Sans -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <!-- BootstrapTable -->
    <!-- <link rel="stylesheet" href="css/bootstrap-table.css"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="invisible">
    <div id="modal-container"></div>
    <div id="modal-loading" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 20%;">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fa fa-spin fa-spinner fa-2x fa-inverse"></i>
                    <div class="loading-container"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="bb-alert alert alert-info" style="display:none;">
        <span></span>
    </div>
    <div class="bb-error alert alert-danger" style="display:none;">
        <span></span>
    </div>
    <div class="audio-container"></div>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home"><i class="fa fa-cogs"></i> Control Panel (<?php echo $_SESSION["userID"]; ?>)</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="badge badge-pesan" style="background-color: #d43f3a;"></span>
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages container-pesan">
                        <li>
                            <a href="#">
                                <div>
                                    Tidak ada pesan baru.
                                </div>
                                <!-- <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div> -->
                            </a>
                        </li>
                       <!--  <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li> -->
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="pesan">
                                <strong>Show All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="login-id"><i class="fa fa-cog fa-fw"></i> Login ID</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#" class="menu-logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="../"><i class="fa fa-desktop fa-fw"></i> Halaman Depan</a>
                        </li>
                        <li>
                            <a class="<?php echo cekMenu('klien','parent'); ?>" href="klien"><i class="fa fa-building fa-fw"></i> Perusahaan Klien</a>
                        </li>
                        <li>
                            <a class="<?php echo cekMenu('user','parent'); ?>" href="user"><i class="fa fa-user fa-fw"></i> Manajemen Akun</a>
                        </li>
                        <!--
                        <li class="<?php echo cekMenu('master','parent'); ?>">
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Master Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="master-struktur_pekerjaan-bidang_bisnis" class="<?php echo cekMenu('struktur_pekerjaan','child'); ?>">Struktur Pekerjaan</a>
                                </li>
                                <li>
                                    <a href="master-jurusan" class="<?php echo cekMenu('jurusan','child'); ?>">Bidang Keahlian / Jurusan</a>
                                </li>
                                <li>
                                    <a href="master-negara" class="<?php echo cekMenu('negara','child'); ?>">Negara</a>
                                </li>
                                <li>
                                    <a href="master-provinsi" class="<?php echo cekMenu('provinsi','child'); ?>">Provinsi / Negara Bagian</a>
                                </li>
                                <li>
                                    <a href="master-kota" class="<?php echo cekMenu('kota','child'); ?>">Kota</a>
                                </li>
                            </ul>
                        </li>
                        -->
                        <li class="<?php echo cekMenu('halaman','parent'); ?>">
                            <a href="#"><i class="fa fa-desktop fa-fw"></i> Konten Halaman<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="halaman-utama" class="<?php echo cekMenu('utama','child'); ?>">Deskripsi Halaman Utama</a>
                                </li>
                                <li>
                                    <a href="halaman-filosofi_visi_misi" class="<?php echo cekMenu('filosofi_visi_misi','child'); ?>">Filosofi, Visi & Misi</a>
                                </li>
                                <li>
                                    <a href="halaman-rekrutmen_dan_seleksi" class="<?php echo cekMenu('rekrutmen_dan_seleksi','child'); ?>">Rekrutmen dan Seleksi</a>
                                </li>
                                <li>
                                    <a href="halaman-assessment_center" class="<?php echo cekMenu('assessment_center','child'); ?>">Assessment Center</a>
                                </li>
                                <li>
                                    <a href="halaman-pelatihan_dan_pengembangan" class="<?php echo cekMenu('pelatihan_dan_pengembangan','child'); ?>">Pelatihan dan Pengembangan</a>
                                </li>
                                <li>
                                    <a href="halaman-pengembangan_organisasi" class="<?php echo cekMenu('pengembangan_organisasi','child'); ?>">Pengembangan Organisasi</a>
                                </li>
                                <li>
                                    <a href="halaman-labor_supply" class="<?php echo cekMenu('labor_supply','child'); ?>">Labor Supply</a>
                                </li>
                                <li>
                                    <a href="halaman-coaching_and_counseling" class="<?php echo cekMenu('coaching_and_counseling','child'); ?>">Coaching and Counseling</a>
                                </li>
                                <li>
                                    <a href="halaman-transportasi_dan_logistik" class="<?php echo cekMenu('transportasi_dan_logistik','child'); ?>">Transportasi dan Logistik</a>
                                </li>
                                <li>
                                    <a href="halaman-galeri" class="<?php echo cekMenu('galeri','child'); ?>">Galeri</a>
                                </li>
                                <li>
                                    <a href="halaman-kontak" class="<?php echo cekMenu('kontak','child'); ?>">Kontak</a>
                                </li>
                            </ul>
                        </li>
                        <!--
                        <li>
                            <a class="<?php echo cekMenu('pelamar','parent'); ?>" href="pelamar"><i class="fa fa-users fa-fw"></i> Manajemen Source</a>
                        </li>
                        <li>
                            <a class="<?php echo cekMenu('lowongan','parent'); ?>" href="lowongan"><i class="fa fa-briefcase fa-fw"></i> Lowongan Pekerjaan</a>
                        </li>
                        <li>
                            <a class="<?php echo cekMenu('rekrutmen','parent'); ?>" href="rekrutmen"><i class="fa fa-tags fa-fw"></i> Manajemen Pelamar</a>
                        </li>
                        <li class="<?php echo cekMenu('laporan','parent'); ?>">
                            <a href="#"><i class="fa fa-area-chart fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="laporan-lp_pelamar" class="<?php echo cekMenu('lp_pelamar','child'); ?>">Laporan Akun</a>
                                </li>
                                <li>
                                    <a href="laporan-lp_klien" class="<?php echo cekMenu('lp_klien','child'); ?>">Laporan Lowongan</a>
                                </li>
                                <li>
                                    <a href="laporan-lp_lowongan" class="<?php echo cekMenu('lp_lowongan','child'); ?>">Laporan Pelamar</a>
                                </li>
                            </ul>
                        </li>
                        -->
                        <li class="<?php echo cekMenu('pengaturan','parent'); ?>">
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Pengaturan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="pengaturan-email" class="<?php echo cekMenu('email','child'); ?>">Pengaturan Email</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>