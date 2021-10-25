<?php include("includes/header.php"); ?>

<div class="container container-index">
    <div class="row">
        <div class="col-md-12">
            <!-- Karir Section -->
            <section id="karir">
                <div class="container-agency">
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="section-heading">Lowongan</h2>
                            <hr class="heading-line">
                        </div>
                    </div>

                    <!-- Filter Lowongan -->
                    <div class="row">
                        <div class="col-lg-12 filter-placer">
                            <div class="panel">
                                <div id="form-filter">
                                    <div class="panel-heading">Pencarian</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-group">
                                                    <label for="perusahaan">Perusahaan</label>
                                                    <small><a href="#" class="reset-perusahaan" data-nama="negara">Reset</a></small>
                                                    <div class="input-group">
                                                        <input type="text" name="perusahaan" class="form-control nama-perusahaan"  data-column="1" readonly>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default btn-perusahaan"><i class="fa fa-folder-open"></i> Pilih</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-group">
                                                    <label for="bidang">Bidang</label>
                                                    <select name="bidang_bisnis" class="form-control bidang_bisnis select-search" data-column="3">
                                                        <option value="">- - Semua - -</option>
                                                        <?php
                                                            $sql = "SELECT * FROM tb_struktur_bidang_bisnis";
                                                            $query = mysql_query($sql);
                                                            while($result = mysql_fetch_array($query))
                                                            {
                                                                $selected = "";
                                                                if($result["id"] == $edit["id_bidang_perusahaan"])
                                                                {
                                                                    $selected = "selected";
                                                                }
                                                                echo "<option value='".$result["bidang_bisnis"]."' ".$selected.">".$result["bidang_bisnis"]."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-group">
                                                    <label for="fungsi">Spesialisasi</label>
                                                    <select name="fungsi" class="form-control fungsi select-search" data-column="4">
                                                        <option value="">- - Semua - -</option>
                                                        <?php
                                                            $sql = "SELECT * FROM tb_struktur_fungsi_kerja";
                                                            $query = mysql_query($sql);
                                                            while($result = mysql_fetch_array($query))
                                                            {
                                                                echo "<option value='".$result["fungsi_kerja"]."'>".$result["fungsi_kerja"]."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="form-group">
                                                    <label for="posisi">Posisi</label>
                                                    <select name="posisi" class="form-control posisi select-search" data-column="5">
                                                        <option value="">- - Semua - -</option>
                                                        <?php
                                                            $sql = "SELECT * FROM tb_struktur_posisi_kerja";
                                                            $query = mysql_query($sql);
                                                            while($result = mysql_fetch_array($query))
                                                            {
                                                                $selected = "";
                                                                if($result["id"] == $edit["id_posisi"])
                                                                {
                                                                    $selected = "selected";
                                                                }
                                                                echo "<option value='".$result["posisi_kerja"]."' ".$selected.">".$result["posisi_kerja"]."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Table Lowongan -->

                    <div class="row">
                        <div class="col-md-12 table-placer">
                            <div class="table-responsive">
                                <table id="karir-table" class="table table-hover table-striped">
                                    <thead>
                                        <tr class="center">
                                            <th></th>
                                            <th>Perusahaan</th>
                                            <th width="50%" >Detail</th>
                                            <th>Bidang</th>
                                            <th>Spesialisasi</th>
                                            <th>Posisi</th>
                                            <th></th>
                                            <th width="80px" class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>


<div id="modal-form" data-backdrop="static" class="modal fade perusahaan-filter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">List Perusahaan</h4>
            </div>
            <div class="modal-body">
                <table id="my-table" class="table table-bordered table-hover table-condensed table-nopadding">
                    <thead>
                        <tr class="center">
                            <th>#</th>
                            <th class="text-center">Data</th>
                            <th class="text-center" width="15%">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var data = [];
    var data_lowongan;
    
    $(document).ready(function() {
        data_lowongan = $('#karir-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},
                { "bSearchable": true, "bSortable": true },
                { "bSearchable": true, "bSortable": true },
                { "bSearchable": true, "bSortable": true },
                { "bSearchable": true, "bSortable": true },
                { "bSearchable": true, "bSortable": true },
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false}
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "bLengthChange": true,
            "sAjaxSource": "lowongan-tbl",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": true,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });

        $('#form-filter').on('change', '.select-search', function(event) {
            event.preventDefault();
            data_lowongan.api().column($(this).data('column')).search($(this).val()).draw();
        });

        $('#karir-table').on('click', 'tr', function(event) {
            event.preventDefault();
            var id_lowongan = $(this).find('.id_lowongan').data('id');
            if (id_lowongan!=undefined) {
                window.open('karir-detail?display='+id_lowongan);
            }
        });

        $('.btn-perusahaan').click(function(event) {
            action = 'perusahaan';
            $('#modal-form').modal('show');
            if(data == '')
            {
                data = $('#my-table').dataTable({
                    "aoColumns": [
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false},        
                        { "bSearchable": true, "bSortable": true },     
                        { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false }        
                    ],
                    "aaSorting": [[ 1, "asc" ]],
                    "iDisplayLength": 10,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "administrator/klien-tbl?act=lowongan",
                    "bPaginate": true,
                    "bSort": true,
                    "bAutoWidth": false,
                    "fnServerData": function( sSource, aoData, fnCallback ){                           
                        $.getJSON( sSource, aoData, function (json) {
                            fnCallback(json);
                        });
                    }
                });
            }
            if(data != '' && action == 'perusahaan')
            {
                data.fnNewAjax( "administrator/klien-tbl?act=lowongan" );
            }
        });

        $('#modal-form').on('click', '.pilih-perusahaan', function(event) {
            event.preventDefault();
            $('.nama-perusahaan').val($(this).data("nama"));
            $('#modal-form').modal('hide');
            data_lowongan.api().column($('.nama-perusahaan').data('column')).search($('.nama-perusahaan').val()).draw();
        });

        $('.reset-perusahaan').click(function(event) {
            $('.nama-perusahaan').val('');
            $('.nama-perusahaan').keyup();
            data_lowongan.api().column($('.nama-perusahaan').data('column')).search($('.nama-perusahaan').val()).draw();
            return false;
        });
    });
</script>