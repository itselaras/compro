<?php
	include("includes/connection.php");
	$sql = "SELECT a.*,IFNULL(b.nama_lengkap,'ANONYMOUS') AS nama_lengkap
		FROM tb_pesan a
		LEFT JOIN tb_pelamar b ON a.from=b.id
		WHERE a.status_baca='0' 
		ORDER BY a.tanggal 
		DESC LIMIT 3";
	$query = mysql_query($sql);
	$count = 1;
	while($result = mysql_fetch_array($query))
	{
		if($count>1)
		{
			echo '<li class="divider"></li>';
		}
		echo '
			<li>
			    <a href="pesan-baca?act=shortcut&id='.$result["id"].'" class="list-pesan" data-id="'.$result["id"].'">
			        <div>
			            <strong>'.substr($result["nama_lengkap"], 0, 20).'..</strong>
			            <span class="pull-right text-muted">
			                <em>'.date_format(date_create($result["tanggal"]),"d M y").'</em>
			            </span>
			        </div>
			        <div>'.substr($result["pesan"], 0, 50).'..</div>
			    </a>
			</li>
		';
		$count++;
	}
	echo '
		<li class="divider"></li>
		<li>
            <a class="text-center" href="pesan">
                <strong>Show All Messages</strong>
                <i class="fa fa-angle-right"></i>
            </a>
        </li>
	';
?>