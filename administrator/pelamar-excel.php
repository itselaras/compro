<?php
include('includes/connection-excel.php');
$field = array();
$cell = array("","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$nama_field[0] = "NO";
$arrayField = explode(",", $_POST["excel_field"]);
foreach ($arrayField as $key => $value) {
	switch ($value) {
		case '1':
			array_push($field, "tb_pelamar.nama_lengkap");
			$nama_field[$key+1] = "NAMA LENGKAP";
			break;
		case '2':
			array_push($field, "IF(tb_pelamar.jenis_kelamin='1','L','P') AS kelamin ");
			$nama_field[$key+1] = "JENIS KELAMIN";
			break;
		case '3':
			array_push($field, "CONCAT(DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(tb_pelamar.tgl_lahir)), '%Y') + 0,' TAHUN') AS umur");
			$nama_field[$key+1] = "USIA";
			break;
		case '4':
			array_push($field, "tb_pelamar.hp");
			$nama_field[$key+1] = "NOMOR HP";
			break;
		case '5':
			array_push($field, "CASE d.tingkatan WHEN '1' THEN 'SMA' WHEN '2' THEN 'DIPLOMA' WHEN '3' THEN 'SARJANA' WHEN '4' THEN 'PASCASARJANA' ELSE NULL END AS pendidikan_terakhir");
			$nama_field[$key+1] = "PENDIDIKAN TERAKHIR";
			break;
		case '6':
			array_push($field, "UPPER(IFNULL(d.jurusan,'-')) AS jurusan");
			$nama_field[$key+1] = "JURUSAN";
			break;
		case '7':
			array_push($field, "d.ipk");
			$nama_field[$key+1] = "IPK";
			break;
		case '8':
			array_push($field, "CONCAT(IFNULL(a.pengalaman_kerja,0),' TAHUN') AS pengalaman_kerja");
			$nama_field[$key+1] = "PENGALAMAN KERJA";
			break;
	}
}

$sql = "SELECT (@cnt := @cnt + 1) AS nomor,".implode(",", $field)." ".$_POST["query"];
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
$F->setCellValueByColumnAndRow(1, 2, "SELARAS MITRA INTEGRA")->getStyle("B2")->applyFromArray($bold);
$F->mergeCells('B2:'.$cell[(sizeof($arrayField)+2)].'2');
$F->setCellValueByColumnAndRow(1, 3, "DATA SOURCE")->getStyle("B3")->applyFromArray($bold);
$F->mergeCells('B3:'.$cell[(sizeof($arrayField)+2)].'3');
foreach ($nama_field as $key => $value) {
	$F->setCellValueByColumnAndRow($col, 5, $value)->getColumnDimension($cell[$col+1])
      ->setAutoSize(true);
	$bolded = $cell[$col+1]."5";
	$F->getStyle($bolded)->applyFromArray($bold)->applyFromArray($border)->applyFromArray($fill);
	$F->getStyle($bolded)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	if(($value=="NO")||($value=="JENIS KELAMIN")||($value=="NOMOR HP")||($value=="IPK")||($value=="LAMA STUDI")||($value=="PENGALAMAN KERJA")||($value=="USIA"))
	{
		$F->getStyle($cell[$col+1])->getAlignment()
	    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
	}
	$col++;
}

$row = 6;
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
header('Content-Disposition: attachment;filename="SMI - Data Pelamar.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');


header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header ('Cache-Control: cache, must-revalidate');
header ('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;