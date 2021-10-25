<?php
		include("includes/connection.php");
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
        $aColumns = array( "tbl_image.id", "tbl_image.nama", "tbl_image.lokasi", "tbl_image.deskripsi", "'option'");

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "tbl_image.id";

        /* DB table to use */
        $aTable = array( "tbl_image" );

		/* DB join field */
        $aJoin = array( );

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
                    $sWhere = "WHERE ";
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
                    $row[] = "<a href='halaman-galeri-form?act=Edit&id=".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Edit' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-pencil fa-border'></i></a> | <a href='#' class='detail' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Detail' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-bars fa-border'></i></a> | <a href='#' class='delete' data-id='".$aRow[ $colName[1] ]."' data-toggle='tooltip' data-placement='top' data-original-title='Delete' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-trash-o fa-border'></i></a>";
                }
                else
                {
                    /* General output */
					$colName = explode('.',$aColumns[$i]);
                    if($colName[1] == 'deskripsi' && (strlen($aRow[ $colName[1] ]) > 70))
                    {
                        $row[] = substr($aRow[ $colName[1] ], 0, 69)."...";                        
                    } else
                    if ($colName[1] == 'lokasi')
                    {
                        $row[] = "<img style='width: 80px' src='../".$aRow[ $colName[1] ]."'>";
                    }
                    else
                    {
                        $row[] = $aRow[ $colName[1] ];                        
                    }
                }
            }
            $output['aaData'][] = $row;
        }

        echo json_encode( $output );
    ?>
