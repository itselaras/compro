<?php
    function goOut($script)
    {
        $remove=time()-60*60*24*1;
        setcookie("password", "", $remove);
        if($script == "PHP")
        {
            header("Location: forbidden"); 
        }
        if($script == "JS")
        {
            echo "<script>";
                echo "window.location.href='forbidden'";
            echo "</script>";
        }
    }

    function cekLogin($type)
    {
        $sql = "SELECT type FROM tb_user WHERE id='$_SESSION[loginID]'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
        if(!in_array($result["type"], $type))
        {
            goOut("PHP");
        }
    }

    function cekMenu($filename,$position) 
    {
        $file = $_SERVER["SCRIPT_NAME"];
        $arrFile = pathinfo($file);
        $file1 = explode("-", $arrFile["filename"]);
        $file2 = pathinfo($filename);
        if($position == "parent")
        {
            $filePosition = $file1[0];
        }
        if($position == "child")
        {
            $filePosition = $file1[1];
        }
        if($filePosition == $file2["filename"])
        {
            return "active";
        }
    }

    function tipeUser($num)
    {
        switch ($num) {
            case '1':
                $type = "Administrator";
                break;
            case '2':
                $type = "Pelamar";
                break;
        }
        return $type;
    }

    function authByID($id)
    {
        $auth = 0;
        $sql = "SELECT id,type FROM tb_user WHERE id='$id'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
        if((mysql_num_rows(mysql_query($sql))) == 1)
        {
            if(($result["id"]!=$_SESSION["loginID"])||($result["type"])!=$_SESSION["typeID"])
            {
                $auth = 1;
                goOut("JS");
            }
        } else
        {
            $auth = 1;
            goOut("JS");
        }
        return $auth;
    }

    function selected($code,$value)
    {
        if($code==$value)
        {
            return "selected";
        }
    }

    function tipeOffice($tipe)
    {
        switch ($tipe) {
            case '1':
                $office = "Head Office";
                break;
            case '2':
                $office = "Representative Office";
                break;
        }
        return $office;
    }
    function optSelect($value,$select){
        if($value == $select)
        {
            return "selected";
        } else
        {
            return "";
        }
    }
    function optRadio($value,$check){
        if($value == $check)
        {
            return "checked";
        } else
        {
            return "";
        }
    }
    function cekPendidikan($id)
    {
        switch ($id) {
            case '':
                return "-";
                break;
            case '1':
                return "SMA";
                break;
            case '2':
                return "Diploma";
                break;
            case '3':
                return "Sarjana";
                break;
            case '4':
                return "Pascasarjana";
                break;
        }
    }
?>