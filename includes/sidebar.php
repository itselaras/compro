
<div class="col-md-3">
    <div class="container-sidebar">
        <section class="side-section">
            <!-- login panel -->
            <div class="panel login-panel">
                <div class="panel-heading">Login Form</div>
                <div class="panel-body">
                    <p class="invisible alert-login" style="display:none">
                        <i class="fa fa-exclamation-circle"></i> Kesalahan data login.
                        </p>
                    <input type="hidden" class="status" value="<?php echo $_GET['status'] ?>"/>
                    <form role="form" onsubmit="return formLogin()">
                        <div class="form-group">
                            <label for="username-login">Nama Akun</label>
                            <input type="text" class="form-control username-login" id="username-login" name="username-login" value="<?php echo $_COOKIE['username'] ?>" placeholder="Nama akun" required>
                        </div>
                        <div class="form-group">
                            <label for="password-login">Kata Sandi</label>
                            <input type="password" class="form-control password-login" id="password-login" name="password-login" value="<?php echo $_COOKIE['password'] ?>" placeholder="Kata sandi" required>
                            <div class="checkbox pull-left">
                                <label>
                                    <input class="login-remember" type="checkbox">Ingatkan Saya
                                </label>
                            </div>
                            <a href="#" class="read-more login-forgot pull-right">Lupa kata sandi?</a>
                        </div>
                        <button type="submit" class="btn btn-success btn-block login-button">Masuk</button>
                        <div class="clearfix"></div>
                    </form>

                    <form role="form">
                        <div id="forgot-placer" class="invisible" style="display:none">
                            <div class="form-group">
                                <label for="email-forgot">
                                    Email Terdaftar
                                    <span id="loading-forgot" class="invisible" style="display:none"><i class="fa fa-refresh fa-spin"></i></span>
                                </label>
                                <input type="email" class="form-control email-forgot" id="email-forgot" name="email-forgot" placeholder="Email" required>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block forgot-button">Reset Kata Sandi</button>
                        </div>
                        <div class="alert invisible" id="message-forgot" style="display:none"></div>
                    </form>

                    <div class="panel-group register-accordion">
                        <div class="panel no-border panel-default register-link-panel">
                            <div class="panel-heading register-link-heading text-center">
                                <a data-toggle="collapse" data-parent="#accordion" href="#register-display">
                                    SignUp
                                </a>
                            </div>
                            <div id="register-display" class="panel-collapse collapse register-link">
                                <div class="panel-body register-panel-body">
                                    <p class="text-center">Silahkan melakukan registrasi untuk menjadi member SMI</p>
                                    <a href="register" class="btn btn-success btn-block">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
        