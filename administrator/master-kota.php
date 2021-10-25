<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-bar-chart-o"></i> Kota</h1>
        </div>
    </div>
    <a href="#" class="btn btn-success tambah"><i class="fa fa-refresh fa-fw"></i> <span class="btn-name">Tampilkan Data</span></a>
    <hr>
    <div class="container-tambah">
        <table id="my-table" class="table table-bordered table-striped">
            <thead>
                <tr class="center">
                    <th>#</th>
                    <th class="text-center">Negara</th>
                    <th class="text-center">Provinsi / Negara Bagian</th>
                    <th class="text-center">Option</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="container-tambah invisible">
        <table id="provinsi-table" class="table table-bordered table-striped">
            <thead>
                <tr class="center">
                    <th>#</th>
                    <th class="text-center">Provinsi / Negara Bagian</th>
                    <th class="text-center">Kota</th>
                    <th class="text-center">Option</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script type="text/javascript">
    var dataTambah, dataTampil;
    var count = 1; 
    $(document).ready(function() {
        dataTambah = $('#my-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": false, "bSortable": false, "bVisible":false },     
                { "bSearchable": true, "bSortable": true },        
                { "bSearchable": false, "bSortable": false, "sClass": "text-center" }       
            ],
            "aaSorting": [[ 2, "asc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "master-provinsi-tbl?source=kota",
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });
        $('.tambah').click(function(event) {       
            $('.container-tambah').slideToggle('slow',function(){
                if(count % 2 == 0)
                {
                    $('.btn-name').html('Tambah Data');
                    $('.btn-name').closest('a').removeClass('btn-success').addClass('btn-primary');
                    if(dataTampil == undefined)
                    {
                        dataTampil = $('#provinsi-table').dataTable({
                            "aoColumns": [
                                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible": false},        
                                { "bSearchable": true, "bSortable": true },     
                                { "bSearchable": true, "bSortable": true },        
                                { "bSearchable": false, "bSortable": false, "bVisible":false }        
                            ],
                            "aaSorting": [[ 1, "asc" ],[2,"asc"]],
                            "iDisplayLength": 10,
                            "bProcessing": true,
                            "bServerSide": true,
                            "sAjaxSource": "master-kota-tbl?source=kota",
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
                } else
                {
                    $('.btn-name').html('Tampilkan Data');
                    $('.btn-name').closest('a').removeClass('btn-primary').addClass('btn-success');
                }
            });
            count++;
        });
    });
</script>