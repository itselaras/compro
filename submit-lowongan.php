<?php
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");

	$action = $_POST["action"];

	switch ($action) {

		case 'display_status':
			if ($_POST['pelamar_id']!='') {
				$sqlSelect = "SELECT *,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal_apply FROM tb_rekrutmen WHERE id_pelamar = '$_SESSION[pelamarID]' AND id_lowongan = '$_POST[lowongan_id]'";
				$querySelect = mysql_query($sqlSelect);
				$countSelect = mysql_num_rows($querySelect);
				if ($countSelect<1) {
					?>
	                <a href="#" class="btn btn-lg btn-primary submit-apply reg-apply">Apply</a>
	                <div class="clearfix"></div>
					<?php
				}else{
					$resultSelect = mysql_fetch_array($querySelect);
					?>
					<div class="status">
						<div class="row">
							<div class="col-sm-3 col-xs-12 category"><b>Keterangan</b></div>
	                        <div class="col-sm-9 col-xs-12 value-category">SUDAH TERDAFTAR</div>
	                        <div class="col-sm-3 col-xs-12 category"><b>Tanggal Apply</b></div>
	                        <div class="col-sm-9 col-xs-12 value-category"><?php echo $resultSelect['tanggal_apply'] ?></div>
	                        <!-- <div class="col-sm-3 col-xs-12 category"><b>Status</b></div> -->
	                        <!-- <div class="col-sm-9 col-xs-12 value-category"><?php echo ($resultSelect['status']==0) ? 'PROSES SELEKSI' : 'DITOLAK' ; ?></div> -->
	                    </div>
					</div>
					<?php
				}
			}else{
				?>
                <a href="#" class="btn btn-lg btn-primary submit-apply dot-apply">Apply</a>
                <div class="clearfix"></div>
				<?php
			}
			break;

		case 'insert':

			$auth = authByID($_SESSION["loginID"]);

			if($auth == 0){
				$sqlSelect = "SELECT * FROM tb_rekrutmen WHERE id_pelamar = '$_SESSION[pelamarID]' AND id_lowongan = '$_POST[lowongan_id]'";
				$querySelect = mysql_query($sqlSelect);
				$countSelect = mysql_num_rows($querySelect);

				if ($countSelect<1) {
					$sqlInsert = "INSERT INTO tb_rekrutmen (id_lowongan, id_pelamar, tanggal)
					VALUES ('$_POST[lowongan_id]', '$_SESSION[pelamarID]', CURDATE())";
					if (mysql_query($sqlInsert)) {
						echo "success";	
					}
				}else{
					echo "exist";
				}
			}
			break;
		
		default:
			# code...
			break;
	}
?>