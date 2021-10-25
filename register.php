<?php 
    include("includes/header.php");
?>
    <div class="container container-index">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Register Section -->
                <section id="register">
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="section-heading">Register</h2>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 register-placer">
                                <div class="register-form">
                                    <form class="form-horizontal" role="form" onsubmit="return formAddAccount()">
                                        <div class="register-form-heading">
                                            <h5>Data Akun</h5>
                                        </div>
                                        <div class="register-form-body">
                                            <div class="form-group">
                                                <label for="register-username" class="col-sm-3 control-label required">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="register-username" placeholder="Username" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="register-email" class="col-sm-3 control-label required">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="register-email" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="register-password" class="col-sm-3 control-label required">Kata Kunci</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="register-password" placeholder="Kata Kunci" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="register-retype-password" class="col-sm-3 control-label required">Ulangi Kata Kunci</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="register-retype-password" placeholder="Ulangi Kata Kunci" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="register-form-footer">
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <a href="index" class="btn btn-default">Batal</a>
                                                    <button type="reset" class="btn btn-default">Reset</button>
                                                    <button type="submit" class="btn btn-success">Daftar</button>
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
            <?php 
                // include("includes/sidebar.php"); 
            ?>
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
                    <div class="col-xs-1 text-right">
                        <i class="fa fa-info-circle fa-3x"></i>
                    </div>
                    <div class="col-xs-10">
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

    function formAddAccount(){
        if($('#register-password').val()==$('#register-retype-password').val())
        {
            $('.console-placer').html('<img src="img/load.gif"><br><h5>Please wait . . .</h5>');
            $('#modalPassword').modal('show');
            $.ajax({
                url: 'akun-manage',
                type: 'POST',
                data: {
                    username: $('#register-username').val(),
                    email: $('#register-email').val(),
                    password: $('#register-password').val(),
                    action: 'insert'
                },
            })
            .done(function(data) {
                // console.log("success");
                if(data == 'failed'){
                    $('.console-placer').html('');
                    $('.console-placer').html('Update data <strong>gagal</strong>.<br>Silahkan coba lagi.');
                }else if(data == 'incorrect'){
                    $('.console-placer').html('');
                    $('.console-placer').html('<strong>Email</strong> telah terpakai.<br>Silahkan coba lagi.');
                }else{
                    $.ajax({
                        url: 'akun-manage',
                        type: 'POST',
                        data: {
                            email: $('#register-email').val(),
                            username: $('#register-username').val(),
                            password: $('#register-password').val(),
                            message: 'Anda telah terdaftar sebagai member Selaras Mitra Integra.',
                            action: 'send-email'
                        },
                    })
                    .done(function(data_email) {
                        // console.log("success");
                        $('.console-placer').html('');
                        $('.console-placer').html('Pendaftaran akun berhasil.<br> Silahkan <strong>Login</strong> untuk mengisi data lamaran.<br><br>'+data_email);
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
                    
                };
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
        } else
        {
            $('.console-placer').html('<strong>Password</strong> tidak sesuai.<br>Silahkan cek kembali.');
            $('#modalPassword').modal('show');
        }
        return false;
    }

    $(document).ready(function() {
        
    });
</script>