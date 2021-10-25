<?php 
    include("includes/header.php");

    // Select Layanan
    $sql_layanan = "SELECT rekrutmen_dan_seleksi, pelatihan_dan_pengembangan, pengembangan_organisasi, assessment_center, labor_supply, coaching_and_counseling, transportasi_dan_logistik FROM tb_konten_halaman";
    $query_layanan = mysql_query($sql_layanan);
    $profil_layanan = mysql_fetch_array($query_layanan);
?>
<!--==========================
    Page Banner Section
  ============================-->
  <section id="innerBanner"> 
    <div class="inner-content">
      <h2><span>Layanan Kami</span><br>Reach Your Dream with Us.</h2>
      <div> 
      </div>
    </div> 
  </section><!-- #Page Banner -->
  
  <style>
      #about .content i {
          font-size: 1rem;
          color: #444;
      }
  </style>

  <main id="main">
 
    <!--==========================
      About Section
    ============================-->
    <div id="rekrutmen"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Rekrutmen dan Seleksi</h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/051-handshake-colour.svg" alt="">
          </div>

          <div class="col-lg-6 content">
             <p>
			    <?php
                    $rekrutmen = explode("</p>", $profil_layanan["rekrutmen_dan_seleksi"]);
                    echo substr($rekrutmen[0], 3);
                ?>
            </p>
            <p>
                <?php
                    echo substr($rekrutmen[1], 3);
                ?>
            </p>
                <?php
                    echo substr($rekrutmen[2], 3);
                ?>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      About Section
    ============================-->
    <div id="pelatihan"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Pelatihan dan Pengembangan</h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/001-drawkit-content-man-colour.svg" alt="">
          </div>

          <div class="col-lg-6 content">
			 <p>
			    <?php
                    $pelatihan = explode("</p>", $profil_layanan["pelatihan_dan_pengembangan"]);
                    echo substr($pelatihan[0], 3);
                ?>
			 </p>
            <p>
                <?php
                    echo substr($pelatihan[1], 3);
                ?>
            </p>
                <?php
                    echo substr($pelatihan[2], 3);
                ?>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      About Section
    ============================-->
    <div id="pengembangan"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Pengembangan Organisasi</h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/007-revenue-graph-colour.svg" alt="">
          </div>

          <div class="col-lg-6 content">
			 <p>
			    <?php
                    $pengembangan = explode("</p>", $profil_layanan["pengembangan_organisasi"]);
                    echo substr($pengembangan[0], 3);
                ?>
			 </p>
            <p>
                <?php
                    echo substr($pengembangan[1], 3);
                ?>
            </p>
                <?php
                    echo substr($pengembangan[2], 3);
                ?>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      About Section
    ============================-->
    <div id="assessment"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2><i>Assessment Center</i></h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/033-drawkit-charts-and-graphs.svg" alt="">
          </div>

          <div class="col-lg-6 content">
			<p>
			    <?php
			        $assessment = explode("</p>", $profil_layanan["assessment_center"]);
                    echo substr($assessment[0], 3);
                ?>
			</p>
            <p>
                <?php
                    echo substr($assessment[1], 3);
                ?>
            </p>
                <?php
                    echo substr($assessment[2], 3);
                ?>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      About Section
    ============================-->
    <div id="labour"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2><i>Labour Supply</i></h2>
      </div> 
        <div class="row" >
          <div class="col-lg-6 about-img">
            <img src="img/029-drawkit-full-stack-man-colour.svg" alt="">
          </div>

          <div class="col-lg-6 content">
            <p>
                <?php
			        $labor = explode("</p>", $profil_layanan["labor_supply"]);
                    echo substr($labor[0], 3);
                ?>
            </p>
          </div>
        </div>

      </div>
    </section><!-- #about -->

    <!--==========================
      About Section
    ============================-->
    <div id="coaching"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2><i>Coaching and counseling</i></h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/027-drawkit-notebook-man-colour.svg" alt="">
          </div>

          <div class="col-lg-6 content">
		        <p>
		            <?php
    			        $coaching = explode("</p>", $profil_layanan["coaching_and_counseling"]);
                        echo substr($coaching[0], 3);
                    ?>
		        </p>
                <p>
                    <?php
                        echo substr($coaching[1], 3);
                    ?>
                </p>
                <p>
                    <?php
                        echo substr($coaching[2], 3);
                    ?>
                </p>
                <p>
                    <?php
                        echo substr($coaching[3], 3);
                    ?>
                </p>
                <p>
                    <?php
                        echo substr($coaching[4], 3);
                    ?>
                </p>
        </div>
        </div>

      </div>
    </section><!-- #about -->
    
    
    <!--==========================
      About Section
    ============================-->
    <div id="transportasi"></div>
    <section id="about" class="wow fadeInUp">
      <div class="container">
      <div class="section-header">
          <h2>Transportasi dan Logistik</h2>
      </div> 
        <div class="row">
          <div class="col-lg-6 about-img">
            <img src="img/drawkit-transport-scene-11.svg" alt="">
          </div>

          <div class="col-lg-6 content">
		        <p>
		            <?php
    			        $transport = explode("</p>", $profil_layanan["transportasi_dan_logistik"]);
                        echo substr($transport[0], 3);
                    ?>
		        </p>
                <p>
                    <?php
                        echo substr($transport[1], 3);
                    ?>
                </p>
                <p>
                     <?php
                        echo substr($transport[2], 3);
                    ?>
                </p>
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

</script>