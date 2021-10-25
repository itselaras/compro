<?php 
    include("includes/header.php");
?>
<style>
.mySlides {
    display:none;
    margin: -350px 0 0 -75px;
    box-shadow: 0 24px 28px 0 rgba(0, 0, 0, 0.2), 0 26px 40px 0 rgba(0, 0, 0, 0.19);
}

.w3-left, .w3-right, .w3-badge {cursor:pointer}
.w3-badge {height:13px;width:13px;padding:0}

.thumbnail {
    height: 400px;
    overflow:hidden;
}

</style>

<script>
    document.addEventListener( 'DOMContentLoaded', function () {
     new Splide( '.splide', {
        	type   : 'loop',
        	perPage: 6,
        	perMove: 1,
        } ).mount();
    } );

</script>
<!--==========================
    Page Banner Section
  ============================-->
  <section id="innerBanner"> 
    <div class="inner-content">
      <h2><span>Galeri</span><br>Reach Your Dream with Us.</h2>
      <div> 
      </div>
    </div> 
  </section><!-- #Page Banner -->

  <main id="main">
      
    <!--==========================
      About Section
    ============================-->
    <section id="about" class="wow fadeInUp" style="position:relative; top: 0px; bottom: 200px;">
      <div class="container">
        <div class="text-center col-sm-6" style="
            height: 400px;
            overflow: hidden;
            margin: auto;
            box-shadow: 0 24px 28px 0 rgba(0, 0, 0, 0.2), 0 26px 40px 0 rgba(0, 0, 0, 0.19);
            border-radius: 15px;">
            <?php 
            // Select Client
            $sql = "SELECT * FROM tbl_image";
            $query = mysql_query($sql);
            $count = mysql_num_rows($query);
            while ($galeri = mysql_fetch_array($query)) {
                if ($galeri['lokasi'] == '') {
                    $logo = "img/no-image.jpg";
                }else{
                    $logo = $galeri['lokasi'];
                }
            ?>
            <img class="mySlides" src="<?php echo $logo;?>">
            <?php
                }
            ?>
         </div>
         <div class="splide" style="margin-top: 100px; height:200px;">
        	<div class="splide__track">
        		<ul class="splide__list">
        		    <?php
                        $i=1;
                        // Select Client
                        $sql = "SELECT * FROM tbl_image";
                        $query = mysql_query($sql);
                        $count = mysql_num_rows($query);    
                      while ($galeri = mysql_fetch_array($query)) {
                        if ($galeri['lokasi'] == '') {
                            $logo = "img/no-image.jpg";
                        }else{
                            $logo = $galeri['lokasi'];
                        }
                    ?>
                        <li class="splide__slide">
                            <div class="slide thumbnail">
                                <img class="demo w3-opacity w3-hover-opacity-off" src="<?php echo $logo;?>" style="width:100%;cursor:pointer;padding:0 20px;" onclick="<?php echo 'currentDiv('.$i.')';?>">
                            </div>
                        </li>
                    <?php
                            $i++;
                        }
                    ?>
        		</ul>
        	</div>
        </div>
           
          </div>
        </div>
    </section>
    
    <!--==========================
      Call To Action Section
    ============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
       <div class="prev" onclick="plusDivs(-1)">&#10094;</div>
            <div class="next" onclick="plusDivs(1)">&#10095;</div>
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
          }
    });
</script>

<script>
var slideIndex = 1;
function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}

</script>