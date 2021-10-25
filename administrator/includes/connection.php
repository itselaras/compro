<?php
    /* Database connection information */
    $db_user     = "selar353_trial";
    $db_password = "trial123";
    $db_database = "selar353_trial";
    $db_server   = "localhost";


    //Membuat koneksi database
    $connection = mysql_connect($db_server, $db_user, $db_password);
    if(!$connection){
        die("Koneksi database gagal: " . mysql_error());
    }
     
    //Memilih database
    $db_select = mysql_select_db($db_database);
    if(!$db_select){
        die("Pemilihan database gagal: " . mysql_error());
    }
?>