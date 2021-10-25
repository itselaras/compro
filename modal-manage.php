<?php
	include("administrator/includes/connection.php");

	switch ($_POST["action"]) {
		case 'galeri-view':

			$sql_galeri = "SELECT *,DATE_FORMAT(updated_at,'%m-%d-%Y') AS updated_at FROM tb_galeri WHERE id = '$_POST[idGaleri]'";
            $query_galeri = mysql_query($sql_galeri);
            $result_galeri = mysql_fetch_array($query_galeri);
            if ($result_galeri['image'] == '') {
                $image = "img/no-image.jpg";
            }else{
                $image = $result_galeri['image'];
            }
            ?>

        	<h2 class="portfolio-modal-tittle"><?php echo $result_galeri['judul'] ?></h2>
            <p class="text-muted read-more"><i class="fa fa-calendar"></i> Posted on <?php echo $result_galeri['updated_at'] ?></p>
            <img class="img-responsive" src="<?php echo $image ?>" alt="">
            <p><?php echo $result_galeri['deskripsi'] ?></p>
            <button type="button" class="btn btn-primary btn-xl" data-dismiss="modal">Close Galeri</button>

            <?php

			break;
		
		default:
			# code...
			break;
	}
?>