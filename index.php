<?php 
    include("includes/header.php");
    // Select Content
    $sql_konten = "SELECT * FROM tb_konten_halaman";
    $query_konten = mysql_query($sql_konten);
    $profil_konten = mysql_fetch_array($query_konten);
?>

<style>
.mySlides {
    display:none;
    margin: -350px 0 0 -75px;
    box-shadow: 0 24px 28px 0 rgba(0, 0, 0, 0.2), 0 26px 40px 0 rgba(0, 0, 0, 0.19);
}

.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}
</style>

      <!--==========================
    Hero Section
  ============================-->
  <section id="hero" class="clearfix">
  <div class="container">

      <div class="hero-content">
        <h2 style="padding-top: 50px;">Reach Your Dreams<br><span>With Us</span></h2>
      </div>

    </div> 
  </section><!-- #Hero -->

  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
	    <div class="section-header">
          <h2>Tentang Selaras Mitra Integra</h2>
          <p>
                <?php
                    $explode = explode("</p>", $profil_konten["summary"]);
                    echo substr($explode[0], 3);
                ?>                        
            </p>
      </div>
        <div class="row">
          <div class="col-lg-6 about-img">
            <!-- The video -->
            <iframe width="560" height="315" src="https://www.youtube.com/embed/5mh0uvQCvHg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6 content">
			<p>
			    <?php
                    $explode = explode("</p>", $profil_konten["tentang"]);
                    echo substr($explode[0], 3);
                ?>
            </p>
            <p><?php
                    $explode = explode("</p>", $profil_konten["tentang"]);
                    echo substr($explode[1], 3);
                ?></p> 
          </div>
        </div>

      </div>
    </section><!-- #about -->
    
    <!--==========================
      Testimonials Section
    ============================-->
    <section id="about" class="wow fadeInUp">
      <div class="container">
	    <div class="section-header">
          <h2>Filosofi dan Visi Misi</h2>
        </div>
        <div class="row d-flex justify-content-center" style="margin-bottom: 50px;">          
        <div class="col-lg-6 content">
          <h2 class="text-center">Filosofi</h2>            
          <?php echo $profil_konten["filosofi"]; ?>
          </div>
          </div>
          
          <div class="row d-flex justify-content-center">
          <div class="col-lg-6 content">  
          <h2 class="text-center">Visi</h2>            
          <?php echo $profil_konten["visi"]; ?>
          </div>
          </div>
          <div class="row d-flex justify-content-center">
          <div class="col-lg-6 content">  
          <h2 class="text-center">Misi</h2>            
          <?php echo $profil_konten["misi"]; ?>
          </div>
        </div>

      </div>
    </section><!-- #testimonials -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services">
      <div class="container">
        <div class="section-header">
          <h2>Layanan Kami</h2>
        </div>

        <div class="row d-flex justify-content-center">

          <div class="col-lg-4">
            <div class="box wow fadeInLeft">
              <div class="text-center hidden-xs">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Rekrutmen dan Seleksi</a></h4>
              <p class="description">Kami percaya bahwa organisasi membutuhkan sumber daya manusia yang dapat berkembang di dalam organisasi secara produktif. Oleh karenanya, rekrutmen merupakan proses yang penting bagi suatu organisasi untuk mendapatkan orang.</p>
                <a href="layanan.php#rekrutmen" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="box wow fadeInRight">
               <div class="text-center hidden-xs">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-gears fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Pelatihan & Pengembangan</a></h4>
              <p class="description">Pelatihan PT Selaras Mitra Integra didesain berdasarkan kebutuhan perusahaan, karena kami berkeyakinan bahwa pelatihan tersebut dapat menjadi suatu alat yang baik untuk memecahkan masalah spesifik yang dihadapi perusahaan.</p>
              <a href="layanan.php#pelatihan" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
               <div class="text-center hidden-xs">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-sitemap fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Pengembangan Organisasi</a></h4>
              <p class="description">PT Selaras Mitra Integra  yakin bahwa organisasi terdiri dari berbagai individu yang memiliki karakteristik yang unik yang dapat berubah hampir setiap waktu. Karena itu pengembangan organisasi merupakan suatu hal yang terus berjalan.</p>
              <a href="layanan.php#pengembangan" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
               <div class="text-center hidden-xs">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-share-alt fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Assessment Center</a></h4>
              <p class="description">PT Selaras Mitra Integra menggunakan pendekatan holistik untuk menganalisa individu, yang meliputi motif tersembunyi serta perilaku actual, yang diukur dengan alat-alat psikotes yang bervariasi. Standar kami juga termasuk pertemuan para.</p>
              <a href="layanan.php#assessment" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
               <div class="text-center hidden-xs">
               <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-line-chart fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Labour Supply</a></h4>
              <p class="description">PT Selaras Mitra Integra menyediakan layanan  <i>operation business support</i> yang benar-benar disesuaikan dengan kebutuhan organisasi. Tidak hanya sekedar melakukan rekrutmen dan seleksi terhadap karyawan yang akan menjalankan.</p>
              <a href="layanan.php#labour" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
               <div class="text-center hidden-xs">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-share-alt fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Coaching & counseling</a></h4>
              <p class="description">Coaching & counseling adalah kegiatan pengembangan yang difasilitasi oleh perusahaan yang memberikan perhatian ekstra kepada karyawannya. Perbedaan antara kedua kegiatan tersebut bergantung pada alasan mengapa kegiatan tersebut dibutuhkan.</p>
              <a href="layanan.php#coaching" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>
          
          <div class="col-lg-4">
            <div class="box wow fadeInLeft" data-wow-delay="0.2s">
               <div class="text-center hidden-xs">
                                <span class="fa-stack fa-4x">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-share-alt fa-stack-1x fa-inverse"></i>
                                </span>
                    </div>
              <h4 class="title"><a href="">Transportasi dan Logistik</a></h4>
              <p class="description">PT Selaras Mitra Integra memiliki tim dan rekanan dalam pengelolaan transportasi dan logistic yang berpengalaman dan handal. Proses dan unit yang disewa dapat disesuaikan dengan kebutuhan klien, tentunya dengan pengawasan dari tim kami melalui pemeliharaan yang terjadwal dan termonitor dengan baik.</p>
              <a href="layanan.php#transportasi" style="margin-left: 25%;">Selengkapnya</a>
            </div>
          </div>
 
        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Clients Section
    ============================-->
    <section id="clients" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>Klien Kami</h2>
          <p>Klien kami terdiri dari perusahaan-perusahaan terbaik di bidangnya.</p>
        </div>

        <div class="owl-carousel clients-carousel">
          <div class="klien-box">
          <div class="klien-logo" style="background-image : url('img/klien/ahm.png')"></div>
          </div>
          <div class="klien-box">
          <div class="klien-logo" style="background-image : url('img/klien/AI.jpg')"></div>
          </div>
          <div class="klien-box">
          <div class="klien-logo" style="background-image : url('img/klien/djarum.png')"></div>
          </div>
          <div class="klien-box">
          <div class="klien-logo" style="background-image : url('img/klien/UT.png')"></div>
          </div>
          <div class="klien-box">
          <div class="klien-logo" style="background-image : url('img/klien/TMMIN.jpg')"></div>
          </div>
          <div class="klien-box">
          <div class="klien-logo" style="background-image : url('img/klien/transcorp.png')"></div>
          </div>
        </div>
        <a href="klien.php" class="btn btn-outline-light mt-4" style="margin-left: 45%;">Selengkapnya</a>

      </div>
    </section><!-- #clients --> 
    
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

    $(document).ready(function() {
    });

    $(function() {
        $('#da-slider').cslider({
            autoplay    : true,
            bgincrement : 450
        });
    });
</script>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 4000); // Change image every 2 seconds
}
</script>