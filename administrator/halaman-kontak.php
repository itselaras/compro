<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-desktop"></i> Kontak</h1>
        </div>
    </div>
    <a href="#" class="btn btn-primary tambah-kontak"><i class="fa fa-plus-square fa-fw"></i> Tambah Kontak</a>
    <hr>
    <table id="my-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tipe Office</th>
                <th>Nama Office</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM tb_kontak";
                $query = mysql_query($sql);
                while($result = mysql_fetch_array($query))
                {
                    echo "<tr>";
                        echo "<td>".tipeOffice($result["tipe_office"])."</td>";
                        echo "<td>".$result["nama_office"]."</td>";
                        echo "<td>";
                            echo "<a href='#' class='edit' data-id='".$result["id"]."' data-toggle='tooltip' data-placement='top' data-original-title='Edit' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-pencil fa-border'></i></a> ";
                            echo " | <a href='#' class='detail' data-id='".$result["id"]."' data-toggle='tooltip' data-placement='top' data-original-title='Detail' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-bars fa-border'></i></a> ";
                            echo " | <a href='#' class='hapus' data-id='".$result["id"]."' data-toggle='tooltip' data-placement='top' data-original-title='Delete' onmouseover=\"$(this).tooltip('show')\"><i class='fa fa-trash-o fa-border'></i></a>";
                        echo "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php include("includes/footer.php"); ?>

<!-- Modal -->
<div id="modal-kontak" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Kontak</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control id-edit">
                <div class="form-group">
                    <label>Tipe Office</label>
                    <select class="form-control tipe-office">
                        <option value="">- - Pilih tipe office - -</option>
                        <option value="1">Head Office</option>
                        <option value="2">Representative Office</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Office</label>
                    <input type="text" class="form-control nama-office">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea class="form-control alamat"></textarea>
                </div>
                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" class="form-control telepon">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control email">
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" class="form-control website">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-save">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-detail" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Detail Kontak</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Tipe Office</td>
                            <td>:</td>
                            <td class="det-tipe-office"></td>
                        </tr>
                        <tr>
                            <td>Nama Office</td>
                            <td>:</td>
                            <td class="det-nama-office"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td class="det-alamat"></td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>:</td>
                            <td class="det-telepon"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td class="det-email"></td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td>:</td>
                            <td class="det-website"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var data;
    function kosong(){
        $('.form-control').each(function() {
            $(this).val('');
        });
    }
    $(document).ready(function() {
        data = $('#my-table').dataTable({
            "aoColumns": [       
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": true, "bSortable": false },        
                { "bSearchable": false, "bSortable": false, "sClass": "text-center" }        
            ],
            "aaSorting": [[ 0, "asc" ]],
            "iDisplayLength": 10,
            "bProcessing": true,
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false
        });
        $('.tambah-kontak').click(function(event) {
            kosong();
            $('#modal-kontak').modal('show');
        });
        $('.btn-save').click(function(event) {
            if($('.tipe-office').val() != '')
            {
                $.ajax({
                    url: 'halaman-act',
                    type: 'POST',
                    data: {
                        idEdit: $('.id-edit').val(),
                        tipeOffice: $('.tipe-office').val(),
                        namaOffice: $('.nama-office').val(),
                        alamat: $('.alamat').val(),
                        telepon: $('.telepon').val(),
                        email: $('.email').val(),
                        website: $('.website').val(),
                        field: 'kontak',
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function() {
                    console.log("success");
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                    window.location.href='halaman-kontak';
                });                
            }
        });
        $('#my-table').on('click', '.edit', function(event) {
            event.preventDefault();
            kosong();
            that = $(this);
            $('.id-edit').val(that.data('id'));
            $.ajax({
                url: 'halaman-data',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: that.data('id'),
                    field: 'kontak'
                },
            })
            .done(function(data) {
                console.log("success");
                $('.tipe-office').val(data.kodeTipeOffice);
                $('.nama-office').val(data.namaOffice);
                $('.alamat').val(data.alamat);
                $('.telepon').val(data.telepon);
                $('.email').val(data.email);
                $('.website').val(data.website);
                $('#modal-kontak').modal('show');
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $('#my-table').on('click', '.detail', function(event) {
            event.preventDefault();
            that = $(this);
            $.ajax({
                url: 'halaman-data',
                type: 'POST',
                dataType: 'json',
                data: {
                    id: that.data('id'),
                    field: 'kontak'
                },
            })
            .done(function(data) {
                console.log("success");
                $('.det-tipe-office').html(data.tipeOffice);
                $('.det-nama-office').html(data.namaOffice);
                $('.det-alamat').html(data.alamat);
                $('.det-telepon').html(data.telepon);
                $('.det-email').html(data.email);
                $('.det-website').html(data.website);
                $('#modal-detail').modal('show');
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        });
        $('#my-table').on('click', '.hapus', function(event) {
            event.preventDefault();
            that = $(this);
            bootbox.confirm("Yakin hapus data ini?", function(result) {
                if(result == true)
                {
                    $.ajax({
                        url: 'halaman-act',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            id: that.data('id'),
                            field: 'kontak',
                            action: 'hapus',
                            auth: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(data) {
                        console.log("success");
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                        window.location.href='halaman-kontak';
                    });
                } else
                {
                    Example.show("Penghapusan dibatalkan.");
                }
            });            
        });
    });
</script>

    