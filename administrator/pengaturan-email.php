<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-wrench"></i> Pengaturan Email</h1>
        </div>
    </div>
    <?php
        if((isset($_POST["email"]))&&(isset($_POST["password"])))
        {
            $sql = "SELECT * FROM tb_email";
            $query = mysql_query($sql);
            $isExist = mysql_num_rows($query);
            if($isExist == 0)
            {
                $sql = "INSERT INTO tb_email(email,password_email,status) VALUES('".$_POST["email"]."','".$_POST["password"]."','1')";
            } else
            {
                $sql = "UPDATE tb_email SET email='".$_POST["email"]."',password_email='".$_POST["password"]."',status='1'";
            }
            $query = mysql_query($sql);
            unset($_POST["email"]);
            unset($_POST["password"]);
        }
        $sql = "SELECT email,status FROM tb_email";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);
    ?>
    <h4><i class="fa fa-envelope"></i> Email aktif : <span style="color: #357ebd;"><?php echo $result["email"]==""?"Belum ditentukan.":$result["email"]; ?></span></h4>
    <button type="button" class="btn btn-primary btn-sm btn-toggle"><i class="fa fa-edit fa-fw"></i> Ganti</button>
    <br><br>
    <div class="panel panel-default form-container invisible">
        <div class="panel-body">
            <form action="pengaturan-email" method="post">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="c_password" class="form-control c_password" required>
                </div>
                <button type="button" class="btn btn-danger btn-cek">Cek</button>
                <button type="submit" class="btn btn-primary btn-simpan" disabled="disabled">Simpan</button>
            </form>        
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-toggle').click(function(event) {
            $('.form-container').toggle('slow');
        });
        $('.form-control').keyup(function(event) {
            $('.btn-simpan').attr('disabled', 'disabled');
        });
        $('.btn-cek').click(function(event) {
            email = $('.email').val();
            pass = $('.password').val();
            cPass = $('.c_password').val();
            if(email == '' || pass == '' || cPass == '')
            {
                bootbox.alert('Mohon melengkapi form yang telah disediakan.')
            } else if(pass != cPass)
            {
                bootbox.alert('Konfirmasi password tidak cocok.');
            } else
            {
                $('#modal-loading').find('.loading-container').html('Checking...');
                $('#modal-loading').modal('show');
                $.ajax({
                    url: 'pengaturan-email-cek',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        email: email,
                        password: pass
                    },
                })
                .done(function(data) {
                    console.log("success");
                    if(data == 1)
                    {
                        $('#modal-loading').find('.loading-container').html('Autentikasi berhasil.');
                        $('.btn-simpan').removeAttr('disabled');
                    } else
                    {
                        Error.show('Akun email tidak valid.');
                    }
                    setTimeout(function(){
                        $('#modal-loading').modal('hide');
                    },2000)
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });
    });
</script>

    