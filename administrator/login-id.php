<?php 
    include("includes/header.php"); 
    cekLogin($param = array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-cog"></i> Login ID</h1>
            <div class="alert alert-success invisible">
            </div>
            <?php
                $sqlID = "SELECT * FROM tb_user WHERE id='$_SESSION[loginID]'";
                $queryID = mysql_query($sqlID);
                $resultID = mysql_fetch_array($queryID);
            ?>
            <div class="loading" style="display:none;"><i class="fa fa-spin fa-spinner fa-4x"></i></div>
            <div class="id-container">
                <div class="detail-container">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Username</td><td>:</td>
                                <td><?php echo $resultID["username"] ?></td>
                            </tr>
                            <tr>
                                <td>Password</td><td>:</td>
                                <td>**********</td>
                            </tr>
                            <tr>
                                <td>User Type</td><td>:</td>
                                <td><?php echo tipeUser($resultID["type"]) ?></td>
                            </tr>
                            <tr>
                                <td>Last Updated</td><td>:</td>
                                <td><?php echo date_format(date_create($resultID["updated_at"]),"d M Y H:i:s") ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary btn-edit"><i class="fa fa-edit"></i> Edit</button>
                </div> 
                <div class="edit-container invisible">
                    <div class="alert alert-warning">
                        <strong>Perhatian!</strong> Anda akan kembali ke halaman login setelah melakukan update.
                    </div>
                    <form role="form" onsubmit="return formSubmit()" class="formEditID">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Username</td><td>:</td>
                                    <td><input class="form-control username" type="text" value="<?php echo $resultID['username'] ?>" required></td><td></td>
                                </tr>
                                <tr>
                                    <td>New Password</td><td>:</td>
                                    <td><input class="form-control password" type="password" placeholder="Password" value="" required></td><td></td>
                                </tr>
                                <tr>
                                    <td>Confirm New Password</td><td>:</td>
                                    <td><input class="form-control c-password" type="password" placeholder="Confirm password" value="" required></td><td></td>
                                </tr>
                                <tr>
                                    <td>User Type</td><td>:</td>
                                    <td>
                                        <?php
                                            if($_SESSION["typeID"]==1)
                                            {
                                                ?>
                                                <select class="form-control userType">
                                                    <option value="1" <?php echo selected($resultID["type"],"1"); ?>>Administrator</option>
                                                    <option value="2" <?php echo selected($resultID["type"],"2"); ?>>Pelamar</option>
                                                    option
                                                </select>
                                                <?php
                                            } else
                                            {
                                                echo tipeUser($resultID["type"]);
                                            }
                                        ?>
                                    </td><td></td>
                                </tr>
                                <tr>
                                    <td>Last Updated</td><td>:</td>
                                    <td><?php echo date_format(date_create($resultID["updated_at"]),"d M Y H:i:s") ?></td><td></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-warning btn-cancel"><i class="fa fa-undo"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary btn-update"><i class="fa fa-check-square-o"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<div class="modal fade" id="modalPassword" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <strong>New Password</strong> dan <strong>Confirm New Password</strong> Anda tidak cocok, silahkan cek kembali.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function formSubmit(){
        if($('.password').val()==$('.c-password').val())
        {
            $.ajax({
                url: 'login-id-update',
                type: 'POST',
                data: {
                    username: $('.username').val(),
                    password: $('.password').val(),
                    userType: $('.userType').val(),
                    auth: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                var timer = 4;
                console.log("success");
                $('.alert-success').html(data+'<strong>5</strong>');
                $('.alert-success').removeClass('invisible').hide().slideDown('400','easeInCirc',function(){
                    setInterval(function(){
                        $('.alert-success').html(data+'<strong>'+timer--+'</strong>');                  
                    },1000);
                    setTimeout(function(){
                        $('.alert-success').slideUp('400','easeOutCirc',function(){
                            window.location.href='index';
                        });
                    },5000);
                });
                $('.edit-container').fadeOut('400',function(){
                    $('.password').val('');
                    $('.c-password').val('');
                    $('.detail-container').fadeIn('400');
                })
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        } else
        {
            $('#modalPassword').modal('show');
        }
        return false;
    }
    $(document).ready(function() {
        $('.id-container').on('click', '.btn-edit', function(event) {
            event.preventDefault();
            $('.detail-container').fadeOut('400', function() {
                $('.edit-container').removeClass('invisible').hide().fadeIn('400');
            });
        });
        $('.id-container').on('click', '.btn-cancel', function(event) {
            event.preventDefault();
            $('.edit-container').fadeOut('400', function() {
                $('.formEditID')[0].reset();
                $('.detail-container').fadeIn('400');
            });
        });
    });
</script>

    