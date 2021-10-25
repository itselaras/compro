<?php
    session_start();
    ob_start();
    include("administrator/includes/connection.php");
    include("administrator/includes/function.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PT Selaras Mitra Integra</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="ico/2.ico" type="image/x-icon">
    <link rel="icon" href="ico/2.ico" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/agency.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Custom Slider Beranda -->
    <link rel="stylesheet" type="text/css" href="css/slider.css" />
    <link rel="stylesheet" type="text/css" href="css/slider-style2.css" />
    <script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
    <noscript>
        <link rel="stylesheet" type="text/css" href="css/slider-nojs.css" />
    </noscript>

    <!-- Custom Ion Calendar -->
    <link rel="stylesheet" type="text/css" href="css/ion.calendar.css" />

</head>

<body id="page-top" class="index">

    <div class="container container-index">
        <div class="row">
            <div class="col-md-12">
                <div class="container-agency">
                    <div class="alert alert-danger jumbotron">
                        <div class="row">
                            <div class="col-md-2 col-sm-3">
                                <h1><i class="fa fa-exclamation-triangle fa-3x"></i></h1>
                            </div>
                            <div class="col-md-10 col-sm-9">
                                <h1>Access security!</h1>
                                <h3>Error 403</h3>
                                <p>
                                    I'm sorry, you can't access the web page because you don't have a permission.<br>
                                    Please login first.
                                </p>
                                <p><a href="index" class="btn btn-danger btn-lg" role="button"><i class="fa fa-home"></i> Back to login page</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/dataTables/jquery.dataTables.js"></script>
    <script src="js/dataTables/dataTables.bootstrap.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <!-- <script src="js/contact_me.js"></script>-->
    <!-- Custom Theme JavaScript -->
    <script src="js/agency.js"></script>

    <!-- Custom Slider -->
    <script type="text/javascript" src="js/jquery.cslider.js"></script>

    <!-- Custom Ion Calendar -->
    <script type="text/javascript" src="js/ion-calendar/moment.js"></script>
    <script type="text/javascript" src="js/ion-calendar/ion.calendar.js"></script>

</body>

</html>