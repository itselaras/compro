<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["act"]))
    {
        header("Location: halaman-agenda");
    }
    $result["judul"] = "";
    $result["deskripsi"] = "";
    $act = "submit";
    if($_GET["act"]=="submit")
    {
        $sql = "INSERT INTO tb_agenda(judul,deskripsi,updated_by,updated_at) VALUES('".$_POST["judul"]."','".$_POST["deskripsi"]."','".$_SESSION["loginID"]."',NOW())";
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: halaman-agenda");
        }
    }
    if($_GET["act"]=="update")
    {
        $sql = "UPDATE tb_agenda SET judul='".$_POST["judul"]."',deskripsi='".$_POST["deskripsi"]."',updated_by='".$_SESSION["loginID"]."',updated_at=NOW() WHERE id='".$_POST["id"]."'";
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: halaman-agenda");
        }
    }
    if($_GET["act"] == "Edit")
    {
        $act = "update";
        $required = "";
        $sql = "SELECT * FROM tb_agenda WHERE id='".$_GET["id"]."'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
    }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Agenda</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="halaman-agenda">Agenda</a></li>
        <li class="active"><?php echo $_GET["act"] ?> Data</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo $_GET["act"] ?> Agenda</div>
        <div class="panel-body">
            <form action="halaman-agenda-form?act=<?php echo $act ?>" method="post" onsubmit="return val()">
            <?php
                if($_GET["act"] == "Edit")
                {
                    echo "<input type='hidden' name='id' value='$_GET[id]'>"; 
                }
            ?>
                <div class="form-group">
                    <label>Judul Agenda</label>
                    <input type="text" class="form-control" name="judul" value="<?php echo $result['judul'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5"><?php echo $result["deskripsi"] ?></textarea>
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
        if(CKEDITOR.instances['deskripsi'].getData() == '')
        {
            bootbox.alert("Mohon melengkapi data deskripsi.");
            return false;
        } else
        {
            return true;
        }
    }
    $(document).ready(function() {
        CKEDITOR.replace( 'deskripsi', {
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
    });
</script>