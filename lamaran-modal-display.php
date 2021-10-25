<?php
	session_start();
	include("administrator/includes/connection.php");
    include("administrator/includes/function.php");
	include("includes/function.php");

	$action = $_POST["action"];

	switch ($action) {
		case 'pendidikan_informal':
			$auth = authByID($_POST["login"]);

			if ($auth == 0){
				$sql = "SELECT * FROM tb_pend_informal WHERE id = ".$_POST["data_val"];
				$query = mysql_query($sql);
				$result = mysql_fetch_array($query);
            	?>
                <form class="form-horizontal" role="form" onsubmit="return formAddInformal(<?php echo $_POST['content'].','.$_POST['data_val'] ?>)">
                    <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Pendidikan Informal</h4>
		            </div>
                    <div class="modal-body">
		                <div class="form-group">
                            <label for="jenis-kursus" class="control-label required">Jenis Kursus / Pelatihan</label>
                            <input type="text" class="form-control input-sm" id="jenis-kursus" placeholder="Jenis Kursus / Pelatihan" value="<?php echo $result['jenis_kursus'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat" class="control-label required">Tempat</label>
                            <input type="text" class="form-control input-sm" id="tempat" placeholder="Tempat" value="<?php echo $result['tempat'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Periode Awal" class="control-label required">Periode</label>
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control numeric upper-text input-sm" id="periode_awal" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_awal'] ?>" required>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <h6>sampai</h6>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control numeric upper-text input-sm" id="periode_akhir" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_akhir'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="control-label">Keterangan</label>
                            <textarea class="form-control input-sm" rows="3" id="keterangan" placeholder="Keterangan"><?php echo $result['keterangan'] ?></textarea>
                        </div>
		            </div>
		            <div class="modal-footer">
		            	<div class="form-group">
	                		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <button type="reset" class="btn btn-sm btn-default reset">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
		            </div>
                </form>
            	<?php
			}
			break;

		case 'bahasa':
			$auth = authByID($_POST["login"]);

			if ($auth == 0){
				$sql = "SELECT bahasa, lisan, tertulis FROM tb_bahasa_asing WHERE id = ".$_POST["data_val"];
				$query = mysql_query($sql);
				$result = mysql_fetch_array($query);
				$radio_1_1 = '';
                $radio_1_2 = '';
                $radio_1_3 = '';
                $radio_2_1 = '';
                $radio_2_2 = '';
                $radio_2_3 = '';
                if ($result['lisan'] == 1) {
                    $radio_1_1 = 'checked';
                }elseif ($result['lisan'] == 2) {
                    $radio_1_2 = 'checked';
                }elseif ($result['lisan'] == 3) {
                    $radio_1_3 = 'checked';
                }
                if ($result['tertulis'] == 1) {
                    $radio_2_1 = 'checked';
                }elseif ($result['tertulis'] == 2) {
                    $radio_2_2 = 'checked';
                }elseif ($result['tertulis'] == 3) {
                    $radio_2_3 = 'checked';
                }
            	?>
                <form class="form-horizontal" role="form" onsubmit="return formAddBahasa(<?php echo $_POST['content'].','.$_POST['data_val'] ?>)">
                    <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Bahasa Asing</h4>
		            </div>
                    <div class="modal-body">
		                <div class="form-group">
                            <label for="bahasa" class="control-label required">Bahasa</label>
                            <input type="text" class="form-control input-sm" id="bahasa" placeholder="Bahasa" value="<?php echo $result['bahasa'] ?>" required>
                        </div>
                        <div class="row">
                        	<div class="col-md-4 col-sm-5 col-xs-6">
                            	<label for="lisan" class="control-label required">Lisan</label>
                        		<div class="radio">
									<label>
										<input type="radio" name="language-lisan" id="language-lisan" <?php echo $radio_1_1 ?> value="1" required>
										Kurang
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="language-lisan" id="language-lisan" <?php echo $radio_1_2 ?> value="2" required>
										Cukup
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="language-lisan" id="language-lisan" <?php echo $radio_1_3 ?> value="3" required>
										Baik
									</label>
								</div>
                        	</div>
                        	<div class="col-md-4 col-sm-5 col-xs-6">
                            	<label for="tertulis" class="control-label required">Tertulis</label>
                        		<div class="radio">
									<label>
										<input type="radio" name="language-tertulis" id="language-tertulis" <?php echo $radio_2_1 ?> value="1" required>
										Kurang
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="language-tertulis" id="language-tertulis" <?php echo $radio_2_2 ?> value="2" required>
										Cukup
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="language-tertulis" id="language-tertulis" <?php echo $radio_2_3 ?> value="3" required>
										Baik
									</label>
								</div>
                        	</div>
                        </div>
		            </div>
		            <div class="modal-footer">
		            	<div class="form-group">
	                		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <button type="reset" class="btn btn-sm btn-default reset">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
		            </div>
                </form>
            	<?php
			}
			break;

		case 'riwayat_pekerjaan':
			$auth = authByID($_POST["login"]);

			if ($auth == 0){
				$sql = "SELECT a.*, b.* FROM tb_riwayat_pekerjaan a 
                LEFT JOIN tb_struktur_bidang_bisnis b on b.id = a.id_bidang_bisnis 
                WHERE a.id = ".$_POST["data_val"];
				$query = mysql_query($sql);
				$result = mysql_fetch_array($query);
                ?>
                <form class="form-horizontal" role="form" onsubmit="return formAddPekerjaan(<?php echo $_POST['content'].','.$_POST['data_val'] ?>)">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Riwayat Pekerjaan</h4>
		            </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="perusahaan" class="control-label required">Perusahaan</label>
                            <input type="text" class="form-control input-sm" id="perusahaan" placeholder="Nama Perusahaan" value="<?php echo $result['perusahaan'] ?>" required>
                        </div>
		                <div class="form-group">
                            <label for="bidang_bisnis" class="control-label required">Bisnis Perusahaan</label>
                            <select class="form-control upper-text bidang_bisnis input-sm" id="bidang_bisnis" required>
                                <?php bisnisSelected($result['id_bidang_bisnis']) ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="periode_awal" class="control-label required">Periode</label>
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control numeric upper-text input-sm" id="periode_awal" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_awal'] ?>" required>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <h6>sampai</h6>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control numeric upper-text input-sm" id="periode_akhir" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_akhir'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="posisi" class="control-label required">Posisi</label>
                            <input type="text" class="form-control input-sm" id="posisi" placeholder="Posisi" value="<?php echo $result['posisi'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah-bawahan" class="control-label">Jumlah Bawahan</label>
                            <input type="text" class="form-control numeric input-sm" id="jumlah-bawahan" placeholder="Jumlah Bawahan" value="<?php echo $result['jumlah_bawahan'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="gaji-terakhir" class="control-label">Gaji Terakhir</label>
                            <div class="input-group input-group-sm currency-group">
                                <span class="input-group-addon">Rp</span>
                                <input type="text" class="form-control currency" id="gaji-terakhir" placeholder="Gaji Terakhir" value="<?php echo $result['gaji_terakhir'] ?>" required>
                            	<input type="hidden" class="currency-number" id="gaji-terakhir-number" value="<?php echo $result['gaji_terakhir'] ?>">
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alasan-pindah" class="control-label">Alasan Pindah</label>
                            <textarea class="form-control input-sm" rows="3" id="alasan-pindah" placeholder="Alasan Pindah" required><?php echo $result['alasan_pindah'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi-pekerjaan" class="control-label">Deskripsi Pekerjaan</label>
                            <textarea class="form-control input-sm" rows="5" id="deskripsi-pekerjaan" placeholder="Deskripsi Pekerjaan" required><?php echo $result['deskripsi_pekerjaan'] ?></textarea>
                        </div>
		            </div>
		            <div class="modal-footer">
		            	<div class="form-group">
	                		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <button type="reset" class="btn btn-sm btn-default reset">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
		            </div>
                </form>
            	<?php
			}
			break;

        case 'minat':
            $auth = authByID($_POST["login"]);

            if ($auth == 0){
                $sqlCount = "SELECT count(id) AS sum_minat FROM tb_minat WHERE id_pelamar = '".$_POST["auth"]."'";
                $queryCount = mysql_query($sqlCount);
                $countLegalMinat = mysql_fetch_array($queryCount);

                if ($countLegalMinat['sum_minat']>=3 && $_POST['content']==1) {
                    ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Minat dan Harapan</h4>
                    </div>
                    <div class="modal-body">
                        Jumlah maksimum <b>Minat dan Harapan</b> adalah <b>3 (tiga)</b>.<br>
                        Hapus atau rubah data yang ada.
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <?php
                }else{
                    $sql = "SELECT a.*, b.bagian AS provinsi_minat, c.kota AS kota_minat, d.negara AS negara_minat, e.bidang_bisnis AS bidang_bisnis_display, f.fungsi_kerja AS fungsi_kerja_display, g.level_jabatan AS level_jabatan_display, h.posisi_kerja AS posisi_kerja_display FROM tb_minat a 
                    LEFT JOIN tb_negara_bagian b ON b.id = a.lokasi_provinsi
                    LEFT JOIN tb_kota c ON c.id = a.lokasi_kota
                    LEFT JOIN tb_negara d ON d.id = a.lokasi_negara
                    LEFT JOIN tb_struktur_bidang_bisnis e ON e.id = a.bidang_bisnis
                    LEFT JOIN tb_struktur_fungsi_kerja f ON f.id = a.fungsi_kerja
                    LEFT JOIN tb_struktur_level_jabatan g ON g.id = a.level_jabatan
                    LEFT JOIN tb_struktur_posisi_kerja h ON h.id = a.posisi_kerja
                    WHERE a.id = ".$_POST["data_val"];
                    $query = mysql_query($sql);
                    $result = mysql_fetch_array($query);
                    ?>
                    <form class="form-horizontal" role="form" onsubmit="return formAddMinat(<?php echo $_POST['content'].','.$_POST['data_val'] ?>)">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Minat dan Harapan</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="browse-negara-minat" class="control-label">Preferensi Lokasi</label>
                                <div class="row">
                                    <div class="col-sm-12 button-browse-placer">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" id="negara-minat-id" value="<?php echo $result['lokasi_negara'] ?>">
                                            <input type="text" class="form-control upper-text browse-tempat-minat" id="negara-minat" placeholder="negara" value="<?php echo $result['negara_minat'] ?>" required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info pilih-tempat-minat" type="button" id="negara-minat-browse"><i class="fa fa-folder-open"></i> Browse</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 button-browse-placer">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" id="provinsi-minat-id" value="<?php echo $result['lokasi_provinsi'] ?>">
                                            <input type="text" class="form-control upper-text browse-tempat-minat" id="provinsi-minat" placeholder="Provinsi" value="<?php echo $result['provinsi_minat'] ?>" required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info pilih-tempat-minat" type="button" id="provinsi-minat-browse"><i class="fa fa-folder-open"></i> Browse</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 button-browse-placer">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" id="kota-minat-id" value="<?php echo $result['lokasi_kota'] ?>">
                                            <input type="text" class="form-control upper-text browse-tempat-minat" id="kota-minat" placeholder="Kota" value="<?php echo $result['kota_minat'] ?>" required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-info pilih-tempat-minat" type="button" id="kota-minat-browse"><i class="fa fa-folder-open"></i> Browse</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gaji-nominal" class="control-label">Gaji Bulanan</label>
                                <div class="input-group input-group-sm currency-group">
                                    <span class="input-group-addon">Rp</span>
                                    <input type="text" class="form-control currency" id="gaji-nominal" placeholder="Gaji Bulanan" value="<?php echo $result['gaji_nominal'] ?>" required>
                                    <input type="hidden" class="currency-number" id="gaji-nominal-number" value="<?php echo $result['gaji_nominal'] ?>">
                                    <span class="input-group-addon">.00</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bidang-bisnis" class="control-label">Bidang Bisnis</label>
                                <select class="form-control upper-text input-sm" id="bidang-bisnis" required>
                                    <?php bisnisSelected($result['bidang_bisnis']) ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="fungsi-kerja" class="control-label">Spesialisasi</label>
                                <select class="form-control upper-text input-sm" id="fungsi-kerja" required>
                                    <?php fungsiSelected($result['fungsi_kerja']) ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="posisi-kerja" class="control-label">Posisi Kerja</label>
                                <select class="form-control upper-text input-sm" id="posisi-kerja" required>
                                    <?php posisiSelected($result['posisi_kerja']) ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="level-jabatan" class="control-label">Level Jabatan</label>
                                <select class="form-control upper-text input-sm" id="level-jabatan" required>
                                    <?php levelJabatanSelected($result['level_jabatan']) ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                                <button type="reset" class="btn btn-sm btn-default reset">Reset</button>
                                <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            </div>
                        </div>
                    </form>
                <?php
                }
            }
            break;

		case 'organisasi':
			$auth = authByID($_POST["login"]);

			if ($auth == 0){
				$sql = "SELECT * FROM tb_organisasi WHERE id = ".$_POST["data_val"];
				$query = mysql_query($sql);
				$result = mysql_fetch_array($query);
            	?>
                <form class="form-horizontal" role="form" onsubmit="return formAddOrganisasi(<?php echo $_POST['content'].','.$_POST['data_val'] ?>)">
                    <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Organisasi</h4>
		            </div>
                    <div class="modal-body">
		                <div class="form-group">
                            <label for="organisasi" class="control-label required">Organisasi</label>
                            <input type="text" class="form-control input-sm" id="organisasi" placeholder="Organisasi" value="<?php echo $result['organisasi'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="periode" class="control-label required">Periode</label>
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control numeric upper-text input-sm" id="periode_awal" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_awal'] ?>" required>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <h6>sampai</h6>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control numeric upper-text input-sm" id="periode_akhir" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_akhir'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat" class="control-label required">Tempat</label>
                            <input type="text" class="form-control input-sm" id="tempat" placeholder="Tempat" value="<?php echo $result['tempat'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="posisi" class="control-label required">Posisi</label>
                            <input type="text" class="form-control input-sm" id="posisi" placeholder="Posisi" value="<?php echo $result['posisi'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="control-label">Keterangan</label>
                            <textarea class="form-control input-sm" rows="3" id="keterangan" placeholder="Keterangan"><?php echo $result['keterangan'] ?></textarea>
                        </div>
		            </div>
		            <div class="modal-footer">
		            	<div class="form-group">
	                		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <button type="reset" class="btn btn-sm btn-default reset">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
		            </div>
                </form>
            	<?php
			}
			break;

		case 'sakit':
			$auth = authByID($_POST["login"]);

			if ($auth == 0){
				$sql = "SELECT * FROM tb_riwayat_penyakit WHERE id = ".$_POST["data_val"];
				$query = mysql_query($sql);
				$result = mysql_fetch_array($query);
            	?>
                <form class="form-horizontal" role="form" onsubmit="return formAddPenyakit(<?php echo $_POST['content'].','.$_POST['data_val'] ?>)">
                    <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Riwayat Penyakit</h4>
		            </div>
                    <div class="modal-body">
		                <div class="form-group">
                            <label for="jenis_penyakit" class="control-label required">Jenis Penyakit</label>
                            <input type="text" class="form-control input-sm" id="jenis_penyakit" placeholder="Jenis Penyakit" value="<?php echo $result['jenis_penyakit'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Periode" class="control-label required">Periode</label>
                            <div class="row">
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control upper-text numeric input-sm" id="periode_awal" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_awal'] ?>" required>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                    <h6>sampai</h6>
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <input type="text" class="form-control upper-text numeric input-sm" id="periode_akhir" placeholder="YYYY-MM-DD" value="<?php echo $result['periode_akhir'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pengaruh" class="control-label">Pengaruh</label>
                            <textarea class="form-control input-sm" rows="3" id="pengaruh" placeholder="Pengaruh" required><?php echo $result['pengaruh'] ?></textarea>
                        </div>
		            </div>
		            <div class="modal-footer">
		            	<div class="form-group">
	                		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <button type="reset" class="btn btn-sm btn-default reset">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </div>
		            </div>
                </form>
            	<?php
			}
			break;
		
		default:
			# code...
			break;
	}
?>