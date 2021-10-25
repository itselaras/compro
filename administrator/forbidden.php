<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Access Forbidden</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../ico/2.ico" type="image/x-icon">
    <link rel="icon" href="../ico/2.ico" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="invisible">
    <?php
        include("includes/cek-lowongan.php");
    ?>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-brand" href="index"><i class="fa fa-cogs"></i> Control Panel</a>
        </div>
    </nav>

    <div class="col-lg-12 text-center">
        <h1 class="page-header">Oops!</h1>
        <div class="alert alert-danger">
            <h1><i class="fa fa-minus-circle"></i></h1>
            <h2><strong>Error 403</strong></h2>
            <h3>Access forbidden</h3>
            <p align="center">I'm sorry, you cannot access the web page because your account don't have a permission.</p>
        </div>
        <a href="index" class="btn btn-primary"><i class="fa fa-sign-in"></i> Take me back</a>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="../js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('body').removeClass('invisible').hide().fadeIn('400');
    });
</script>
