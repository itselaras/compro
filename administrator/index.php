<?php
    // echo "<pre>";
    //     print_r($_COOKIE);
    // echo "</pre>";
    session_start();
    include("includes/cek-lowongan.php");
    if(!isset($_COOKIE["username"]))
    {
        $_COOKIE["username"] = "";
    }
    if(!isset($_COOKIE["password"]))
    {
        $_COOKIE["password"] = "";
    }
    if((isset($_SESSION["loginID"])&&$_SESSION["loginID"]!="")&&(isset($_SESSION["typeID"])&&$_SESSION["typeID"]!="")&&(isset($_SESSION["userID"])&&$_SESSION["userID"]!=""))
    {
        header("Location: home");
    } else
    {
        session_destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../ico/2.ico" type="image/x-icon">
    <link rel="icon" href="../ico/2.ico" type="image/x-icon">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default invisible">
                    <div class="panel-heading text-center">
                        <h4>PT SELARAS MITRA INTEGRA</h4>
                    </div>
                    <div class="panel-body">
                        <input type="hidden" class="status" value="<?php echo $_GET['status'] ?>">
                        <form role="form" onsubmit="return formSubmit()">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control username" placeholder="Username" name="username" value="<?php echo $_COOKIE['username'] ?>" type="text" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control password" placeholder="Password" name="password" value="<?php echo $_COOKIE['password'] ?>" type="password" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input class="remember" type="checkbox">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="alert alert-danger alert-modal invisible">
                    
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>

<script type="text/javascript">
    function formSubmit()
    {
        if($('.remember').is(':checked'))
        {
            remember = 1;
        } else
        {
            remember = 0;
        }
        $.ajax({
            url: '../login',
            type: 'POST',
            dataType: 'json',
            data: {
                username: $('.username').val(),
                password: $('.password').val(),
                url: 'home',
                remember: remember
            },
        })
        .done(function(data) {
            console.log("success");
            if(data.auth==0)
            {
                $('.alert-modal').html('<strong>Peringatan!</strong> Data login anda salah');
                $('.alert-modal').removeClass('invisible').hide().fadeIn('slow', function(){
                    setTimeout(function() {
                        $('.alert-modal').fadeOut('slow');
                    }, 3000);
                });
            } else
            {
                window.location.href=data.auth;
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        return false;
    }
    $(document).ready(function() {
        $('.panel').removeClass('invisible').hide().fadeIn('slow');
        status = $('.status').val();
        if((status == 'logout')&&($('.password').val()!=''))
        {
            $('.remember').prop('checked', 'checked');
        } else if(($('.username').val()!='')&&($('.password').val()!=''))
        {
            $('.remember').prop('checked', 'checked');
            $('.btn-block').click();
        }
    });
</script>
