<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["act"]))
    {
        header("Location: user");
    }
    $result["username"] = "";
    $result["password"] = "";
    $result["c-password"] = "";
    $act = "submit";
    if($_GET["act"]=="submit")
    {
        $sql = "INSERT INTO tb_user(username,password,type,created_at,updated_by,updated_at) VALUES('".$_POST["username"]."',md5('".$_POST["password"]."'),1,NOW(),'".$_SESSION["loginID"]."',NOW())";
        $query = mysql_query($sql);
        // echo $sql;
        if($query)
        {
            header("Location: user");
        }
    }
    if($_GET["act"]=="update")
    {
        if($_POST["password"] == $_POST["old-pwd"])
        {
            $sql = "UPDATE tb_user SET username='".$_POST["username"]."' WHERE id='".$_POST["id"]."'";
        } else
        {
            $sql = "UPDATE tb_user SET username='".$_POST["username"]."',password=md5('".$_POST["password"]."') WHERE id='".$_POST["id"]."'";            
        }
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: user");
        }
    }
    if($_GET["act"] == "Edit")
    {
        $act = "update";
        $sql = "SELECT * FROM tb_user WHERE id='".$_GET["id"]."'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
    }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-user"></i> Manajemen Akun</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="user">Manajemen Akun</a></li>
        <li class="active"><?php echo $_GET["act"] ?> Data</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $_GET["act"] ?> Akun (Administrator)</div>
        <div class="panel-body">
            <form action="user-form?act=<?php echo $act ?>" method="post" onsubmit="return val()">
            <?php
                if($_GET["act"] == "Edit")
                {
                    echo "<input type='hidden' name='id' value='$_GET[id]'>"; 
                    echo "<input type='hidden' name='old-pwd' value='".$result["password"]."'>"; 
                }
            ?>
                <div class="form-group">
                    <label>Nama Akun</label>
                    <input type="text" class="form-control username" name="username" value="<?php echo $result['username'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control password" name="password" value="<?php echo $result['password'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control c-password" name="c-password" value="<?php echo $result['password'] ?>" required>
                </div>
        </div>
        <div class="panel-footer">
                <button type="reset" class="btn btn-success"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
            </form>            
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    function val(){
        if(($('.password').val()) != ($('.c-password').val()))
        {
            bootbox.alert("Password dengan confirm password tidak cocok, mohon diperiksa kembali.");
            return false;
        } else
        {
            return true;
        }
    }
    $(document).ready(function() {
        
    });
</script>