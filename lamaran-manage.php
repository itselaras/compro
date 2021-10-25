<?php
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");

	$action = $_POST["action"];

	$auth = authByID($_POST["login"]);

	switch ($action) {
		case 'identitas':

			if ($auth == 0){

				$sqlID = "SELECT id FROM tb_pelamar WHERE id_user='$_POST[login]'";
	            $queryID = mysql_query($sqlID);
	            $resultID = mysql_num_rows($queryID);

				if ($resultID <= 0) {

					// INSERT
					$sql = "INSERT INTO tb_pelamar (
						id_user, 
						nama_lengkap, 
						nama_panggilan, 
						tempat_lahir, 
						tgl_lahir, 
						jenis_kelamin, 
						alamat, 
						negara_id, 
						provinsi_id, 
						kota_id, 
						kode_pos, 
						telepon, 
						hp, 
						email, 
						agama, 
						jenis_identitas, 
						no_identitas
					)
					VALUES ( 
						'".$_POST["login"]."', 
						'".strtoupper($_POST["namaLengkap"])."', 
						'".strtoupper($_POST["namaPanggilan"])."', 
						'".strtoupper($_POST["tempatLahir"])."', 
						'".$_POST["tglLahir"]."', 
						'".$_POST["jenisKelamin"]."', 
						'".strtoupper($_POST["alamat"])."', 
						'".$_POST["negara"]."', 
						'".$_POST["provinsi"]."', 
						'".$_POST["kota"]."', 
						'".$_POST["kodePos"]."', 
						'".$_POST["telepon"]."', 
						'".$_POST["hp"]."', 
						'".$_POST["email"]."', 
						'".$_POST["agama"]."', 
						'".$_POST["jenisIdentitas"]."', 
						'".$_POST["noIdentitas"]."'
					)";
				}else{

					// UPDATE
					$sql = " UPDATE tb_pelamar SET 
						nama_lengkap = '".strtoupper($_POST["namaLengkap"])."' , 
						nama_panggilan = '".strtoupper($_POST["namaPanggilan"])."' , 
						tempat_lahir = '".strtoupper($_POST["tempatLahir"])."' , 
						tgl_lahir = '".$_POST["tglLahir"]."' , 
						jenis_kelamin = '".$_POST["jenisKelamin"]."' , 
						alamat = '".strtoupper($_POST["alamat"])."' , 
						negara_id = '".$_POST["negara"]."' , 
						provinsi_id = '".$_POST["provinsi"]."' , 
						kota_id = '".$_POST["kota"]."' , 
						kode_pos = '".$_POST["kodePos"]."' , 
						telepon = '".$_POST["telepon"]."' , 
						hp = '".$_POST["hp"]."' , 
						email = '".$_POST["email"]."' , 
						agama = '".$_POST["agama"]."' , 
						jenis_identitas = '".$_POST["jenisIdentitas"]."', 
						no_identitas = '".$_POST["noIdentitas"]."'
					WHERE
						id_user = '".$_POST["login"]."'
					";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'pendidikan_formal':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					$sqlID = "SELECT id FROM tb_pend_formal WHERE id_pelamar='$_POST[auth]' AND tingkatan = '$_POST[tingkatan]'";
		            $queryID = mysql_query($sqlID);
		            $resultID = mysql_num_rows($queryID);

					if ($resultID <= 0) {

						// INSERT
						$sql = "INSERT INTO tb_pend_formal (
							id_pelamar, 
							tingkatan, 
							tahun_mulai, 
							tahun_selesai, 
							nama_instansi, 
							tempat, 
							fakultas, 
							jurusan, 
							ipk, 
							keterangan
						)
						VALUES ( 
							'".$_POST["auth"]."', 
							'".$_POST["tingkatan"]."', 
							'".$_POST["tahun_mulai"]."', 
							'".$_POST["tahun_selesai"]."', 
							'".strtoupper($_POST["nama_instansi"])."', 
							'".strtoupper($_POST["tempat"])."', 
							'".strtoupper($_POST["fakultas"])."', 
							'".strtoupper($_POST["jurusan"])."', 
							'".$_POST["ipk"]."', 
							'".$_POST["keterangan"]."'
						)";
					}else{

						// UPDATE
						$sql = " UPDATE tb_pend_formal SET 
							tahun_mulai = '".$_POST["tahun_mulai"]."' , 
							tahun_selesai = '".$_POST["tahun_selesai"]."' , 
							nama_instansi = '".strtoupper($_POST["nama_instansi"])."' , 
							tempat = '".strtoupper($_POST["tempat"])."' , 
							fakultas = '".strtoupper($_POST["fakultas"])."' , 
							jurusan = '".strtoupper($_POST["jurusan"])."' , 
							ipk = '".$_POST["ipk"]."' , 
							keterangan = '".$_POST["keterangan"]."'
						WHERE
							id_pelamar = '".$_POST["auth"]."'
						AND 
							tingkatan = '".$_POST["tingkatan"]."'
						";
					}
				}else{
					
					// DELETE
					$sql = "DELETE FROM tb_pend_formal WHERE id_pelamar = '".$_POST["auth"]."' AND tingkatan = '".$_POST["tingkatan"]."'";
				}
				// echo $sql;

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'pendidikan_informal':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					// INSERT
					$sql = "INSERT INTO tb_pend_informal (
						id_pelamar, 
						jenis_kursus, 
						tempat, 
						periode_awal, 
						periode_akhir, 
						keterangan
					)
					VALUES ( 
						'".$_POST["auth"]."', 
						'".strtoupper($_POST["jenis_kursus"])."', 
						'".strtoupper($_POST["tempat"])."', 
						'".$_POST["periode_awal"]."', 
						'".$_POST["periode_akhir"]."', 
						'".strtoupper($_POST["keterangan"])."' 
					)";

				}elseif ($_POST["content"] == 2){

					// UPDATE
					$sql = " UPDATE tb_pend_informal SET 
						jenis_kursus = '".strtoupper($_POST["jenis_kursus"])."' , 
						tempat = '".strtoupper($_POST["tempat"])."' , 
						periode_awal = '".$_POST["periode_awal"]."' , 
						periode_akhir = '".$_POST["periode_akhir"]."' , 
						keterangan = '".strtoupper($_POST["keterangan"])."'
					WHERE
						id = '".$_POST["data_val"]."'
					";

				}else{
					
					// DELETE
					$sql = "DELETE FROM tb_pend_informal WHERE id = '".$_POST["data_val"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'bahasa':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					// INSERT
					$sql = "INSERT INTO tb_bahasa_asing (id_pelamar, bahasa, lisan, tertulis)
					VALUES ('".$_POST["auth"]."', '".strtoupper($_POST["bahasa"])."', '".$_POST["lisan"]."', '".$_POST["tertulis"]."')";

				}elseif ($_POST["content"] == 2){

					// UPDATE
					$sql = " UPDATE tb_bahasa_asing SET 
						bahasa = '".strtoupper($_POST["bahasa"])."' , 
						lisan = '".$_POST["lisan"]."' , 
						tertulis = '".$_POST["tertulis"]."'
					WHERE
						id = '".$_POST["data_val"]."'
					";

				}else{
					
					// DELETE
					$sql = "DELETE FROM tb_bahasa_asing WHERE id = '".$_POST["data_val"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'keluarga':

			if ($auth == 0){
				$sqlID = "SELECT id FROM tb_status_keluarga WHERE id_pelamar='$_POST[auth]'";
	            $queryID = mysql_query($sqlID);
	            $resultID = mysql_num_rows($queryID);

				if ($resultID <= 0) {

					// INSERT
					$sql = "INSERT INTO tb_status_keluarga (id_pelamar, status, sejak) VALUES ('".$_POST["auth"]."', '".$_POST["status"]."', '".$_POST["sejak"]."')";

				}else{

					// UPDATE
					$sql = " UPDATE tb_status_keluarga SET status = '".$_POST["status"]."', sejak = '".$_POST["sejak"]."' WHERE id_pelamar = '".$_POST["auth"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'riwayat_pekerjaan':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					// INSERT
					$sql = "INSERT INTO tb_riwayat_pekerjaan (
						id_pelamar, 
						perusahaan, 
						periode_awal, 
						periode_akhir, 
						posisi, 
						jumlah_bawahan, 
						gaji_terakhir, 
						alasan_pindah, 
						deskripsi_pekerjaan,
						id_bidang_bisnis
					)
					VALUES ( 
						'".$_POST["auth"]."', 
						'".strtoupper($_POST["perusahaan"])."', 
						'".$_POST["periode_awal"]."', 
						'".$_POST["periode_akhir"]."', 
						'".strtoupper($_POST["posisi"])."', 
						'".$_POST["jumlah_bawahan"]."', 
						'".$_POST["gaji_terakhir"]."', 
						'".strtoupper($_POST["alasan_pindah"])."', 
						'".strtoupper($_POST["deskripsi_pekerjaan"])."',
						'".$_POST["bidang_bisnis"]."'
					)";

				}elseif ($_POST["content"] == 2){

					// UPDATE
					$sql = " UPDATE tb_riwayat_pekerjaan SET 
						perusahaan = '".strtoupper($_POST["perusahaan"])."' , 
						periode_awal = '".$_POST["periode_awal"]."' , 
						periode_akhir = '".$_POST["periode_akhir"]."' , 
						posisi = '".strtoupper($_POST["posisi"])."' , 
						jumlah_bawahan = '".$_POST["jumlah_bawahan"]."', 
						gaji_terakhir = '".$_POST["gaji_terakhir"]."', 
						alasan_pindah = '".strtoupper($_POST["alasan_pindah"])."', 
						deskripsi_pekerjaan = '".strtoupper($_POST["deskripsi_pekerjaan"])."', 
						id_bidang_bisnis = '".$_POST["bidang_bisnis"]."'
					WHERE
						id = '".$_POST["data_val"]."'
					";

				}else{
					
					// DELETE
					$sql = "DELETE FROM tb_riwayat_pekerjaan WHERE id = '".$_POST["data_val"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'minat':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					// INSERT
					$sql = "INSERT INTO tb_minat (
						id_pelamar, 
						lokasi_negara, 
						lokasi_provinsi, 
						lokasi_kota, 
						gaji_nominal, 
						bidang_bisnis, 
						fungsi_kerja, 
						posisi_kerja, 
						level_jabatan
					)
					VALUES ( 
						'".$_POST["auth"]."', 
						'".$_POST["lokasi_negara"]."', 
						'".$_POST["lokasi_provinsi"]."', 
						'".$_POST["lokasi_kota"]."', 
						'".$_POST["gaji_nominal"]."', 
						'".$_POST["bidang_bisnis"]."', 
						'".$_POST["fungsi_kerja"]."', 
						'".$_POST["posisi_kerja"]."', 
						'".$_POST["level_jabatan"]."'
					)";

				}elseif ($_POST["content"] == 2){

					// UPDATE
					$sql = " UPDATE tb_minat SET 
						lokasi_negara = '".$_POST["lokasi_negara"]."' , 
						lokasi_provinsi = '".$_POST["lokasi_provinsi"]."' , 
						lokasi_kota = '".$_POST["lokasi_kota"]."' , 
						gaji_nominal = '".$_POST["gaji_nominal"]."' , 
						bidang_bisnis = '".$_POST["bidang_bisnis"]."' , 
						fungsi_kerja = '".$_POST["fungsi_kerja"]."' , 
						posisi_kerja = '".$_POST["posisi_kerja"]."' , 
						level_jabatan = '".$_POST["level_jabatan"]."'
					WHERE 
						id = '".$_POST["data_val"]."'
					";

				}else{

					// DELETE
					$sql = "DELETE FROM tb_minat WHERE id = '".$_POST["data_val"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'organisasi':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					// INSERT
					$sql = "INSERT INTO tb_organisasi (
						id_pelamar, 
						organisasi, 
						periode_awal, 
						periode_akhir, 
						tempat, 
						posisi, 
						keterangan
					)
					VALUES ( 
						'".$_POST["auth"]."', 
						'".strtoupper($_POST["organisasi"])."', 
						'".$_POST["periode_awal"]."', 
						'".$_POST["periode_akhir"]."', 
						'".strtoupper($_POST["tempat"])."', 
						'".strtoupper($_POST["posisi"])."', 
						'".strtoupper($_POST["keterangan"])."' 
					)";

				}elseif ($_POST["content"] == 2){

					// UPDATE
					$sql = " UPDATE tb_organisasi SET 
						organisasi = '".strtoupper($_POST["organisasi"])."' , 
						periode_awal = '".$_POST["periode_awal"]."' , 
						periode_akhir = '".$_POST["periode_akhir"]."' , 
						tempat = '".strtoupper($_POST["tempat"])."' , 
						posisi = '".strtoupper($_POST["posisi"])."' , 
						keterangan = '".strtoupper($_POST["keterangan"])."'
					WHERE
						id = '".$_POST["data_val"]."'
					";

				}else{
					
					// DELETE
					$sql = "DELETE FROM tb_organisasi WHERE id = '".$_POST["data_val"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'sosial':

			if ($auth == 0){

				$suc = 0;

				$sqlSport = "SELECT id FROM tb_soc_act WHERE id_pelamar='$_POST[auth]' AND type = 1";
	            $querySport = mysql_query($sqlSport);
	            $resultSport = mysql_num_rows($querySport);

				if ($resultSport <= 0) {

					// INSERT
					$sqlManageSport = "INSERT INTO tb_soc_act (id_pelamar, type, keterangan) VALUES ('".$_POST["auth"]."', '1', '".strtoupper($_POST["sport"])."')";
				}else{

					// UPDATE
					$sqlManageSport = " UPDATE tb_soc_act SET keterangan = '".strtoupper($_POST["sport"])."' WHERE id_pelamar = '".$_POST["auth"]."' AND type = '1'";
				}

				if (mysql_query($sqlManageSport)){
					$suc+=1;
				}

				$sqlHobby = "SELECT id FROM tb_soc_act WHERE id_pelamar='$_POST[auth]' AND type = 2";
	            $queryHobby = mysql_query($sqlHobby);
	            $resultHobby = mysql_num_rows($queryHobby);

				if ($resultHobby <= 0) {

					// INSERT
					$sqlManageHobby = "INSERT INTO tb_soc_act (id_pelamar, type, keterangan) VALUES ('".$_POST["auth"]."', '2', '".strtoupper($_POST["hobby"])."')";
				}else{

					// UPDATE
					$sqlManageHobby = " UPDATE tb_soc_act SET keterangan = '".strtoupper($_POST["hobby"])."' WHERE id_pelamar = '".$_POST["auth"]."' AND type = '2'";
				}

				if (mysql_query($sqlManageHobby)){
					$suc+=1;
				}

				if ($suc == 2)
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'informasi':

			if ($auth == 0){

				$sqlID = "SELECT id FROM tb_informasi WHERE id_pelamar='$_POST[auth]'";
	            $queryID = mysql_query($sqlID);
	            $resultID = mysql_num_rows($queryID);

				if ($resultID <= 0) {

					// INSERT
					$sql = "INSERT INTO tb_informasi (id_pelamar, sumber_informasi) VALUES ('".$_POST["auth"]."', '".$_POST["informasi"]."')";
				}else{

					// UPDATE
					$sql = " UPDATE tb_informasi SET sumber_informasi = '".$_POST["informasi"]."' WHERE id_pelamar = '".$_POST["auth"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;

		case 'sakit':

			if ($auth == 0){
				if ($_POST["content"] == 1) {

					// INSERT
					$sql = "INSERT INTO tb_riwayat_penyakit (
						id_pelamar, 
						jenis_penyakit, 
						periode_awal, 
						periode_akhir, 
						pengaruh
					)
					VALUES ( 
						'".$_POST["auth"]."', 
						'".strtoupper($_POST["jenis_penyakit"])."', 
						'".$_POST["periode_awal"]."', 
						'".$_POST["periode_akhir"]."', 
						'".strtoupper($_POST["pengaruh"])."'
					)";

				}elseif ($_POST["content"] == 2){

					// UPDATE
					$sql = " UPDATE tb_riwayat_penyakit SET 
						jenis_penyakit = '".strtoupper($_POST["jenis_penyakit"])."' , 
						periode_awal = '".$_POST["periode_awal"]."' ,  
						periode_akhir = '".$_POST["periode_akhir"]."' ,  
						pengaruh = '".strtoupper($_POST["pengaruh"])."'
					WHERE
						id = '".$_POST["data_val"]."'
					";

				}else{
					
					// DELETE
					$sql = "DELETE FROM tb_riwayat_penyakit WHERE id = '".$_POST["data_val"]."'";
				}

				if (mysql_query($sql))
				{
					echo "success";
				} else {
					echo "failed";
				}
			}
			break;
		
		default:
			# code...
			break;
	}
?>