<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["act"]))
    {
        header("Location: halaman-pengumuman");
    }
    $result["judul_pengumuman"] = "";
    $result["pengumuman"] = "";
    $act = "submit";
    if($_GET["act"]=="submit")
    {
        $sql_pengumuman = "INSERT INTO tb_pengumuman(judul_pengumuman,pengumuman,updated_by,updated_at) VALUES('".$_POST["judulPengumuman"]."','".$_POST["isiPengumuman"]."','".$_SESSION["loginID"]."',NOW());";
        $result_pengumuman = mysql_query($sql_pengumuman);
        $id_pengumuman = mysql_fetch_array(mysql_query("SELECT MAX(id) AS no FROM tb_pengumuman"));
        if($result_pengumuman)
        {
            if(isset($_FILES["dokumen"]))
            {
                foreach ($_FILES["dokumen"]["name"] as $index => $value) {
                    $nama["$index"] = $value;
                }
                foreach ($_FILES["dokumen"]["type"] as $index => $value) {
                    $type["$index"] = $value;
                }
                foreach ($_FILES["dokumen"]["tmp_name"] as $index => $value) {
                    $tmp_name["$index"] = $value;
                }
                foreach ($_FILES["dokumen"]["size"] as $index => $value) {
                    $size["$index"] = $value;
                    if(!empty($tmp_name["$index"]))
                    {
                        $nama_file = $_POST["namaFile"]["$index"];
                        $dir = "../img/files/$nama[$index]";
                        move_uploaded_file($tmp_name["$index"], $dir);
                        $query_insert = "INSERT INTO tb_pengumuman_files(id_pengumuman,nama_file,file) VALUES('".$id_pengumuman["no"]."','".$nama_file."','img/files/".$nama["$index"]."')";
                        $result_insert = mysql_query($query_insert);
                    }
                }
            }
            header("Location: halaman-pengumuman");
        }
    }
    if($_GET["act"]=="update")
    {
        $sql = "UPDATE tb_pengumuman SET judul_pengumuman='".$_POST["judulPengumuman"]."',pengumuman='".$_POST["isiPengumuman"]."',updated_by='".$_SESSION["loginID"]."',updated_at=NOW() WHERE id='".$_POST["id"]."'";
        $query = mysql_query($sql);
        if($query)
        {
            if(isset($_FILES["dokumen"]))
            {
                foreach ($_FILES["dokumen"]["name"] as $index => $value) {
                    $nama["$index"] = $value;
                }
                foreach ($_FILES["dokumen"]["type"] as $index => $value) {
                    $type["$index"] = $value;
                }
                foreach ($_FILES["dokumen"]["tmp_name"] as $index => $value) {
                    $tmp_name["$index"] = $value;
                }
                foreach ($_FILES["dokumen"]["size"] as $index => $value) {
                    $size["$index"] = $value;
                    if(!empty($tmp_name["$index"]))
                    {
                        $nama_file = $_POST["namaFile"]["$index"];
                        $dir = "../img/files/$nama[$index]";
                        move_uploaded_file($tmp_name["$index"], $dir);
                        $query_insert = "INSERT INTO tb_pengumuman_files(id_pengumuman,nama_file,file) VALUES('".$_POST["id"]."','".$nama_file."','img/files/".$nama["$index"]."')";
                        $result_insert = mysql_query($query_insert);
                    }
                }
            }
            if(isset($_POST["hapus_file"]))
            {
                foreach ($_POST["hapus_file"] as $value) {
                    $query_files = "SELECT file FROM tb_pengumuman_files WHERE id='$value'";
                    $result_files = mysql_query($query_files);
                    $files = mysql_fetch_array($result_files);
                    unlink("../".$files["file"]);
                    $query_delete_files = "DELETE FROM tb_pengumuman_files WHERE id='$value'";
                    $result_delete = mysql_query($query_delete_files);
                }
            }
            header("Location: halaman-pengumuman");
        }
    }
    if($_GET["act"] == "Edit")
    {
        $act = "update";
        $required = "";
        $sql = "SELECT * FROM tb_pengumuman WHERE id='".$_GET["id"]."'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
    }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Pengumuman</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="halaman-pengumuman">Pengumuman</a></li>
        <li class="active"><?php echo $_GET["act"] ?> Data</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $_GET["act"] ?> Pengumuman</div>
        <div class="panel-body">
            <form action="halaman-pengumuman-form?act=<?php echo $act ?>" method="post" enctype="multipart/form-data" onsubmit="return val()">
            <?php
                if($_GET["act"] == "Edit")
                {
                    echo "<input type='hidden' name='id' value='$_GET[id]'>"; 
                }
            ?>
                <div class="form-group">
                    <label>Judul Pengumuman</label>
                    <input type="text" class="form-control" id="judulPengumuman" name="judulPengumuman" value="<?php echo $result['judul_pengumuman'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Isi Pengumuman</label>
                    <textarea class="form-control" id="isiPengumuman" name="isiPengumuman"><?php echo $result["pengumuman"] ?></textarea>
                </div>
                <?php 
                    if($_GET["act"] == "Edit")
                    {
                        ?>
                        <div class="well">
                            <label>Dokumen Tersimpan</label>
                            <?php
                                $sql_files = "SELECT * FROM tb_pengumuman_files WHERE id_pengumuman='".$_GET["id"]."'";
                                $query_files = mysql_query($sql_files);
                                echo "<script>var counter = 0;</script>";
                                $i = 0;
                                while($result_files = mysql_fetch_array($query_files))
                                {
                                    $dir = explode("/", $result_files["file"]);
                                    echo "<div class='dokumenEksis'>
                                        <input type='hidden' class='idFile' value='$result_files[id]'>
                                        <span onmouseover=\"$(this).tooltip('show')\" data-toggle='tooltip' data-placement='top' data-original-title='Delete file' class='label label-default label-link hapus-file'>x</span> $result_files[nama_file] (".$dir["2"].")
                                    </div>";
                                    echo "<script>counter++;</script>";
                                    $i++;
                                }
                                if($i == 0)
                                {
                                    echo "<br>Tidak ada file.";
                                }
                            ?>
                            <div class="containerHapusDokumen"></div>
                        </div>
                        <?php
                    }
                ?>
                <div class="form-group">
                    <label>Upload Dokumen</label><br>
                    <div class="containerFileDokumen"></div>
                    <a class="label label-default label-link" id="tambahDokumen">Add more file</a>
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
    function val(){
        if(CKEDITOR.instances['isiPengumuman'].getData() == '')
        {
            bootbox.alert("Mohon melengkapi data pengumuman.");
            return false;
        } else
        {
            return true;
        }
    }
    $(document).ready(function() {
        var i = 1;
        CKEDITOR.replace( 'isiPengumuman', {
            toolbar : [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'insert', items: [ 'Table', 'SpecialChar' ] },
                { name: 'styles', items: [ 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor' ] }
            ]
        });
        $('.containerFileDokumen').on('change', '.dokumen', function(event) {
            event.preventDefault();
            $('#tambahDokumen').slideDown('fast','easeInCirc');
            $(this).closest('div').find('#kosongDokumen').fadeIn('fast');
            $(this).closest('div').find('.fileupload-new').hide();
            $(this).closest('div').find('.namaFile').removeAttr('disabled');
            $(this).closest('div').find('.namaFile').focus();
        });
        $('#tambahDokumen').click(function(event) {
            var paramError = 0;
            console.log(paramError);
            $('.namaFile').each(function() {
                var nameValue = $(this).val();
                if(nameValue == '')
                {
                    paramError++;
                }
            });
            if(paramError == 0)
            {
                $('.containerFileDokumen').append('<div class="fileupload fileupload-new" data-provides="fileupload" style="margin-bottom: 5px;"><span style="width:30%; display: inline-block;"><input autocomplete="off" disabled="disabled" placeholder="Nama file..." type="text" style="display: inline-block; border-right: none;" class="form-control namaFile" name="namaFile[]"></span> <input type="file" class="dokumen btn-warning dokumenKe'+i+'" name="dokumen[]"> <span class="label label-danger label-link" id="kosongDokumen">x</span></span></div>');
                $('.dokumenKe'+i).bootstrapFileInput();
                $('#tambahDokumen').slideUp('fast','easeOutCirc');
                i++;                
            }
        });
        $('.containerFileDokumen').on('click', '#kosongDokumen', function(event) {
            event.preventDefault();
            $(this).closest('div').remove();
            $('#tambahDokumen').slideDown('fast','easeInCirc');
        });
        $('.reset').click(function(event) {
            window.location.reload();
        });
        $('.hapus-file').click(function(event) {
            counter--;
            that = $(this).closest('div');
            idFile = that.find('.idFile').val();
            that.remove();
            $('.containerHapusDokumen').append('<input type="hidden" name="hapus_file[]" value="'+idFile+'">');
            if(counter == 0)
            {
                $('.well').append('Tidak ada file.');
            }
        });
    });
</script>