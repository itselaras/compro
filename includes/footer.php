
    <footer>
        <?php
            // Select About
            $sql_perusahaan = "SELECT tentang FROM tb_konten_halaman";
            $query_perusahaan = mysql_query($sql_perusahaan);
            $profil_perusahaan = mysql_fetch_array($query_perusahaan);

            // Select Kontak
            $sql_kontak = "SELECT website,email,telepon,alamat FROM tb_kontak WHERE tipe_office = 1";
            $query_kontak = mysql_query($sql_kontak);
            $profil_kontak = mysql_fetch_array($query_kontak);
        ?>
  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
    <h5 style="padding-top: 20px; margin-bottom: 10px;" class="text-center">Social Media</h5>
    <div class="row">
    <div class="col-md-12 text-center">
                    <a target="_blank" href="https://www.instagram.com/selarasmitraintegra/"><img class="img-fluid" style="width: 70px;" src="img/instagram_logo.png"></a>
                    <a target="_blank" href="https://twitter.com/selaras_mitra"><img class="img-fluid" style="width: 50px;" src="img/twitter_logo.png"></a>
                    <a target="_blank" href="https://www.linkedin.com/company/pt-selarasmitraintegra"><img class="img-fluid" style="width: 60px;" src="img/linked-in_logo3.png"></a>
    </div>
    <div class="col-md-12 text-center">
      <div class="copyright">
        Copyright &copy; 2021 Made By <strong>SMI IT Team</strong>.
      </div>
    </div>
    </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript  -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script> 
 <script src="contact/jqBootstrapValidation.js"></script>
 <script src="contact/contact_me.js"></script>
  <script src="js/main.js"></script>
  <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
  
  
<script>
    $(document).ready(function () {
            $(function() {
            var path = window.location.href; // Mengambil data URL pada Address bar
            $('.nav-menu li').each(function() {
                // Jika URL pada menu ini sama persis dengan path...
                if (this.firstChild.href === path) {
                    // Tambahkan kelas "active" pada menu ini
                    console.log(this.firstChild.href);
                    $(this).addClass('menu-active');
                    
                }
            });
        });
    });
</script>


</body>
</html>


<script type="text/javascript">

    function formLogin()
    {
        var placer = $('body').find('.login-panel');
        if(placer.find('.login-remember').is(':checked'))
        {
            remember = 1;
        } else
        {
            remember = 0;
        }
        $.ajax({
            url: 'login.php',
            type: 'POST',
            dataType: 'json',
            data: {
                username: placer.find('#username-login').val(),
                password: placer.find('#password-login').val(),
                url: "/",
                remember: remember
            },
        })
        .done(function(data) {
            console.log("success");
            if(data.auth==0)
            {
                placer.find('.alert-login').removeClass('invisible').slideDown('fast', function(){
                    setTimeout(function() {
                        placer.find('.alert-login').slideUp('fast');
                    }, 5000);
                });
            } else
            {
                window.location.href=data.auth;
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        return false;
    }

    $(document).ready(function() {
        status = $('body').find('.status').val();
        if((status == 'logout')&&($('body').find('.password-login').val()!=''))
        {
            $('body').find('.login-remember').prop('checked', 'checked');
        } else if(($('body').find('.username-login').val()!='')&&($('body').find('.password-login').val()!=''))
        {
            $('body').find('.login-remember').prop('checked', 'checked');
            $('body').find('.login-button').click();
        }

        $('body').on('click', '.logout', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'administrator/logout.php',
                dataType: 'json'
            })
            .done(function(data) {
                console.log("success");
                window.location.href=data.url;
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });

        $('body').on('click', '.login-forgot', function(event) {
            event.preventDefault();
            $('#forgot-placer').removeClass('invisible').slideDown('medium');
        });

        $('body').on('click', '.forgot-button', function(event) {
            event.preventDefault();
            var that = $(this);
            that.attr('disabled', 'disabled');
            $('#message-forgot').addClass('invisible').css('display', 'none');
            $('#loading-forgot').removeClass('invisible').fadeIn('medium');
            $.ajax({
                url: 'akun-manage',
                type: 'POST',
                data: {
                    email: $('#email-forgot').val(),
                    action: 'forgot'
                },
            })
            .done(function(data) {
                console.log("success");
                $('#message-forgot').html(data);
                $('#message-forgot').removeClass('invisible').slideDown('medium', function(){
                    setTimeout(function() {
                        $('#message-forgot').slideUp('fast');
                    }, 5000);
                });
                $('#loading-forgot').addClass('invisible').fadeOut('medium');
                that.removeAttr('disabled');
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
            
        });
    });
    
    const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    function switchTheme(e) {
        if (e.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
        else {
            document.documentElement.setAttribute('data-theme', 'light');
        }    
    }
    toggleSwitch.addEventListener('change', switchTheme, false);
</script>

<!-- Splide -->
  <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
