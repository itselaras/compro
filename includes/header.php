<?php
    session_start();
    ob_start();
    include("administrator/includes/connection.php");
    include("administrator/includes/function.php");
    include("includes/function.php");
?>
<!-- =================================================
Theme Name: BRANDO Bootstrap Theme 
Author: WebThemez.com
License: https://webthemez.com/license
======================================================= -->
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PT Selaras Mitra Integra</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <meta content="Author" name="WebThemez">
  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- w3 css -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet"> 
  
  <!-- Splide -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

</head>

<body id="body"> 

  <!--==========================
    Header
  ============================-->
  <header id="header" style="padding-top : 0px;">
    <div class="container">

      <div id="logo" class="pull-left" style="margin-top : 5px;">
           <h1 style="font-size: 20px;"><a href="index.php" id="body" class="scrollto"><span class="mr-2"><img style="padding-top: 0; margin-top: -2px; width: 300px;" class="col-2 col-md-4" src="img/logo.png"></span></a></h1> 
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>
      
      <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
      </label>
    </div>

      <nav id="nav-menu-container" style="margin-top: 14px;">
        <ul class="nav-menu">
          <li><a href="index.php" style="font-size: 20px;">Home</a></li>
          <li class="menu-has-children"><a href="layanan.php" style="font-size: 20px;">Layanan</a>
            <ul>
              <li><a href="layanan.php#rekrutmen">Rekrutmen dan Seleksi</a></li>
              <li><a href="layanan.php#pelatihan">Pelatihan dan Pengembangan</a></li>
              <li><a href="layanan.php#pengembangan">Pengembangan Organisasi</a></li>
              <li><a href="layanan.php#assessment">Assessment Center</a></li>
              <li><a href="layanan.php#labour">Labour Supply</a></li>
              <li><a href="layanan.php#coaching">Coaching and Counseling</a></li>
              <li><a href="layanan.php#transportasi">Transportasi dan Logistik</a>
                <ul>
                    <li><a href="http://mapsgo.id/v2/index.php">Mapsgo</a></li>
                    <li><a href="https://mapsline.id/">Mapsline</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href="klien.php" style="font-size: 20px;">Klien</a></li>
          <li><a href="galeri.php" style="font-size: 20px;">Galeri</a></li>
          <li><a href="kontak.php" style="font-size: 20px;">Kontak</a></li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->