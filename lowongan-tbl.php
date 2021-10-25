<?php
		include("administrator/includes/connection.php");
        /*
         * Script:    DataTables server-side script for PHP and MySQL
         * Copyright: 2010 - Allan Jardine
         * License:   GPL v2 or BSD (3-point)
         */

        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array( "tb_lowongan.id", "tb_klien.perusahaan", "tb_lowongan.deskripsi_pekerjaan", "tb_struktur_bidang_bisnis.bidang_bisnis", "tb_struktur_fungsi_kerja.fungsi_kerja", "tb_struktur_posisi_kerja.posisi_kerja", "tb_struktur_level_jabatan.level_jabatan", "'option'");

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "tb_lowongan.id";

        /* DB table to use */
        $aTable = array( "tb_lowongan", "tb_klien", "tb_struktur_bidang_bisnis", "tb_struktur_fungsi_kerja", "tb_struktur_posisi_kerja", "tb_struktur_level_jabatan" );

		/* DB join field */
        $aJoin = array( "tb_lowongan.id_klien=tb_klien.id", "tb_lowongan.id_bidang_perusahaan=tb_struktur_bidang_bisnis.id", "tb_lowongan.id_function=tb_struktur_fungsi_kerja.id", "tb_lowongan.id_posisi=tb_struktur_posisi_kerja.id", "tb_lowongan.id_jabatan=tb_struktur_level_jabatan.id", "tb_lowongan.status=1" );

        /* Database connection information */
        $gaSql['user']       = $db_user;
	    $gaSql['password']   = $db_password;
	    $gaSql['db']         = $db_database;
	    $gaSql['server']     = $db_server;


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP server-side, there is
         * no need to edit below this line
         */

        /*
         * MySQL connection
         */
        $gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
            die( 'Could not open connection to server' );

        mysql_select_db( $gaSql['db'], $gaSql['link'] ) or
            die( 'Could not select database '. $gaSql['db'] );


        /*
         * Paging
         */
        $sLimit = "";
        if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
        {
            $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
                mysql_real_escape_string( $_GET['iDisplayLength'] );
        }


        /*
         * Ordering
         */
        if ( isset( $_GET['iSortCol_0'] ) )
        {
            $sOrder = "ORDER BY  ";
            for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
            {
                if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                {
                    $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                        ".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
                }
            }

            $sOrder = substr_replace( $sOrder, "", -2 );
            if ( $sOrder == "ORDER BY" )
            {
                $sOrder = "";
            }
        }


		/*
         * Table
         */
		$sTable = implode(', ',$aTable);

		/*
         * Join
         */
		if(count($aJoin) > 0) $sJoin = "WHERE ".implode(' AND ',$aJoin);
		else $sJoin = "";


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";

        // echo "Search: ".$_GET['sSearch'];

        if ( $_GET['sSearch'] != "" )
        {
			if($sJoin == "")
			{
				$sWhere = "WHERE";
			}
			else
			{
				$sWhere = "AND";
			}

			$sWhere .= " (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
				if ( $_GET['bSearchable_'.$i] == "true")
            	{
                	$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ")";
        }

        /* Individual column filtering */
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
            {
                if ( $sWhere == "" )
                {
                    $sWhere = " AND ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
            SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $aColumns)."
            FROM $sTable
			$sJoin
            $sWhere
            $sOrder
            $sLimit
        ";

        // echo $sQuery;

        $rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());

        /* Data set length after filtering */
        $sQuery = "
            SELECT FOUND_ROWS()
        ";
        $rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
        $aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
            SELECT COUNT(".$sIndexColumn.")
            FROM $sTable
			$sJoin
        ";
        $rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
        $aResultTotal = mysql_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];


        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        while ( $aRow = mysql_fetch_array( $rResult ) )
        {
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ( $aColumns[$i] == "'option'" )
                {
                    $colName = explode('.',$sIndexColumn);
					$row[] = "
                            <a href='lowongan-detail?display=".$aRow[ $colName[1] ]."' class='detail'>Detail</a>
                        "; 
                }
                else
                {
                    /* General output */
					$colName = explode('.',$aColumns[$i]);

                    if ($colName[1] == 'perusahaan') {
                        $row[] = $aRow[ $colName[1] ]."<div class='id_lowongan' data-id='".$aRow['id']."'></div>";
                    }else{
                        $row[] = $aRow[ $colName[1] ];
                    }


                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode( $output );
    ?>