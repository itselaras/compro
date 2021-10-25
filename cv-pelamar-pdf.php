<?php

session_start();
    ob_start();

    include("administrator/includes/connection.php");
    include("administrator/includes/function.php");
    include("includes/function.php");

    if(isset($_GET["source"]) && $_GET["source"] == "admin")
    {
        $idPelamar = $_GET["id"];
    } else
    {
        $idPelamar = $_SESSION["pelamarID"];
    }
    $nama = mysql_fetch_array(mysql_query("SELECT nama_lengkap FROM tb_pelamar WHERE id='".$idPelamar."'"));
    $nama = "CV-".$nama["nama_lengkap"];
    $where = "a.id = '".$idPelamar."'";

$html = '
<body>
	<table width="100%">
		<tr>
			<td class="img-logo">
				<img src="img/smi-logo.png" class="img-img" alt="Logo Kop Surat" data-filename="Logo SMI">
			</td>
			<td class="header-cv">
				RIWAYAT HIDUP<br><small class="small"><i>CURRICULUM VITAE</i></small>
			</td>
		</tr>
	</table>
	<br>
	<table width="100%" class="tabel-hr"><tr><td></td></tr></table>
	<br><br>
	<table width="100%">
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>I.</b></td>
						<td><b>IDENTITAS / <i>IDENTITY</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
<!-- INDENTITAS ISI - MULAI -->
		<tr>
			<td class="td-isi">';
				$sql_identitas = "SELECT a.nama_lengkap,a.nama_panggilan,CASE a.tempat_lahir WHEN NULL THEN '' ELSE CONCAT(a.tempat_lahir,' / ',DATE_FORMAT(a.tgl_lahir,'%d %M %Y')) END AS ttl,CASE a.jenis_kelamin WHEN '1' THEN 'LAKI-LAKI' WHEN '2' THEN 'PEREMPUAN' ELSE NULL END AS kelamin,a.alamat,UPPER(b.negara) AS negara, UPPER(c.bagian) AS bagian, UPPER(d.kota) AS kota,a.kode_pos,IFNULL(a.telepon,'-') AS telepon,a.hp,a.email,CASE a.agama WHEN '1' THEN 'BUDHA' WHEN '2' THEN 'HINDU' WHEN '3' THEN 'ISLAM' WHEN '4' THEN 'KRISTEN KATOLIK' WHEN '5' THEN 'KRISTEN PROTESTAN' ELSE 'LAINNYA' END AS agama,CASE a.jenis_identitas WHEN '1' THEN 'KTP' WHEN '2' THEN 'SIM' WHEN '3' THEN 'KARTU PELAJAR' ELSE NULL END AS jenis_identitas,a.no_identitas
					FROM tb_pelamar a 
					LEFT JOIN tb_negara b ON b.id = a.negara_id
					LEFT JOIN tb_negara_bagian c ON c.id = a.provinsi_id
					LEFT JOIN tb_kota d ON d.id = a.kota_id
	                WHERE ".$where;
                $query_identitas = mysql_query($sql_identitas);
                $result_identitas = mysql_fetch_array($query_identitas);
                $sql_foto = "SELECT * FROM tb_lampiran WHERE id_pelamar = ".$idPelamar." AND type = 1";
                $query_foto = mysql_query($sql_foto);
                $result_foto = mysql_fetch_array($query_foto);
	            $html .= '<table width="100%">
	        		<tr>
	        			<td class="isi-width">Nama Lengkap<br><span class="smaller"><i>Full Name</i></span></td>
	        			<td>'.$result_identitas["nama_lengkap"].'</td>
	        		</tr>
	        	</table>
	        </td>
	        <td rowspan="5" class="container-foto">
	        	<img src="'.$result_foto["dir_file"].'" class="img-foto" alt="Foto" data-filename="Foto Pelamar">
	        </td>
		</tr>
		<tr>
			<td class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Nama Panggilan<br><span class="smaller"><i>Nick Name</i></span></td>
	        			<td>'.$result_identitas["nama_panggilan"].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Tempat & Tanggal Lahir<br><span class="smaller"><i>Place & Date of Birth</i></span></td>
	        			<td>'.$result_identitas['ttl'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Jenis Kelamin<br><span class="smaller"><i>Sex</i></span></td>
	        			<td>'.$result_identitas['kelamin'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Alamat<br><span class="smaller"><i>Address</i></span></td>
	        			<td>'.$result_identitas['alamat'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Negara<br><span class="smaller"><i>State</i></span></td>
	        			<td>'.$result_identitas['negara'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Provinsi<br><span class="smaller"><i>Province</i></span></td>
	        			<td>'.$result_identitas['bagian'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Kota<br><span class="smaller"><i>City</i></span></td>
	        			<td>'.$result_identitas['kota'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Kode Pos<br><span class="smaller"><i>Zip Code</i></span></td>
	        			<td>'.$result_identitas['kode_pos'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Telepon<br><span class="smaller"><i>Phone</i></span></td>
	        			<td>'.$result_identitas['telepon'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Handphone<br><span class="smaller"><i>Handphone</i></span></td>
	        			<td>'.$result_identitas['hp'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Email<br><span class="smaller"><i>Email</i></span></td>
	        			<td>'.$result_identitas['email'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Agama<br><span class="smaller"><i>Religion</i></span></td>
	        			<td>'.$result_identitas['agama'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Nomor Identitas<br><span class="smaller"><i>Identity Number</i></span></td>
	        			<td>'.$result_identitas['jenis_identitas'].' - '.$result_identitas['no_identitas'].'</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
		<tr><td height="20px"></td></tr>
