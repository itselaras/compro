<?php
    function cekSidebar()
    {
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
            if ($_SESSION["typeID"]==1) {
                include("includes/admin-sidebar.php");
            }else{
                include("includes/member-sidebar.php");
            }
        } else
        {
            include("includes/sidebar.php");
        }
    }

    function wordsLimit($string, $word_limit)
    {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }

    function jurusanSelected($selected){
        $sql = "SELECT * FROM tb_jurusan ORDER BY jurusan";
        $query = mysql_query($sql);
        echo "<option value=''></option>";
        while ($result = mysql_fetch_array($query)) {
            $status = ($result['id'] == $selected) ? 'selected' : '' ;
            echo "<option value='$result[id]' $status>$result[jurusan]</option>";
        }
    }

    function bisnisSelected($selected){
        $sql = "SELECT * FROM tb_struktur_bidang_bisnis";
        $query = mysql_query($sql);
        echo "<option value=''>Pilih</option>";
        while ($result = mysql_fetch_array($query)) {
            $status = ($result['id'] == $selected) ? 'selected' : '' ;
            echo "<option value='$result[id]' $status>$result[bidang_bisnis]</option>";
        }
    }

    function fungsiSelected($selected){
        $sql = "SELECT * FROM tb_struktur_fungsi_kerja";
        $query = mysql_query($sql);
        echo "<option value=''>Pilih</option>";
        while ($result = mysql_fetch_array($query)) {
            $status = ($result['id'] == $selected) ? 'selected' : '' ;
            echo "<option value='$result[id]' $status>$result[fungsi_kerja]</option>";
        }
    }

    function posisiSelected($selected){
        $sql = "SELECT * FROM tb_struktur_posisi_kerja";
        $query = mysql_query($sql);
        echo "<option value=''>Pilih</option>";
        while ($result = mysql_fetch_array($query)) {
            $status = ($result['id'] == $selected) ? 'selected' : '' ;
            echo "<option value='$result[id]' $status>$result[posisi_kerja]</option>";
        }
    }

    function levelJabatanSelected($selected){
        $sql = "SELECT * FROM tb_struktur_level_jabatan";
        $query = mysql_query($sql);
        echo "<option value=''>Pilih</option>";
        while ($result = mysql_fetch_array($query)) {
            $status = ($result['id'] == $selected) ? 'selected' : '' ;
            echo "<option value='$result[id]' $status>$result[level_jabatan]</option>";
        }
    }

    function agamaSelected($selected){
        if ($selected == 1) {
            echo "BUDHA";
        }elseif ($selected == 2) {
            echo "HINDU";
        }elseif ($selected == 3) {
            echo "ISLAM";
        }elseif ($selected == 4) {
            echo "KRISTEN KATOLIK";
        }elseif ($selected == 5) {
            echo "KRISTEN PROTESTAN";
        }elseif ($selected == 6) {
            echo "LAINNYA";
        }
    }

    function tingkatanSelected($selected){
        if ($selected==1) {
            echo "SMA";
        }elseif($selected==2){
            echo "Akademi";
        }elseif($selected==3){
            echo "Strata";
        }elseif($selected==4){
            echo "Pascasarjana";
        }
    }

    function keluargaSelected($selected){
        if ($selected==1) {
            echo "LAJANG";
        }elseif($selected==2){
            echo "TUNANGAN";
        }elseif($selected==3){
            echo "MENIKAH";
        }elseif($selected==4){
            echo "BERCERAI";
        }
    }

    function informasiSelected($selected){
        if ($selected==1) {
            echo "RADIO";
        }elseif($selected==2){
            echo "GOOGLE SEARCH ENGINE";
        }elseif($selected==3){
            echo "YAHOO SEARCH ENGINE";
        }elseif($selected==4){
            echo "WEBSITE";
        }elseif($selected==5){
            echo "MAJALAH";
        }elseif($selected==6){
            echo "KORAN";
        }elseif($selected==7){
            echo "PAMERAN";
        }elseif($selected==8){
            echo "TEMAN";
        }elseif($selected==9){
            echo "LAIN-LAIN";
        }
    }
?>