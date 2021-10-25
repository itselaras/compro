<?php 
    include("includes/header.php");
    
    set_time_limit(0);
    cekLogin(array('1','2'));
?>
    <div class="container container-index">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Akun Section -->
                <section id="akun">
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="section-heading">Konfigurasi Akun</h2>
                                <hr class="heading-line">
                            </div>
                            <div class="col-md-12 ">
                                <div class="alert alert-info">
                                    <strong>Perhatian!</strong> Akun akan log out otomatis setelah Anda melakukan perubahan.
                                </div>
                                <div class="alert alert-success invisible" style="display:none"></div>
                            </div>
                        </div>
                        <?php
                            $sqlID = "SELECT a.*, b.email FROM tb_user a LEFT JOIN tb_pelamar b ON b.id_user = a.id WHERE a.id='$_SESSION[loginID]'";
                            $queryID = mysql_query($sqlID);
                            $resultID = mysql_fetch_array($queryID);
                        ?>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 akun-placer">
                                <div class="akun-form">
                                    <form class="form-horizontal edit-username" role="form" onsubmit="return formEditAccount()">
                                        <div class="akun-form-heading">
                                            <h4>Data Akun</h4>
                                        </div>
                                        <div class="akun-form-body">
                                            <div class="form-group">
                                                <label for="akun-username" class="col-sm-4 control-label required">Username</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="akun-username" placeholder="Username" value="<?php echo $resultID['username'] ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="akun-email" class="col-sm-4 control-label required">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" class="form-control" id="akun-email" placeholder="Email" value="<?php echo $resultID['email'] ?>">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="akun-password" class="col-sm-4 control-label required">Kata Kunci Baru</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="akun-password" placeholder="Kata Kunci Baru">
                                                    <small><i>(Kosongkan jika kata kunci tidak diganti)</i></small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="akun-retype-password" class="col-sm-4 control-label required">Ulangi Kata Kunci Baru</label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="akun-retype-password" placeholder="Ulangi Kata Kunci">
                                                    <small><i>(Kosongkan jika kata kunci tidak diganti)</i></small>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="akun-password" class="col-sm-4 control-label required">Kata Kunci Lama <span class="uppercase-text">*</span></label>
                                                <div class="col-sm-8">
                                                    <input type="password" class="form-control" id="akun-password-lama" placeholder="Kata Kunci Lama" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="akun-form-footer">
                                            <div class="form-group">
                                                <div class="col-sm-offset-4 col-sm-8">
                                                    <a href="index" class="btn btn-default">Batal</a>
                                                    <button type="reset" id="reset-username-button" class="btn btn-default">Reset</button>
                                                    <button type="submit" id="edit-username-button" class="btn btn-success">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>

<!-- MODAL CONFIRM -->
<div class="modal fade confirm-modal" id="modalPassword" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-1 col-xs-offset-2 text-right">
                        <i class="fa fa-info-circle fa-3x"></i>
                    </div>
                    <div class="col-xs-8">
                        <p class="console-placer"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    function formEditAccount(){
        if($('#akun-password').val()==$('#akun-retype-password').val()){
            $('.console-placer').html('<img src="img/load.gif"><br><h5>Please wait . . .</h5>');
            $('#modalPassword').modal('show');
            $.ajax({
                url: 'akun-manage',
                type: 'POST',
                data: {
                    username: $('#akun-username').val(),
                    email: $('#akun-email').val(),
                    password: $('#akun-password').val(),
                    passwordLama: $('#akun-password-lama').val(),
                    action: 'update',
                    auth: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                if (data == 'success') {
                    $.ajax({
                        url: 'akun-manage',
                        type: 'POST',
                        data: {
                            email: $('#akun-email').val(),
                            username: $('#akun-username').val(),
                            password: $('#akun-password').val(),
                            message: 'Informasi perubahan account Anda di Selaras Mitra Integra.',
                            action: 'send-email'
                        },
                    })
                    .done(function(data_email) {
                        // console.log("success");
                        $('.console-placer').html('');
                        $('.console-placer').html('Update data berhasil.<br> Silahkan <strong>login</strong> kembali dengan data baru.<br><br>'+data_email);
                        $(document).on('hide.bs.modal','#modalPassword', function () {
                            window.location.href='index';
                        });
                    })
                    .fail(function() {
                        // console.log("error");
                    })
                    .always(function() {
                        // console.log("complete");
                    });
                }else{
                    $('.console-placer').html('');
                    $('.console-placer').html(data);
                };
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
        }else{
            $('.console-placer').html('<strong>Kata Kunci Baru</strong> dan <strong>Pengulangan Kata Kunci</strong> tidak cocok.<br>Silahkan periksa kembali.');
            $('#modalPassword').modal('show');
        }
        return false;
    }

    $(document).ready(function() {
        
    });
</script>