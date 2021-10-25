<?php 
    include("includes/header.php");

    // Select About
    $sql_head = "SELECT * FROM tb_kontak WHERE tipe_office = 1";
    $query_head = mysql_query($sql_head);
    $profil_head = mysql_fetch_array($query_head);
    
    $sql_kontak = "SELECT * FROM tb_kontak";
    $query_kontak = mysql_query($sql_kontak);
    $profil_kontak = mysql_fetch_array($query_kontak);

    if (isset($_SESSION['pelamarID'])) {
        $sql_pelamar = "SELECT * FROM tb_pelamar WHERE id = '$_SESSION[pelamarID]'";
        $query_pelamar = mysql_query($sql_pelamar);
        $detail_pelamar = mysql_fetch_array($query_pelamar);
        $email_value = $detail_pelamar['email'];
        $status_field_email = 'readonly';
        $pelamar_value = $_SESSION['pelamarID'];
    }else{
        $pelamar_value = '';
        $email_value = '';
        $status_field_email = '';
    }
?>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

<!--==========================
    Page Banner Section
  ============================-->
  <section id="innerBanner"> 
    <div class="inner-content">
      <h2><span>Kontak Kami</span><br>Reach Your Dream with Us.</h2>
      <div> 
      </div>
    </div> 
  </section><!-- #Page Banner -->

  <main id="main">
 
    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Kontak</h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/edit sky 1.png" alt="">
          </div>

          <div class="col-lg-6 content">
            <h2>Head Office</h2>
            <p>Alamat </br>
            <?php echo $profil_kontak["alamat"];?></p>
            <p>Email </br>
            <?php echo $profil_kontak["email"];?></p>
            <p>Website </br>
            <?php echo $profil_kontak["website"];?></p>
            <p>Telepon </br>
            <?php echo $profil_kontak["telepon"];?></p>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Hubungi Kami</h2>
      </div> 
        <div class="row">
          <div class="col-lg-4 about-img">
            <img src="img/053-holding-phone-colour.svg" alt="">
          </div>

          <div class="col-lg-8 content">
            <div class="form-group">
                <label for="exampleFormControlInput1">Email :</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Pesan :</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
                </div>
                    <button type="button" class="btn btn-primary btn-lg btn-block">Kirim</button>
            </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
          <h3 class="cta-title">Dapatkan Layanan Kami</h3>
            <p class="cta-text">Mari merajut Nusantara, bersama dalam keberagaman</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="kontak.php">Contact Us</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->
 

  </main>

<?php include("includes/footer.php") ?>

<script type="text/javascript">

    function initialize() {
        var myLatlng = new google.maps.LatLng(-7.31529, 112.72262);
        var mapOptions = {
            zoom: 17,
            center: myLatlng,
            scaleControl: true,
            panControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Selaras Mitra Integra</h1>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Selaras Mitra Integra (Surabaya)'
        });
      
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    function sendMessage(){
        var auth_val = '<?php echo $pelamar_value ?>';
        $('#notif-message').find('i').removeClass('fa-check-square').addClass('fa-circle-o-notch fa-spin');
        $('#notif-message').find('span').html('Mengirim pesan . . .');
        $('#notif-message').removeClass('invisible').fadeIn('medium');
        $.ajax({
            url: 'pesan-manage',
            type: 'POST',
            data: {
                email: $('#email').val(),
                message: $('#message').val(),
                auth: auth_val
            },
        })
        .done(function(data) {
            if (data = 'success') {
                $('#notif-message').find('i').removeClass('fa-circle-o-notch fa-spin').addClass('fa-check-square');
                $('#notif-message').find('span').html('');
                $('#notif-message').find('span').html('Pesan terkirim');
                if (auth_val=='') {
                    $('#email').val('');
                };
                $('#message').val('');
                setTimeout(function(){
                    $('#notif-message').fadeOut('medium');
                }, 7000);
            };
            // console.log("success");
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    $(document).ready(function() {

    });
</script>