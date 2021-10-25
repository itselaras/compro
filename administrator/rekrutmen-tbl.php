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
            "a.id",
            "a.nama_lengkap",
            "a.jenis_kelamin AS kelamin",
            "IF(a.jenis_kelamin=1,'L','P') AS data_kelamin",
            "c.tingkatan",
            "c.tingkatan AS data_tingkatan",
            "c.ipk",
            "c.ipk AS data_ipk",
            "e.pengalaman_kerja",
            "e.pengalaman_kerja AS data_pengalaman_kerja",
            "c.jurusan",
            "d.jurusan AS data_jurusan",
            "DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(a.tgl_lahir)), '%Y') + 0 AS umur",
            "DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW()) - TO_DAYS(a.tgl_lahir)), '%Y') + 0 AS data_umur",
            "tb_rekrutmen.status",
            "'option'"
        );


        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "tb_rekrutmen.id";

        /* DB table to use */
        $aTable = array( "tb_rekrutmen" );

        /* DB join field */
        $aJoin = array( "tb_rekrutmen.id_lowongan='".$_GET["id"]."'" );

        $qJoin = array(
            "LEFT JOIN tb_pelamar a ON tb_rekrutmen.id_pelamar=a.id",
            "LEFT JOIN (SELECT id_pelamar,f.tingkatan,g.jurusan,f.ipk,(-CAST(tahun_mulai AS SIGNED)+CAST(tahun_selesai AS SIGNED)) AS lama_studi FROM tb_pend_formal f LEFT JOIN tb_jurusan g ON f.jurusan=g.id WHERE f.tingkatan=(SELECT MAX(h.tingkatan) FROM tb_pend_formal h WHERE h.id_pelamar=f.id_pelamar)) c ON a.id=c.id_pelamar",
            "LEFT JOIN tb_jurusan d ON c.jurusan=d.id",
            "LEFT JOIN (SELECT id_pelamar,SUM(DATE_FORMAT(FROM_DAYS(TO_DAYS(tb_riwayat_pekerjaan.periode_akhir)-TO_DAYS(tb_riwayat_pekerjaan.periode_awal)), '%Y') + 0) AS pengalaman_kerja FROM tb_riwayat_pekerjaan GROUP BY id_pelamar) e ON a.id=e.id_pelamar"
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
                    if($aRow["status"] == "1")
                    {
                        $terima = "<a class='response' data-konten='batalkan penerimaan' data-action='0' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Batal diterima' onmouseover=\"$(this).tooltip('show')\"><i style='color: #428bca;' class='fa fa-thumbs-up fa-border'></i></a>";
                    } else
                    {
                        $terima = "<a class='response' data-konten='menerima pelamar' data-action='1' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Terima' onmouseover=\"$(this).tooltip('show')\"><i style='color: #FF0000;' class='fa fa-thumbs-down fa-border'></i></a>";
                    }
                    $row[] = "<a class='riwayat' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Riwayat Lamaran Perusahaan' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-flag-checkered fa-border'></i></a> | ".$terima;
                }
                else
                {
                    /* General output */
                    $colName = explode('.',$aColumns[$i]);
                    $true = "<i class='fa fa-check' style='color:#5cb85c;'></i>";
                    $false = "<i class='fa fa-times' style='color:#FF0000;'></i>";
                    if (strpos($colName[1], 'AS') !== FALSE)
                    {
                        $newColName = explode("AS ", $colName[1]);
                        $colName[1] = $newColName[1];        
                    }
                    if(!isset($color))
                    {
                        $color = "#000";
                    }
                    if($colName[1] == "kelamin")
                    {
                        if($aRow["kelamin"] == $_GET["jenisKelamin"] || $_GET["jenisKelamin"] == "null")
                        {
                            $row[] = $true;
                            $color = "#5cb85c";
                        } else
                        {
                            $row[] = $false;
                            $color = "#FF0000";
                        }
                    } else if($colName[1] == "tingkatan")
                    {
                        if($aRow["tingkatan"] >= $_GET["pendidikan"] || $_GET["pendidikan"] == "null")
                        {
                            $row[] = $true;
                            $color = "#5cb85c";
                        } else
                        {
                            $row[] = $false;
                            $color = "#FF0000";
                        }
                    } else if($colName[1] == "ipk")
                    {
                        if($aRow["ipk"] >= $_GET["ipk"] || $_GET["ipk"] == "null")
                        {
                            $row[] = $true;
                            $color = "#5cb85c";
                        } else
                        {
                            $row[] = $false;
                            $color = "#FF0000";
                        }
                    } else if($colName[1] == "pengalaman_kerja")
                    {
                        if($aRow["pengalaman_kerja"] >= $_GET["pengalaman"] || $_GET["pengalaman"] == "null")
                        {
                            $row[] = $true;
                            $color = "#5cb85c";
                        } else
                        {
                            $row[] = $false;
                            $color = "#FF0000";
                        }
                    } else if($colName[1] == "jurusan")
                    {
                        if($aRow["jurusan"] == $_GET["jurusan"] || $_GET["jurusan"] == "null")
                        {
                            $row[] = $true;
                            $color = "#5cb85c";
                        } else
                        {
                            $row[] = $false;
                            $color = "#FF0000";
                        }
                    } else if($colName[1] == "umur")
                    {
                        if($aRow["umur"] <= $_GET["usia"] || $_GET["usia"] == "null")
                        {
                            $row[] = $true;
                            $color = "#5cb85c";
                        } else
                        {
                            $row[] = $false;
                            $color = "#FF0000";
                        }
                    } else if($colName[1] == "data_tingkatan")
                    {
                        $row[] = "<span style='color:".$color.";'>".cekPendidikan($aRow["data_tingkatan"])."</span>";
                    } else if(($colName[1] == "data_pengalaman_kerja")||($colName[1] == "data_umur"))
                    {
                        $row[] = "<span style='color:".$color.";'>".$aRow[ $colName[1] ]." tahun</span>";
                    } else
                    {
                        if($colName[1] == "nama_lengkap")
                        {
                        	$row[] = "<a href='#' data-id='".$aRow["id"]."' class='nama_detail' data-toggle='tooltip' data-placement='top' data-original-title='Lampiran' onmouseover=\"$(this).tooltip('show')\">".$aRow[ $colName[1] ]."</a>";
                        } else
                        {
                        	$row[] = "<span style='color:".$color.";'>".$aRow[ $colName[1] ]."</span>";                                                 	
                        }
                    }
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode( $output );
    ?>