<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["act"]))
    {
        header("Location: halaman-galeri");
    }
    $result["nama"] = "";
    $result["deskripsi"] = "";
    $result["image"] = "";
    $extGambar = "";
    $act = "submit";
    $required = "required";
    if($_GET["act"]=="submit")
    {
        $move = move_uploaded_file($_FILES["gambar"]["tmp_name"], "../img/".$_FILES["gambar"]["name"]);
        if($move)
        {
            $sql = "INSERT INTO tbl_image(nama,lokasi,deskripsi) VALUES('".$_POST["nama"]."','img/".$_FILES["gambar"]["name"]."','".$_POST["deskripsi"]."')";
            $query = mysql_query($sql);
            if($query)
            {
                header("Location: halaman-galeri");
            }
        }
    }
    if($_GET["act"]=="update")
    {
        $gambar = explode("/", $_POST["gambarLama"]);
        if($gambar[2] != $_FILES["gambar"]["name"] && $_FILES["gambar"]["name"] != "")
        {
            unlink($_POST["gambarLama"]);
            move_uploaded_file($_FILES["gambar"]["tmp_name"], "../img/".$_FILES["gambar"]["name"]);
            $gambar[2] = $_FILES["gambar"]["name"];
        }
        $sql = "UPDATE tbl_image SET nama='".$_POST["nama"]."',deskripsi='".$_POST["deskripsi"]."',lokasi="."'img/".$gambar[2]."' WHERE id='".$_POST["id"]."'";
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: halaman-galeri");
        }
    }
    if($_GET["act"] == "Edit")
    {
        $act = "update";
        $required = "";
        $sql = "SELECT * FROM tbl_image WHERE id='".$_GET["id"]."'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
    }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Galeri</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="halaman-galeri">Galeri</a></li>
        <li class="active"><?php echo $_GET["act"] ?> Data</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $_GET["act"] ?> Galeri</div>
        <div class="panel-body">
            <form action="halaman-galeri-form?act=<?php echo $act ?>" method="post" enctype="multipart/form-data" onsubmit="return cekForm()">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $result['nama'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="5"><?php echo $result["deskripsi"] ?></textarea>
                </div>
                <?php
                    if($_GET["act"] == "Edit")
                    {                    
                        echo "<label>Gambar Lama</label><br>
                        <input type='hidden' name='gambarLama' value='../$result[lokasi]'> 
                        <input type='hidden' name='id' value='$_GET[id]'> 
                        <img src='../$result[lokasi]' class='img-thumbnail' width='30%'><br><br>";
                        $extGambar = "Baru";
                    }
                ?>
                <div class="form-group">
                    <label>Gambar <?php echo $extGambar ?></label><br>
                    <input type="file" class="btn btn-warning" id="gambar" name="gambar" <?php echo $required ?>>
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
            var image_file = $('#gambar').val();
            var image_length = $('#gambar').val().length;
            var pos = image_file.lastIndexOf('.') + 1;
            var ext = image_file.substring(pos, image_length);
            var final_ext = ext.toLowerCase();
            for (i = 0; i < extensions.length; i++)
            {
                if(extensions[i] == final_ext)
                {
                    if($('#gambar')[0].files[0].size > 512000)
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
                bootbox.alert("File dalam format "+final_ext+", format gambar harus dalam "+ extensions.join(', ') +".");
                return false;                        
            }
    }
    $(document).ready(function() {
        $('#gambar').bootstrapFileInput();
        $('.reset').click(function(event) {
            $('.file-input-name').html('');
        });
    });
</script>