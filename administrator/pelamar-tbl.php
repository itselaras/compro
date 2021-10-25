<?php
        include("includes/connection.php");
        include("includes/function.php");
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
        $aColumns = array( 
            "tb_pelamar.id", 
            "tb_pelamar.nama_lengkap", 
            "CASE tb_pelamar.jenis_kelamin WHEN '1' THEN 'L' WHEN '2' THEN 'P' ELSE '-' END AS kelamin",
            "DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(tb_pelamar.tgl_lahir)), '%Y') + 0 AS umur", 
            "tb_pelamar.hp",
            "d.tingkatan",
            "IFNULL(d.jurusan,'-') AS jurusan",
            "d.ipk",
            // "d.lama_studi",
            "IFNULL(a.pengalaman_kerja,0) AS pengalaman_kerja", 
            "'check'",
            "'delete'"
        );


        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "tb_pelamar.id";

        /* DB table to use */
        $aTable = array( "tb_pelamar" );

        /* DB join field */
        $aJoin = array( "tb_pelamar.nama_lengkap != ''" );

        $qJoin = array(
            "LEFT JOIN (SELECT id_pelamar,SUM(DATE_FORMAT(FROM_DAYS(TO_DAYS(tb_riwayat_pekerjaan.periode_akhir)-TO_DAYS(tb_riwayat_pekerjaan.periode_awal)), '%Y') + 0) AS pengalaman_kerja FROM tb_riwayat_pekerjaan GROUP BY id_pelamar) a ON tb_pelamar.id=a.id_pelamar",
            "LEFT JOIN (SELECT id_pelamar,b.tingkatan,c.jurusan,b.ipk,(-CAST(tahun_mulai AS SIGNED)+CAST(tahun_selesai AS SIGNED)) AS lama_studi FROM tb_pend_formal b LEFT JOIN tb_jurusan c ON b.jurusan=c.id WHERE b.tingkatan=(SELECT MAX(e.tingkatan) FROM tb_pend_formal e WHERE e.id_pelamar=b.id_pelamar)) d ON tb_pelamar.id=d.id_pelamar"
        );

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
                    if (strpos($aColumns[ intval( $_GET['iSortCol_'.$i] ) ], 'AS') !== FALSE)
                    {
                        $newOrder = explode("AS ", $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]);
                        $orderCol = $newOrder[1];        
                    } else
                    {
                        $orderCol = $aColumns[ intval( $_GET['iSortCol_'.$i] ) ];
                    }
                    $sOrder .= $orderCol."
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
        if(count($aJoin) > 0) $sJoin = implode(' ',$qJoin)." WHERE ".implode(' AND ',$aJoin);
        else $sJoin = implode(' ', $qJoin);


        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";

        if ( $_GET['sSearch'] != "" )
        {
            if($sJoin == implode(' ', $qJoin))
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
                    if (strpos($aColumns[$i], 'AS') !== FALSE)
                    {
                        $newSearch = explode(" AS", $aColumns[$i]);
                        $searchCol = $newSearch[0];        
                    } else
                    {
                        $searchCol = $aColumns[$i];
                    }
                    $sWhere .= $searchCol." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
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
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                if (strpos($aColumns[$i], 'AS') !== FALSE)
                {
                    $newSearchInd = explode(" AS", $aColumns[$i]);
                    $searchColInd = $newSearchInd[0];        
                } else
                {
                    $searchColInd = $aColumns[$i];
                }
                $sWhere .= $searchColInd." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
            }
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sQuery = "
            SELECT SQL_CALC_FOUND_ROWS ".implode(", ", $aColumns)." 
            FROM 
            $sTable 
            $sJoin 
            $sWhere 
            $sOrder 
            $sLimit
        ";

        $sqlQuery = " FROM ".$sTable." CROSS JOIN (SELECT @cnt := 0) AS dummy ".$sJoin." ".$sWhere;
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
                if ( $aColumns[$i] == "'check'" )
                {
                    $colName = explode('.',$sIndexColumn);
                    $row[] = "<a href='#' style='opacity: 0.2;' class='pilih'><i class='fa fa-check-square-o'></i><input type='checkbox' class='terpilih invisible' value='".$aRow[ $colName[1] ]."'></a>";
                }
                else if ( $aColumns[$i] == "'delete'" )
                {
                    $colName = explode('.',$sIndexColumn);
                    $row[] = "<a href='#' data-id='".$aRow[ $colName[1] ]."' class='detail' data-toggle='tooltip' data-placement='top' data-original-title='Lampiran' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-bars fa-border'></i></a> | <a href='#' class='riwayat' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Riwayat Semua Lamaran' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-flag fa-border'></i></a> | <a href='#' class='delete' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Delete' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-trash-o fa-border'></i></a>";
                }
                else 
                {
                    /* General output */
                    $colName = explode('.',$aColumns[$i]);
                    if (strpos($colName[1], 'AS') !== FALSE)
                    {
                        $newColName = explode("AS ", $colName[1]);
                        $colName[1] = $newColName[1];        
                    }
                    if($colName[1] == "tingkatan")
                    {
                        $row[] = cekPendidikan($aRow[ $colName[1] ]);                        
                    } else if(($colName[1] == "umur")||($colName[1] == "pengalaman_kerja")||($colName[1] == "lama_studi"))
                    {
                        $row[] = $aRow[ $colName[1] ]." tahun";                        
                    } else
                    {
                        $row[] = $aRow[ $colName[1] ];                        
                    }
                }
            }
            $output['aaData'][] = $row;
        }

        $output['sqlQuery'] = $sqlQuery;

        echo json_encode( $output );
    ?>