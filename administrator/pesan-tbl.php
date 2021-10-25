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
        $aColumns = array("tb_pesan.id","a.nama_lengkap","tb_pesan.email","tb_pesan.tanggal","tb_pesan.status_balas","tb_pesan.balas","tb_pesan.status_baca","'option'");


        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "tb_pesan.id";

        /* DB table to use */
        $aTable = array( "tb_pesan" );

        /* DB join field */
        $aJoin = array( );

        $qJoin = array("LEFT JOIN tb_pelamar a ON a.id=tb_pesan.from");

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
                if ( $aColumns[$i] == "'option'" )
                {
                    $colName = explode('.',$sIndexColumn);
                    if($aRow["balas"]=="")
                    {
                        $aRow["balas"] = "Belum dibalas";
                    }
                    $row[] = "<a href='#' class='pesan-balas' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Buka' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-envelope-o fa-border'></i></a> | <a class='balasan' data-balasan='".$aRow["balas"]."' data-toggle='tooltip' data-placement='top' data-original-title='Balasan' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-comment-o fa-border'></i></a> | <a class='delete' data-id='".$aRow[$colName[1]]."' data-toggle='tooltip' data-placement='top' data-original-title='Delete' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-trash-o fa-border'></i></a>";
                } else 
                {
                    /* General output */
                    $colName = explode('.',$aColumns[$i]);
                    if (strpos($colName[1], 'AS') !== FALSE)
                    {
                        $newColName = explode("AS ", $colName[1]);
                        $colName[1] = $newColName[1];        
                    }
                    if($colName[1] == "nama_lengkap" && $aRow[$colName[1]] == "")
                    {
                        $row[] = "ANONYMOUS";                        
                    } else if($colName[1] == "tanggal")
                    {
                        $row[] = "<span class='status-pesan' data-status='".$aRow["status_baca"]."'>".date_format(date_create($aRow[$colName[1]]),'d M Y, ')."Pk. ".date_format(date_create($aRow[$colName[1]]),'H:i')." WIB</span>";                     
                    } else if($colName[1] == "status_balas")
                    {
                        if($aRow[ $colName[1] ] == 1)
                        {
                            $row[] = "<i class='fa fa-check' data-toggle='tooltip' data-placement='top' data-original-title='Sudah dibalas' onmouseover=\"$(this).tooltip('show')\"></i>";                        
                        } else
                        {
                            $row[] = "<i class='fa fa-times' data-toggle='tooltip' data-placement='top' data-original-title='Belum dibalas' onmouseover=\"$(this).tooltip('show')\"></i>";                                                     
                        }
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