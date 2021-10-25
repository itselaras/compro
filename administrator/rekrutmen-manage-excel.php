<?php
include('includes/connection-excel.php');
$field = array();
$cell = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$nama_field[0] = "NO";
foreach ($_POST["selectedField"] as $key => $value) {
	switch ($value) {
		case '1':
			array_push($field, "b.nama_lengkap");
			$nama_field[$key+1] = "NAMA LENGKAP";
			break;
		case '2':
			array_push($field, "IF(b.jenis_kelamin='1','L','P') AS jenis_kelamin");
			$nama_field[$key+1] = "JENIS KELAMIN";
			break;
		case '3':
			array_push($field, "b.hp");
			$nama_field[$key+1] = "NOMOR HP";
			break;
		case '4':
			array_push($field, "CASE d.pendidikan_terakhir WHEN '1' THEN 'SMA' WHEN '2' THEN 'DIPLOMA' WHEN '3' THEN 'SARJANA' WHEN '4' THEN 'PASCASARJANA' ELSE NULL END AS pendidikan_terakhir");
			$nama_field[$key+1] = "PENDIDIKAN TERAKHIR";
			break;
		case '5':
			array_push($field, "UPPER(e.jurusan) AS jurusan");
			$nama_field[$key+1] = "JURUSAN";
			break;
		case '6':
			array_push($field, "d.ipk");
			$nama_field[$key+1] = "IPK";
			break;
		case '7':
			array_push($field, "CONCAT(d.lama_studi,' TAHUN') AS lama_studi");
			$nama_field[$key+1] = "LAMA STUDI";
			break;
		case '8':
			array_push($field, "CONCAT(f.pengalaman_kerja,' TAHUN') AS pengalaman_kerja");
			$nama_field[$key+1] = "PENGALAMAN KERJA";
			break;
		case '9':
			array_push($field, "CONCAT(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(b.tgl_lahir)), '%Y') + 0,' TAHUN') AS umur");
			$nama_field[$key+1] = "USIA";
			break;
		case '10':
			array_push($field, "IF(a.status='1','DITERIMA','TIDAK DITERIMA') AS STATUS");
			$nama_field[$key+1] = "STATUS";
			break;
	}
}

switch ($_POST["status_pelamar"]) {
	case '':
		$where = "";
		$status_penerimaan = "SEMUA PELAMAR";
		break;
	case '1':
		$where = " AND a.status='1'";
		$status_penerimaan = "PELAMAR DITERIMA";
		break;
	case '0':
		$where = " AND a.status='0'";
		$status_penerimaan = "PELAMAR TIDAK DITERIMA";
		break;
}

$sql = "SELECT (@cnt := @cnt + 1) AS nomor,".join(",",$field)."
	FROM tb_rekrutmen a
	CROSS JOIN (SELECT @cnt := 0) AS dummy
	LEFT JOIN tb_pelamar b ON a.id_pelamar=b.id
	LEFT JOIN tb_lowongan c ON a.id_lowongan=c.id
	LEFT JOIN (SELECT id_pelamar,MAX(tingkatan) AS pendidikan_terakhir,(tahun_selesai-tahun_mulai) AS lama_studi,jurusan,ipk FROM tb_pend_formal GROUP BY id_pelamar) d ON a.id_pelamar=d.id_pelamar
	LEFT JOIN tb_jurusan e ON d.jurusan=e.id
	LEFT JOIN (SELECT id_pelamar,SUM(DATE_FORMAT(FROM_DAYS(TO_DAYS(tb_riwayat_pekerjaan.periode_akhir)-TO_DAYS(tb_riwayat_pekerjaan.periode_awal)), '%Y') + 0) AS pengalaman_kerja FROM tb_riwayat_pekerjaan GROUP BY id_pelamar) f ON a.id_pelamar=f.id_pelamar WHERE c.id='".$_POST["id"]."'".$where;
// echo $sql;
$query = mysqli_query($Link, $sql);

require_once 'classes/PHPExcel.php';

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Selaras Mitra Integra")
							 ->setLastModifiedBy("Selaras Mitra Integra");

$F=$objPHPExcel->getActiveSheet();

$col = 1;
$bold = array(
	'font' => array(
		'bold' => true
	)
);
$border = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);
$fill = array(
	'fill' => array(
		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		'color' => array('rgb' => 'CECECE')
	)
);
$F->setCellValueByColumnAndRow(1, 2, "LAPORAN PELAMAR (".$status_penerimaan.")")->getStyle("B2")->applyFromArray($bold);
$F->mergeCells('B2:'.$cell[(sizeof($_POST["selectedField"])+2)].'2');
$F->setCellValueByColumnAndRow(1, 3, $_POST["perusahaan"])->getStyle("B3")->applyFromArray($bold);
$F->mergeCells('B3:'.$cell[(sizeof($_POST["selectedField"])+2)].'3');
$F->setCellValueByColumnAndRow(1, 4, $_POST["bidang_bisnis"])->getStyle("B4")->applyFromArray($bold);
$F->mergeCells('B4:'.$cell[(sizeof($_POST["selectedField"])+2)].'4');
$F->setCellValueByColumnAndRow(1, 5, $_POST["fungsi_kerja"]." -> ".$_POST["posisi_kerja"]." -> ".$_POST["level_jabatan"])->getStyle("B5")->applyFromArray($bold);
$F->mergeCells('B5:'.$cell[(sizeof($_POST["selectedField"])+2)].'5');
$F->setCellValueByColumnAndRow(1, 6, "Masa berlaku lowongan : ".$_POST["masa_berlaku"])->getStyle("B6")->applyFromArray($bold);
$F->mergeCells('B6:'.$cell[(sizeof($_POST["selectedField"])+2)].'6');
foreach ($nama_field as $key => $value) {
	$F->setCellValueByColumnAndRow($col, 8, $value)->getColumnDimension($cell[$col+1])
      ->setAutoSize(true);
	$bolded = $cell[$col+1]."8";
	$F->getStyle($bolded)->applyFromArray($bold)->applyFromArray($border)->applyFromArray($fill);
	$F->getStyle($bolded)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	if(($value=="NO")||($value=="JENIS KELAMIN")||($value=="NOMOR HP")||($value=="IPK")||($value=="LAMA STUDI")||($value=="PENGALAMAN KERJA")||($value=="USIA"))
	{
		$F->getStyle($cell[$col+1])->getAlignment()
	    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
	}
	$col++;
}

$row = 9;
while($result = mysqli_fetch_assoc($query))
{	
	$col = 1;
	foreach ($result as $key => $value) {
		$F->setCellValueByColumnAndRow($col, $row, $value)->getColumnDimension($cell[$col+1])
          ->setAutoSize(true);
		$bolded = $cell[$col+1]."".$row;
		$F->getStyle($bolded)->applyFromArray($border);
		$col++;
	}
	$row++;
}

$writer = new PHPExcel_Writer_Excel5($objPHPExcel);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="SMI - Laporan Rekrutmen Tenaga Kerja '.$_POST["perusahaan"].'.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');


header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header ('Cache-Control: cache, must-revalidate');
header ('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;