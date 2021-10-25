<?php 
    include("includes/header.php");
?>
<!--==========================
    Page Banner Section
  ============================-->
  <section id="innerBanner"> 
    <div class="inner-content">
      <h2><span>Klien Kami</span><br>Reach Your Dream with Us.</h2>
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
      <div class="row">
          <?php 
            // Select Client
            $sql = "SELECT * FROM tb_klien ORDER BY perusahaan ASC";
            $query = mysql_query($sql);
            $count = mysql_num_rows($query);
             $i=1;
            while ($klien = mysql_fetch_array($query)) {
                if ($klien['logo'] == '') {
                    $logo = "img/no-image.jpg";
                }else{
                    $logo = $klien['logo'];
                }
                ?>
            <div class="col-sm-3 col-xs-6 klien-item">
                    <div class="klien-item-placer">  
                        <!-- <a href="klien-detail?display=73" class="klien-box"> -->
                        <a href="#" data-nama="<?php echo $klien['perusahaan']; ?>" data-logo="<?php echo $logo; ?>" class="klien-box">
                            <div class="klien-logo" style="background-image: url('<?php echo $logo; ?>');"></div>
                        </a>
                        <div class="klien-caption text-center">
                            <?php echo $klien['perusahaan']; ?>                                                </div>
                    </div>
                </div>
                <?php
                                        $i++;
                                        if ($i == 5) {
                                            echo "</div><div class='row'>";
                                            $i=1;
                                        }
                                    }
                    ?>
                
                                                        
                
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
    $(document).ready(function() {
        $('.klien-item-placer').on('click', '.klien-box', function(event) {
            event.preventDefault();
            $('#klien-modal-nama').html($(this).data('nama'));
            $('#klien-modal-image').html('<div style="height:200px; background-position: center; background-size: contain; background-repeat: no-repeat; background-image: url(\''+$(this).data('logo')+'\')"></div>');
            $('#modal-klien').modal('show');
        });
    });
</script>