<!-- INDENTITAS ISI - SELESAI -->

<!-- PENDIDIKAN ISI - MULAI -->
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>II.</b></td>
						<td><b>PENDIDIKAN / <i>EDUCATION BACKGROUND</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2">1.</i></span></td>
	        			<td>
							Pendidikan Formal<br>
							<div class="smaller"><i>Formal Education</i></div>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th rowspan="2" width="50%">No.</th>
									<th rowspan="2" width="50%">Tingkatan</th>
									<th colspan="2">Tingkat Tahun Sekolah</th>
									<th rowspan="2" width="50%">Nama Sekolah/Universitas</th>
									<th rowspan="2" width="50%">Tempat</th>
									<th rowspan="2" width="50%">Fakultas</th>
									<th rowspan="2" width="50%">Jurusan</th>
									<th rowspan="2" width="50%">IPK</th>
									<th rowspan="2" width="50%">Keterangan</th>
								</tr>
								<tr>
									<th>Start</th>
									<th>Ending</th>
								</tr>';
								$no = 1;
								for ($i=1; $i <= 4; $i++) { 
									$sql = "SELECT 
										COUNT(a.id) AS banyak,
										CASE a.tingkatan WHEN '1' THEN 'SMA' WHEN '2' THEN 'AKADEMI' WHEN '3' THEN 'SARJANA' WHEN '4' THEN 'PASCASARJANA' ELSE NULL END AS tingkatan,
										a.tahun_mulai,
										a.tahun_selesai,
										a.nama_instansi,
										a.tempat,
										a.fakultas,
										b.jurusan,
										a.ipk,
										a.keterangan
										FROM tb_pend_formal a
										LEFT JOIN tb_jurusan b ON a.jurusan=b.id
										WHERE a.tingkatan='".$i."' AND a.id_pelamar='".$idPelamar."'";
									$query = mysql_query($sql);
									$result = mysql_fetch_array($query);
									if($result["banyak"] != 0)
									{
										$html .= '
											<tr>
												<td class="text-center">'.$no.'</td>
												<td>'.$result["tingkatan"].'</td>
												<td class="text-center">'.$result["tahun_mulai"].'</td>
												<td class="text-center">'.$result["tahun_selesai"].'</td>
												<td>'.$result["nama_instansi"].'</td>
												<td>'.$result["tempat"].'</td>
												<td>'.$result["fakultas"].'</td>
												<td>'.$result["jurusan"].'</td>
												<td class="text-center">'.$result["ipk"].'</td>
												<td>';
													$expected_space = ceil(strlen($result["keterangan"])/40);
													$pieces_keterangan = explode(" ", $result["keterangan"]);
													if(sizeof($pieces_keterangan) < $expected_space)
													{
														$keterangan_length = strlen($result["keterangan"]);
														$keterangan_char = str_split($result["keterangan"]);
														for ($i=0; $i < $keterangan_length ; $i++) { 
															$html .= $keterangan_char[$i];
															if($i % 40 == 0 && $i != 0)
															{
																$html .= "-<br>";
															}
														}
													} else
													{
														$html .= $result["keterangan"];
													}
												$html .= '</td>
											</tr>
										';
										$no++;
									}
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="10">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2">2.</i></span></td>
	        			<td>
							Pendidikan Informal (Kursus/Pelatihan)<br>
							<div class="smaller"><i>Informal Education (Course/Training)</i></div>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th width="50%">No.</th>
									<th width="50%">Jenis Kursus/Pelatihan</th>
									<th width="50%">Tempat</th>
									<th colspan="2">Periode</th>
									<th width="50%">Keterangan</th>
								</tr>';
								$no = 1;
								$sql = "SELECT 
									jenis_kursus,tempat,DATE_FORMAT(periode_awal,'%d %b %Y') AS periode_awal,DATE_FORMAT(periode_akhir,'%d %b %Y') AS periode_akhir,keterangan
									FROM tb_pend_informal
									WHERE id_pelamar='".$idPelamar."'";
								$query = mysql_query($sql);
								while($result = mysql_fetch_array($query))
								{
									$html .= '
										<tr>
											<td class="text-center">'.$no.'</td>
											<td>'.$result["jenis_kursus"].'</td>
											<td>'.$result["tempat"].'</td>
											<td class="text-center">'.$result["periode_awal"].'</td>
											<td class="text-center">'.$result["periode_akhir"].'</td>
											<td>';
												$expected_space = ceil(strlen($result["keterangan"])/40);
												$pieces_keterangan = explode(" ", $result["keterangan"]);
												if(sizeof($pieces_keterangan) < $expected_space)
												{
													$keterangan_length = strlen($result["keterangan"]);
													$keterangan_char = str_split($result["keterangan"]);
													for ($i=0; $i < $keterangan_length ; $i++) { 
														$html .= $keterangan_char[$i];
														if($i % 40 == 0 && $i != 0)
														{
															$html .= "-<br>";
														}
													}
												} else
												{
													$html .= $result["keterangan"];
												}
											$html .= '</td>
										</tr>
									';
									$no++;
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="6">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2">3.</i></span></td>
	        			<td>
							Bahasa Asing<br>
							<div class="smaller"><i>Foreign Languages</i></div>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th rowspan="2" width="50%">No.</th>
									<th rowspan="2" width="50%">Bahasa</th>
									<th colspan="3">Lisan</th>
									<th colspan="3">Tertulis</th>
								</tr>
								<tr>
									<th>Kurang</th>
									<th>Cukup</th>
									<th>Baik</th>
									<th>Kurang</th>
									<th>Cukup</th>
									<th>Baik</th>
								</tr>';
								$no = 1;
								$sql = "SELECT 
									bahasa,
									IF(lisan='1','<img height=10px src=img/check.png>','') AS lisan_kurang,
									IF(lisan='2','<img height=10px src=img/check.png>','') AS lisan_cukup,
									IF(lisan='3','<img height=10px src=img/check.png>','') AS lisan_baik,
									IF(tertulis='1','<img height=10px src=img/check.png>','') AS tertulis_kurang,
									IF(tertulis='2','<img height=10px src=img/check.png>','') AS tertulis_cukup,
									IF(tertulis='3','<img height=10px src=img/check.png>','') AS tertulis_baik
									FROM tb_bahasa_asing 
									WHERE id_pelamar='".$idPelamar."'";
								$query = mysql_query($sql);
								while($result = mysql_fetch_array($query))
								{
									$html .= '
										<tr>
											<td class="text-center">'.$no.'</td>
											<td>'.$result["bahasa"].'</td>
											<td class="text-center">'.$result["lisan_kurang"].'</td>
											<td class="text-center">'.$result["lisan_cukup"].'</td>
											<td class="text-center">'.$result["lisan_baik"].'</td>
											<td class="text-center">'.$result["tertulis_kurang"].'</td>
											<td class="text-center">'.$result["tertulis_cukup"].'</td>
											<td class="text-center">'.$result["tertulis_baik"].'</td>
										</tr>
									';
									$no++;
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="8">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
		<tr><td height="20px"></td></tr>
<!-- PENDIDIKAN ISI - SELESAI -->

<!-- STATUS KELUARGA ISI - MULAI -->
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>III.</b></td>
						<td><b>STATUS KELUARGA / <i>FAMILY STATUS</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="td-isi">
				<table width="100%">
	        		<tr>
	        			<td class="isi-width">Status Perkawinan<br><span class="smaller"><i>Marital Status</i></span></td>';
	        			$sql = "SELECT CASE STATUS WHEN '1' THEN 'LAJANG' WHEN '2' THEN CONCAT('BERTUNANGAN SEJAK ',sejak) WHEN '3' THEN CONCAT('MENIKAH SEJAK ',sejak) WHEN '4' THEN CONCAT('BERCERAI SEJAK ',sejak) ELSE '-' END AS status_perkawinan
							FROM tb_status_keluarga
							WHERE id_pelamar='".$idPelamar."'";
						$query = mysql_query($sql);
						$result = mysql_fetch_array($query);
						$result["status_perkawinan"] == ""? $status_perkawinan = "-":$status_perkawinan = $result['status_perkawinan'];
	        			$html .= '<td>'.$status_perkawinan.'</td>';
	        		$html .= '</tr>
	        	</table>
	        </td>
	    </tr>
		<tr><td height="20px"></td></tr>
<!-- STATUS KELUARGA ISI - SELESAI -->

<!-- RIWAYAT PEKERJAAN ISI - MULAI -->
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>IV.</b></td>
						<td><b></span>RIWAYAT PEKERJAAN / <i>OCCUPATIONAL BACKGROUND</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td>
							Pengalaman Kerja<br>
							<div class="smaller"><i>Work Experience</i></div>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th width="50%">No.</th>
									<th width="50%">Perusahaan</th>
									<th width="50%">Bisnis Perusahaan</th>
									<th colspan="2">Periode</th>
									<th width="50%">Posisi</th>
									<th width="50%">Jumlah Bawahan</th>
									<th width="50%">Gaji Terakhir</th>
									<th width="50%">Alasan Pindah</th>
									<th width="50%">Deskripsi</th>
								</tr>';
								$no = 1;
								$sql = "SELECT
									a.perusahaan,
									UPPER(b.bidang_bisnis) AS bidang_bisnis,
									DATE_FORMAT(a.periode_awal,'%d-%m-%Y') AS periode_awal,
									DATE_FORMAT(a.periode_akhir,'%d-%m-%Y') AS periode_akhir,
									a.posisi,
									a.jumlah_bawahan,
									a.gaji_terakhir,
									a.alasan_pindah,
									a.deskripsi_pekerjaan
									FROM tb_riwayat_pekerjaan a
									LEFT JOIN tb_struktur_bidang_bisnis b ON a.id_bidang_bisnis=b.id
									WHERE a.id_pelamar='".$idPelamar."'";
								$query = mysql_query($sql);
								while($result = mysql_fetch_array($query))
								{
									$html .= '
										<tr>
											<td class="text-center">'.$no.'</td>
											<td>'.$result["perusahaan"].'</td>
											<td>'.$result["bidang_bisnis"].'</td>
											<td class="text-center">'.$result["periode_awal"].'</td>
											<td class="text-center">'.$result["periode_akhir"].'</td>
											<td>'.$result["posisi"].'</td>
											<td class="text-center">'.$result["jumlah_bawahan"].'</td>
											<td>Rp. '.number_format($result["gaji_terakhir"]).',-</td>
											<td>';
												$expected_space = ceil(strlen($result["alasan_pindah"])/40);
												$pieces_alasan_pindah = explode(" ", $result["alasan_pindah"]);
												if(sizeof($pieces_alasan_pindah) < $expected_space)
												{
													$alasan_pindah_length = strlen($result["alasan_pindah"]);
													$alasan_pindah_char = str_split($result["alasan_pindah"]);
													for ($i=0; $i < $alasan_pindah_length ; $i++) { 
														$html .= $alasan_pindah_char[$i];
														if($i % 40 == 0 && $i != 0)
														{
															$html .= "-<br>";
														}
													}
												} else
												{
													$html .= $result["alasan_pindah"];
												}
											$html .= '</td>
											<td>';
												$expected_space = ceil(strlen($result["deskripsi_pekerjaan"])/40);
												$pieces_deskripsi_pekerjaan = explode(" ", $result["deskripsi_pekerjaan"]);
												if(sizeof($pieces_deskripsi_pekerjaan) < $expected_space)
												{
													$deskripsi_pekerjaan_length = strlen($result["deskripsi_pekerjaan"]);
													$deskripsi_pekerjaan_char = str_split($result["deskripsi_pekerjaan"]);
													for ($i=0; $i < $deskripsi_pekerjaan_length ; $i++) { 
														$html .= $deskripsi_pekerjaan_char[$i];
														if($i % 40 == 0 && $i != 0)
														{
															$html .= "-<br>";
														}
													}
												} else
												{
													$html .= $result["deskripsi_pekerjaan"];
												}
											$html .= '</td>
										</tr>
									';
									$no++;
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="10">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
		<tr><td height="20px"></td></tr>
<!-- RIWAYAT PEKERJAAN ISI - SELESAI -->

<!-- MINAT DAN HARAPAN ISI - MULAI -->
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>V.</b></td>
						<td><b></span>MINAT DAN HARAPAN / <i>INTEREST AND EXPECTATION</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th rowspan="2" width="50%">No.</th>
									<th colspan="3">Preferensi Lokasi</th>
									<th rowspan="2" width="50%">Gaji Bulanan</th>
									<th rowspan="2" width="50%">Bidang Bisnis</th>
									<th rowspan="2" width="50%">Spesialisasi</th>
									<th rowspan="2" width="50%">Posisi Kerja</th>
									<th rowspan="2" width="50%">Level Jabatan</th>
								</tr>
								<tr>
									<th>Negara</th>
									<th>Provinsi</th>
									<th>Kota</th>
								</tr>';
								$no = 1;
								$sql = "SELECT
									b.negara,c.bagian,d.kota,a.gaji_nominal,e.bidang_bisnis,f.fungsi_kerja,g.posisi_kerja,h.level_jabatan
									FROM tb_minat a
									LEFT JOIN tb_negara b ON a.lokasi_negara=b.id
									LEFT JOIN tb_negara_bagian c ON a.lokasi_provinsi=c.id
									LEFT JOIN tb_kota d ON a.lokasi_kota=d.id
									LEFT JOIN tb_struktur_bidang_bisnis e ON a.bidang_bisnis=e.id
									LEFT JOIN tb_struktur_fungsi_kerja f ON a.fungsi_kerja=f.id
									LEFT JOIN tb_struktur_posisi_kerja g ON a.posisi_kerja=g.id
									LEFT JOIN tb_struktur_level_jabatan h ON a.level_jabatan=h.id
									WHERE a.id_pelamar='".$idPelamar."'";
								$query = mysql_query($sql);
								while($result = mysql_fetch_array($query))
								{
									$html .= '
										<tr>
											<td class="text-center">'.$no.'</td>
											<td>'.$result["negara"].'</td>
											<td>'.$result["bagian"].'</td>
											<td>'.$result["kota"].'</td>
											<td>Rp. '.number_format($result["gaji_nominal"]).',-</td>
											<td>'.$result["bidang_bisnis"].'</td>
											<td>'.$result["fungsi_kerja"].'</td>
											<td>'.$result["posisi_kerja"].'</td>
											<td>'.$result["level_jabatan"].'</td>
										</tr>
									';
									$no++;
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="9">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
		<tr><td height="20px"></td></tr>
<!-- MINAT DAN HARAPAN ISI - SELESAI -->

<!-- AKTIVITAS SOSIAL - MULAI -->
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>VI.</b></td>
						<td><b></span>AKTIVITAS SOSIAL / <i>SOCIAL ACTIVITIES</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>';
			$sql = "SELECT * FROM tb_soc_act WHERE id_pelamar='".$idPelamar."' AND type='1'";
			$query = mysql_query($sql);
			$olahraga = mysql_fetch_array($query);
			$olahraga["keterangan"] == ""?$olahraga = "-":$olahraga = $olahraga["keterangan"];
			$sql = "SELECT * FROM tb_soc_act WHERE id_pelamar='".$idPelamar."' AND type='2'";
			$query = mysql_query($sql);
			$hobi = mysql_fetch_array($query);
			$hobi["keterangan"] == ""?$hobi = "-":$hobi = $hobi["keterangan"];
			$html .= '<td colspan="2">
				<table width="100%" style="border-collapse: collapse;">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2" colspan="2">1.</i></span></td>
	        			<td class="isi-width td-isi">
							Olahraga<br>
							<div class="smaller"><i>Sport</div>
	        			</td>
	        			<td width="100%" class="td-isi">';
							$expected_space = ceil(strlen($olahraga)/40);
							$pieces_olahraga = explode(" ", $olahraga);
							if(sizeof($pieces_olahraga) < $expected_space)
							{
								$olahraga_length = strlen($olahraga);
								$olahraga_char = str_split($olahraga);
								for ($i=0; $i < $olahraga_length ; $i++) { 
									$html .= $olahraga_char[$i];
									if($i % 40 == 0 && $i != 0)
									{
										$html .= "-<br>";
									}
								}
							} else
							{
								$html .= $olahraga;
							}
						$html .= '</td>
	        		</tr>
	        		<tr>
	        			<td class="isi-width td-isi">
							Hobi<br>
							<div class="smaller"><i>Hobby</div>
	        			</td>
	        			<td width="100%" class="td-isi">';
							$expected_space = ceil(strlen($hobi)/40);
							$pieces_hobi = explode(" ", $hobi);
							if(sizeof($pieces_hobi) < $expected_space)
							{
								$hobi_length = strlen($hobi);
								$hobi_char = str_split($hobi);
								for ($i=0; $i < $hobi_length ; $i++) { 
									$html .= $hobi_char[$i];
									if($i % 40 == 0 && $i != 0)
									{
										$html .= "-<br>";
									}
								}
							} else
							{
								$html .= $hobi;
							}
						$html .= '</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
		<tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2">2.</i></span></td>
	        			<td>
							Organisasi<br>
							<div class="smaller"><i>Organization</div>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th width="50%">No.</th>
									<th width="50%">Organisasi</th>
									<th colspan="2">Periode</th>
									<th width="50%">Tempat</th>
									<th width="50%">Posisi</th>
									<th width="50%">Keterangan</th>
								</tr>';
								$no = 1;
								$sql = "SELECT a.*,DATE_FORMAT(a.periode_awal,'%m %b %Y') AS awal,DATE_FORMAT(a.periode_akhir,'%m %b %Y') AS akhir
									FROM tb_organisasi a
									WHERE a.id_pelamar='".$idPelamar."'";
								$query = mysql_query($sql);
								while($result = mysql_fetch_array($query))
								{
									$html .= '
										<tr>
											<td class="text-center">'.$no.'</td>
											<td>'.$result["organisasi"].'</td>
											<td class="text-center">'.$result["awal"].'</td>
											<td class="text-center">'.$result["akhir"].'</td>
											<td>'.$result["tempat"].'</td>
											<td>'.$result["posisi"].'</td>
											<td>';
												$expected_space = ceil(strlen($result["keterangan"])/40);
												$pieces_keterangan = explode(" ", $result["keterangan"]);
												if(sizeof($pieces_keterangan) < $expected_space)
												{
													$keterangan_length = strlen($result["keterangan"]);
													$keterangan_char = str_split($result["keterangan"]);
													for ($i=0; $i < $keterangan_length ; $i++) { 
														$html .= $keterangan_char[$i];
														if($i % 40 == 0 && $i != 0)
														{
															$html .= "-<br>";
														}
													}
												} else
												{
													$html .= $result["keterangan"];
												}
											$html .= '</td>
										</tr>
									';
									$no++;
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="7">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr><td height="20px"></td></tr>
<!-- AKTIVITAS SOSIAL - SELESAI -->

<!-- LAINNYA - MULAI -->
		<tr>
			<td colspan="2" class="td-header">
				<table width="100%">
					<tr>
						<td class="nomor"><b>VII.</b></td>
						<td><b>LAIN-LAIN / <i>OTHERS</i></span></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2">1.</i></span></td>
	        			<td>
							Pernahkah Anda dirawat di rumah sakit dalam 2 tahun terakhir?<br>
							<div class="smaller"><i>Have you ever been hospitalized in the last 2 years?</div>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td>
							<table width="100%" border="1" class="tabel-border">
								<tr>
									<th width="50%">No.</th>
									<th width="50%">Jenis Penyakit</th>
									<th colspan="2">Periode</th>
									<th width="50%">Pengaruh</th>
								</tr>';
								$no = 1;
								$sql = "SELECT a.*,DATE_FORMAT(a.periode_awal,'%m %b %Y') AS awal,DATE_FORMAT(a.periode_akhir,'%m %b %Y') AS akhir
									FROM tb_riwayat_penyakit a
									WHERE a.id_pelamar='".$idPelamar."'";
								$query = mysql_query($sql);
								while($result = mysql_fetch_array($query))
								{
									$html .= '
										<tr>
											<td class="text-center">'.$no.'</td>
											<td>'.$result["jenis_penyakit"].'</td>
											<td class="text-center">'.$result["awal"].'</td>
											<td class="text-center">'.$result["akhir"].'</td>
											<td>';
												$expected_space = ceil(strlen($result["pengaruh"])/40);
												$pieces_pengaruh = explode(" ", $result["pengaruh"]);
												if(sizeof($pieces_pengaruh) < $expected_space)
												{
													$pengaruh_length = strlen($result["pengaruh"]);
													$pengaruh_char = str_split($result["pengaruh"]);
													for ($i=0; $i < $pengaruh_length ; $i++) { 
														$html .= $pengaruh_char[$i];
														if($i % 40 == 0 && $i != 0)
														{
															$html .= "-<br>";
														}
													}
												} else
												{
													$html .= $result["pengaruh"];
												}
											$html .= '</td>
										</tr>
									';
									$no++;
								}
								if($no == 1)
								{
									$html .= '
											<tr>
												<td colspan="5">Tidak ada data.</td>
											</tr>
										';
								}
							$html .= '</table>
	        			</td>
	        		</tr>
	        	</table>
	        </td>
	    </tr>
	    <tr>';
			$sql = "SELECT
				CASE sumber_informasi 
				WHEN '1' THEN 'RADIO'
				WHEN '2' THEN 'GOOGLE SEARCH ENGINE'
				WHEN '3' THEN 'YAHOO SEARCH ENGINE'
				WHEN '4' THEN 'WEBSITE'
				WHEN '5' THEN 'MAJALAH'
				WHEN '6' THEN 'KORAN'
				WHEN '7' THEN 'PAMERAN'
				WHEN '8' THEN 'TEMAN'
				WHEN '9' THEN 'LAIN-LAIN'
				ELSE '-' END AS sumber
				FROM tb_informasi 
				WHERE id_pelamar='".$idPelamar."'";
			$query = mysql_query($sql);
			$informasi = mysql_fetch_array($query);
			$informasi["sumber"] == ""?$informasi = "-":$informasi = $informasi["sumber"];
			$html .= '<td colspan="2">
				<table width="100%" style="border-collapse: collapse;">
	        		<tr>
	        			<td class="nomor" valign="top" rowspan="2">2.</i></span></td>
	        			<td class="td-isi">
							Tahu informasi PT Selaras Mitra Integra dari:
	        			</td>
	        			<td width="100%" class="td-isi">&nbsp;&nbsp;&nbsp;'.$informasi.'</td>
	        		</tr>
	        		<tr>
	        	</table>
	        </td>
	    </tr>
<!-- LAINNYA - SELESAI -->
	</table>
</body>
';

	include("administrator/classes/mpdf/mpdf.php");
	$mpdf = new mPDF('en'); 
	$mpdf->SetDisplayMode('fullpage');
	$stylesheet = file_get_contents('css/cv-pelamar-pdf.css');
	$mpdf->WriteHTML($stylesheet,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output($nama,'I');
	exit;
?>