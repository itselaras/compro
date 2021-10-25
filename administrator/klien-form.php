<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["act"]))
    {
        header("Location: klien");
    }
    $result["perusahaan"] = "";
    $result["logo"] = "";
    $extLogo = "";
    $act = "submit";
    $required = "required";
    if($_GET["act"]=="submit")
    {
        $move = move_uploaded_file($_FILES["logo"]["tmp_name"], "../img/klien/".$_FILES["logo"]["name"]);
        if($move)
        {
            $sql = "INSERT INTO tb_klien(perusahaan,logo) VALUES('".$_POST["perusahaan"]."','img/klien/".$_FILES["logo"]["name"]."')";
            $query = mysql_query($sql);
            if($query)
            {
                header("Location: klien");
            }
        }
    }
    if($_GET["act"]=="update")
    {
        $logo = explode("/", $_POST["logoLama"]);
        if($logo[3] != $_FILES["logo"]["name"] && $_FILES["logo"]["name"] != "")
        {
            unlink($_POST["logoLama"]);
            move_uploaded_file($_FILES["logo"]["tmp_name"], "../img/klien/".$_FILES["logo"]["name"]);
            $logo[3] = $_FILES["logo"]["name"];
        }
        $sql = "UPDATE tb_klien SET perusahaan='".$_POST["perusahaan"]."',logo='img/klien/".$logo[3]."' WHERE id='".$_POST["id"]."'";
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: klien");
        }
    }
    if($_GET["act"] == "Edit")
    {
        $act = "update";
        $required = "";
        $sql = "SELECT * FROM tb_klien WHERE id='".$_GET["id"]."'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
    }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-building"></i> Perusahaan Klien</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="klien">Perusahaan Klien</a></li>
        <li class="active"><?php echo $_GET["act"] ?> Data</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $_GET["act"] ?> Perusahaan Klien</div>
        <div class="panel-body">
            <form action="klien-form?act=<?php echo $act ?>" method="post" enctype="multipart/form-data" onsubmit="return cekForm()">
                <div class="form-group">
                    <label>Nama Perusahaan Klien</label>
                    <input type="text" class="form-control" name="perusahaan" value="<?php echo $result['perusahaan'] ?>" required>
                </div>
                <?php
                    if($_GET["act"] == "Edit")
                    {                    
                        echo "<label>Logo Lama</label><br>
                        <input type='hidden' name='logoLama' value='../$result[logo]'> 
                        <input type='hidden' name='id' value='$_GET[id]'> 
                        <img src='../$result[logo]' class='img-thumbnail' width='30%'><br><br>";
                        $extLogo = "Baru";
                    }
                ?>
                <div class="form-group">
                    <label>Logo <?php echo $extLogo ?></label><br>
                    <input type="file" class="btn btn-warning" id="logo" name="logo" <?php echo $required ?>>
                </div>
        </div>
        <div class="panel-footer">
                <button type="reset" class="btn btn-success reset"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
            </form>            
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    function cekForm(){
            var extensions = new Array("jpg","jpeg","gif","png","bmp");
            var image_file = $('#logo').val();
            var image_length = $('#logo').val().length;
            var pos = image_file.lastIndexOf('.') + 1;
            var ext = image_file.substring(pos, image_length);
            var final_ext = ext.toLowerCase();
            for (i = 0; i < extensions.length; i++)
            {
                if(extensions[i] == final_ext)
                {
                    if($('#logo')[0].files[0].size > 512000)
                    {
                        bootbox.alert("File terlalu besar, ukuran maksimal 500KB");
                        return false;
                    } else
                    {
                        return true;                        
                    }
                }
            }
            if(image_file == '')
            {
                return true;
            } else
            {
                bootbox.alert("File dalam format "+final_ext+", format logo harus dalam "+ extensions.join(', ') +".");
                return false;                        
            }
    }
    $(document).ready(function() {
        $('#logo').bootstrapFileInput();
        $('.reset').click(function(event) {
            $('.file-input-name').html('');
        });
    });
</script>