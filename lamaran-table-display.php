<?php
	session_start();
	include("administrator/includes/connection.php");
	include("administrator/includes/function.php");

	$action = $_POST["action"];

	switch ($action) {
		case 'pendidikan_informal':
            $sqlPendInformal = "SELECT *,DATE_FORMAT(periode_awal,'%d %b %Y') AS periode_awal,DATE_FORMAT(periode_akhir,'%d %b %Y') AS periode_akhir FROM tb_pend_informal WHERE id_pelamar = '".$_SESSION['pelamarID']."' ORDER BY periode_awal ASC";
            $queryPendInformal = mysql_query($sqlPendInformal);
            $countPendInformal = mysql_num_rows($queryPendInformal);

            if ($countPendInformal<1) {
            ?>
                <tr>
                    <td colspan="8">No data available in table</td>
                </tr>
                <?php
            }else{
            	$barisInformal = 1;
                while ($resultPendInformal = mysql_fetch_array($queryPendInformal)) {
                ?>
                    <tr>
                        <td class="td-input text-center"><?php echo $barisInformal ?></td>
                        <td class="td-input"><?php echo $resultPendInformal['jenis_kursus'] ?></td>
                        <td class="td-input"><?php echo $resultPendInformal['tempat'] ?></td>
                        <td class="td-input text-center"><?php echo $resultPendInformal['periode_awal'] ?></td>
                        <td class="td-input text-center"><?php echo $resultPendInformal['periode_akhir'] ?></td>
                        <td class="td-input"><?php echo $resultPendInformal['keterangan'] ?></td>
                        <td class="td-input text-center">
                            <a href="#" class="edit-informal-row" data-id="<?php echo $resultPendInformal['id'] ?>">Edit</a> | 
                            <a href="#" class="delete-informal-row" data-id="<?php echo $resultPendInformal['id'] ?>" data-nama="<?php echo $resultPendInformal['jenis_kursus'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $barisInformal++;
                }
            }
			break;

		case 'bahasa':
            $sqlBahasa = "SELECT * FROM tb_bahasa_asing WHERE id_pelamar = ".$_SESSION['pelamarID'];
            $queryBahasa = mysql_query($sqlBahasa);
            $countBahasa = mysql_num_rows($queryBahasa);

            if ($countBahasa<1) {
            ?>
                <tr>
                    <td colspan="11">No data available in table</td>
                </tr>
                <?php
            }else{
                $barisInformal = 1;
                $barisRadio = 1;
                while ($resultBahasa = mysql_fetch_array($queryBahasa)) {
                    $radio_1_1 = '';
                    $radio_1_2 = '';
                    $radio_1_3 = '';
                    $radio_2_1 = '';
                    $radio_2_2 = '';
                    $radio_2_3 = '';
                    if ($resultBahasa['lisan'] == 1) {
                        $radio_1_1 = 'checked';
                    }elseif ($resultBahasa['lisan'] == 2) {
                        $radio_1_2 = 'checked';
                    }elseif ($resultBahasa['lisan'] == 3) {
                        $radio_1_3 = 'checked';
                    }
                    if ($resultBahasa['tertulis'] == 1) {
                        $radio_2_1 = 'checked';
                    }elseif ($resultBahasa['tertulis'] == 2) {
                        $radio_2_2 = 'checked';
                    }elseif ($resultBahasa['tertulis'] == 3) {
                        $radio_2_3 = 'checked';
                    }
                    ?>
                    <tr>
                        <td class="td-input text-center"><?php echo $barisInformal ?></td>
                        <td class="td-input"><?php echo $resultBahasa['bahasa'] ?></td>
                        <td class="td-input text-center"><input type="radio" name="language-lisan-<?php echo $barisInformal ?>" <?php echo $radio_1_1 ?> value="1" disabled></td>
                        <td class="td-input text-center"><input type="radio" name="language-lisan-<?php echo $barisInformal ?>" <?php echo $radio_1_2 ?> value="2" disabled></td>
                        <td class="td-input text-center"><input type="radio" name="language-lisan-<?php echo $barisInformal ?>" <?php echo $radio_1_3 ?> value="3" disabled></td>
                        <td class="td-input text-center"><input type="radio" name="language-tertulis-<?php echo $barisInformal ?>" <?php echo $radio_2_1 ?> value="1" disabled></td>
                        <td class="td-input text-center"><input type="radio" name="language-tertulis-<?php echo $barisInformal ?>" <?php echo $radio_2_2 ?> value="2" disabled></td>
                        <td class="td-input text-center"><input type="radio" name="language-tertulis-<?php echo $barisInformal ?>" <?php echo $radio_2_3 ?> value="3" disabled></td>
                        <td class="td-input text-center">
                            <a href="#" class="edit-bahasa-row" data-id="<?php echo $resultBahasa['id'] ?>">Edit</a> | 
                            <a href="#" class="delete-bahasa-row" data-id="<?php echo $resultBahasa['id'] ?>" data-nama="<?php echo $resultBahasa['bahasa'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $barisInformal++;
                }
            }
            break;

        case 'riwayat_pekerjaan':
            $sqlRiwayat = "SELECT a.*, b.bidang_bisnis, DATE_FORMAT(a.periode_awal,'%d %b %Y') AS periode_awal,DATE_FORMAT(a.periode_akhir,'%d %b %Y') AS periode_akhir FROM tb_riwayat_pekerjaan a 
            LEFT JOIN tb_struktur_bidang_bisnis b on b.id = a.id_bidang_bisnis 
            WHERE a.id_pelamar = '".$_SESSION['pelamarID']."' ORDER BY a.periode_awal ASC";
            $queryRiwayat = mysql_query($sqlRiwayat);
            $countRiwayat = mysql_num_rows($queryRiwayat);

            if ($countRiwayat<1) {
            ?>
                <tr>
                    <td colspan="11">No data available in table</td>
                </tr>
                <?php
            }else{
                $barisRiwayat = 1;
                while ($resultRiwayat = mysql_fetch_array($queryRiwayat)) {
                ?>
                    <tr>
                        <td class="td-input text-center"><?php echo $barisRiwayat ?></td>
                        <td class="td-input"><?php echo $resultRiwayat['perusahaan'] ?></td>
                        <td class="td-input"><?php echo $resultRiwayat['bidang_bisnis'] ?></td>
                        <td class="td-input text-center"><?php echo $resultRiwayat['periode_awal'] ?></td>
                        <td class="td-input text-center"><?php echo $resultRiwayat['periode_akhir'] ?></td>
                        <td class="td-input"><?php echo $resultRiwayat['posisi'] ?></td>
                        <td class="td-input text-center"><?php echo $resultRiwayat['jumlah_bawahan'] ?></td>
                        <td class="td-input">
                            <span class="pull-left">Rp</span>
                            <span class="pull-right"><?php echo number_format($resultRiwayat['gaji_terakhir'],2, ',', '.'); ?></span>
                        </td>
                        <td class="td-input"><?php echo $resultRiwayat['alasan_pindah'] ?></td>
                        <td class="td-input"><?php echo $resultRiwayat['deskripsi_pekerjaan'] ?></td>
                        <td class="td-input text-center">
                            <a href="#" class="edit-pekerjaan-row" data-id="<?php echo $resultRiwayat['id'] ?>">Edit</a> | 
                            <a href="#" class="delete-pekerjaan-row" data-id="<?php echo $resultRiwayat['id'] ?>" data-nama="<?php echo $resultRiwayat['perusahaan'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $barisRiwayat++;
                }
            }
            break;

        case 'minat':
            $sqlMinat = "SELECT a.*, b.bagian AS provinsi_minat, c.kota AS kota_minat, d.negara AS negara_minat, e.bidang_bisnis, f.fungsi_kerja, g.level_jabatan, h.posisi_kerja FROM tb_minat a 
            LEFT JOIN tb_negara_bagian b ON b.id = a.lokasi_provinsi
            LEFT JOIN tb_kota c ON c.id = a.lokasi_kota
            LEFT JOIN tb_negara d ON d.id = a.lokasi_negara
            LEFT JOIN tb_struktur_bidang_bisnis e ON e.id = a.bidang_bisnis
            LEFT JOIN tb_struktur_fungsi_kerja f ON f.id = a.fungsi_kerja
            LEFT JOIN tb_struktur_level_jabatan g ON g.id = a.level_jabatan
            LEFT JOIN tb_struktur_posisi_kerja h ON h.id = a.posisi_kerja
            WHERE a.id_pelamar = '".$_SESSION['pelamarID']."'";

            $queryMinat = mysql_query($sqlMinat);
            $countMinat = mysql_num_rows($queryMinat);

            if ($countMinat<1) {
            ?>
                <tr>
                    <td colspan="10">No data available in table</td>
                </tr>
                <?php
            }else{
                $barisMinat = 1;
                while ($resultMinat = mysql_fetch_array($queryMinat)) {
                ?>
                    <tr>
                        <td class="td-input text-center"><?php echo $barisMinat ?></td>
                        <td class="td-input"><?php echo $resultMinat['negara_minat'] ?></td>
                        <td class="td-input"><?php echo $resultMinat['provinsi_minat'] ?></td>
                        <td class="td-input"><?php echo $resultMinat['kota_minat'] ?></td>
                        <td class="td-input">
                            <span class="pull-left">Rp</span>
                            <span class="pull-right"><?php echo number_format($resultMinat['gaji_nominal'],2, ',', '.'); ?></span>
                        </td>
                        <td class="td-input text-center"><?php echo $resultMinat['bidang_bisnis'] ?></td>
                        <td class="td-input text-center"><?php echo $resultMinat['fungsi_kerja'] ?></td>
                        <td class="td-input text-center"><?php echo $resultMinat['posisi_kerja'] ?></td>
                        <td class="td-input text-center"><?php echo $resultMinat['level_jabatan'] ?></td>
                        <td class="td-input text-center">
                            <a href="#" class="edit-minat-row" data-id="<?php echo $resultMinat['id'] ?>">Edit</a> | 
                            <a href="#" class="delete-minat-row" data-id="<?php echo $resultMinat['id'] ?>" data-nama="<?php echo $resultMinat['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $barisMinat++;
                }
            }
            break;

        case 'organisasi':
            $sqlOrganisasi = "SELECT *,DATE_FORMAT(periode_awal,'%d %b %Y') AS periode_awal,DATE_FORMAT(periode_akhir,'%d %b %Y') AS periode_akhir FROM tb_organisasi WHERE id_pelamar = ".$_SESSION['pelamarID'];
            $queryOrganisasi = mysql_query($sqlOrganisasi);
            $countOrganisasi = mysql_num_rows($queryOrganisasi);

            if ($countOrganisasi<1) {
            ?>
                <tr>
                    <td colspan="9">No data available in table</td>
                </tr>
                <?php
            }else{
                $barisOrganisasi = 1;
                while ($resultOrganisasi = mysql_fetch_array($queryOrganisasi)) {
                ?>
                    <tr>
                        <td class="td-input text-center"><?php echo $barisOrganisasi ?></td>
                        <td class="td-input"><?php echo $resultOrganisasi['organisasi'] ?></td>
                        <td class="td-input text-center"><?php echo $resultOrganisasi['periode_awal'] ?></td>
                        <td class="td-input text-center"><?php echo $resultOrganisasi['periode_akhir'] ?></td>
                        <td class="td-input"><?php echo $resultOrganisasi['tempat'] ?></td>
                        <td class="td-input"><?php echo $resultOrganisasi['posisi'] ?></td>
                        <td class="td-input"><?php echo $resultOrganisasi['keterangan'] ?></td>
                        <td class="td-input text-center">
                            <a href="#" class="edit-organisasi-row" data-id="<?php echo $resultOrganisasi['id'] ?>">Edit</a> | 
                            <a href="#" class="delete-organisasi-row" data-id="<?php echo $resultOrganisasi['id'] ?>" data-nama="<?php echo $resultOrganisasi['organisasi'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $barisOrganisasi++;
                }
            }
            break;

        case 'sakit':
            $sqlSakit = "SELECT *,DATE_FORMAT(periode_awal,'%d %b %Y') AS periode_awal,DATE_FORMAT(periode_akhir,'%d %b %Y') AS periode_akhir FROM tb_riwayat_penyakit WHERE id_pelamar = ".$_SESSION['pelamarID'];
            $querySakit = mysql_query($sqlSakit);
            $countSakit = mysql_num_rows($querySakit);

            if ($countSakit<1) {
            ?>
                <tr>
                    <td colspan="7">No data available in table</td>
                </tr>
                <?php
            }else{
                $barisSakit = 1;
                while ($resultSakit = mysql_fetch_array($querySakit)) {
                ?>
                    <tr>
                        <td class="td-input text-center"><?php echo $barisSakit ?></td>
                        <td class="td-input"><?php echo $resultSakit['jenis_penyakit'] ?></td>
                        <td class="td-input text-center"><?php echo $resultSakit['periode_awal'] ?></td>
                        <td class="td-input text-center"><?php echo $resultSakit['periode_akhir'] ?></td>
                        <td class="td-input"><?php echo $resultSakit['pengaruh'] ?></td>
                        <td class="td-input text-center">
                            <a href="#" class="edit-sakit-row" data-id="<?php echo $resultSakit['id'] ?>">Edit</a> | 
                            <a href="#" class="delete-sakit-row" data-id="<?php echo $resultSakit['id'] ?>" data-nama="<?php echo $resultSakit['jenis_penyakit'] ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                    $barisSakit++;
                }
            }
            break;

        case 'lampiran':
            $sqlLampiran = "SELECT * FROM tb_lampiran WHERE id_pelamar='".$_SESSION["pelamarID"]."' ORDER BY type";
            $queryLampiran = mysql_query($sqlLampiran);

            $statusFoto = 'Tidak Terlampir'; $statusIjazah = 'Tidak Terlampir'; $statusTranskrip = 'Tidak Terlampir'; $statusReferensi = 'Tidak Terlampir';
            $disFoto = 'disabled'; $disIjazah = 'disabled'; $disTranskrip = 'disabled'; $disReferensi = 'disabled';
            $fileFoto = ''; $fileIjazah = ''; $fileTranskrip = ''; $fileReferensi = '';
            $namaFoto = ''; $namaIjazah = ''; $namaTranskrip = ''; $namaReferensi = '';

            while ($resultLampiran = mysql_fetch_array($queryLampiran)) {
                $file = explode("/", $resultLampiran["dir_file"]);
                if ($resultLampiran['type'] == 1) {
                    $statusFoto = 'Terlampir';
                    $fileFoto = $resultLampiran['dir_file'];
                    $namaFoto = $file[3];
                    $disFoto = '';
                }else if($resultLampiran['type'] == 2) {
                    $statusIjazah = 'Terlampir';
                    $fileIjazah = $resultLampiran['dir_file'];
                    $namaIjazah = $file[3];
                    $disIjazah = '';
                }else if($resultLampiran['type'] == 3) {
                    $statusTranskrip = 'Terlampir';
                    $fileTranskrip = $resultLampiran['dir_file'];
                    $namaTranskrip = $file[3];
                    $disTranskrip = '';
                }else if($resultLampiran['type'] == 4) {
                    $statusReferensi = 'Terlampir';
                    $fileReferensi = $resultLampiran['dir_file'];
                    $namaReferensi = $file[3];
                    $disReferensi = '';
                }
            }

            ?>
            <dl class="dl-horizontal file-load pull-left">
                <dd><h4>Foto Pelamar</h4></dd>
                <dd><?php echo $statusFoto ?></dd>
                <dd><?php echo ($namaFoto) ?></dd>
                <dd><br><a target="_blank" class="btn btn-primary" href="<?php echo $fileFoto ?>" <?php echo $disFoto ?>><i class="fa fa-cloud-download"></i> Lihat Lampiran</a> <a class="btn btn-primary manage-lampiran" href="#" id="foto" data-iden="1" data-source="foto" data-file="$fileFoto"><i class="fa fa-pencil"></i> Tambah/Ganti</a></dd>
            </dl>
            <div class="clearfix"></div>
            <hr>
            <dl class="dl-horizontal file-load pull-left">
                <dd><h4>Scan Ijazah</h4></dd>
                <dd><?php echo $statusIjazah ?></dd>
                <dd><?php echo ($namaIjazah) ?></dd>
                <dd><br><a target="_blank" class="btn btn-primary" href="<?php echo $fileIjazah ?>" <?php echo $disIjazah ?>><i class="fa fa-cloud-download"></i> Lihat Lampiran</a> <a class="btn btn-primary manage-lampiran" href="#" id="ijazah" data-iden="2" data-source="ijazah" data-file="$fileIjazah"><i class="fa fa-pencil"></i> Tambah/Ganti</a></dd>
            </dl>
            <div class="clearfix"></div>
            <hr>
            <dl class="dl-horizontal file-load pull-left">
                <dd><h4>Scan Transkrip Nilai</h4></dd>
                <dd><?php echo $statusTranskrip ?></dd>
                <dd><?php echo ($namaTranskrip) ?></dd>
                <dd><br><a target="_blank" class="btn btn-primary" href="<?php echo $fileTranskrip ?>" <?php echo $disTranskrip ?>><i class="fa fa-cloud-download"></i> Lihat Lampiran</a> <a class="btn btn-primary manage-lampiran" href="#" id="transkrip" data-iden="3" data-source="transkrip" data-file="$fileTranskrip"><i class="fa fa-pencil"></i> Tambah/Ganti</a></dd>
            </dl>
            <div class="clearfix"></div>
            <hr>
            <dl class="dl-horizontal file-load pull-left">
                <dd><h4>Surat Referensi Kerja</h4></dd>
                <dd><?php echo $statusReferensi ?></dd>
                <dd><?php echo ($namaReferensi) ?></dd>
                <dd><br><a target="_blank" class="btn btn-primary" href="<?php echo $fileReferensi ?>" <?php echo $disReferensi ?>><i class="fa fa-cloud-download"></i> Lihat Lampiran</a> <a class="btn btn-primary manage-lampiran" href="#" id="referensi" data-iden="4" data-source="referensi" data-file="$fileReferensi"><i class="fa fa-pencil"></i> Tambah/Ganti</a></dd>
            </dl>
            <div class="clearfix"></div>
            <?php
            break;
		
		default:
			# code...
			break;
	}
?>