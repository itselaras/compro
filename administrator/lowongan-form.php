<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));
    if(!isset($_GET["act"]))
    {
        header("Location: lowongan");
    }
    $act = "submit";
    $edit = array();
    if(isset($_POST["awal_berlaku"]) && isset($_POST["akhir_berlaku"]))
    {
        if((strtotime($_POST["awal_berlaku"]) <= strtotime(date("Y-m-d")))&&(strtotime($_POST["akhir_berlaku"]) >= strtotime(date("Y-m-d"))))
        {
            $status = "1";
        } else
        {
            $status = "0";
        }
    }
    if($_GET["act"]=="submit")
    {
        isset($_POST["kelamin"])?$kelamin=$_POST["kelamin"]:$kelamin="";
        $sql = "INSERT INTO tb_lowongan(id_bidang_perusahaan,id_klien,id_function,id_posisi,id_jabatan,awal_berlaku,akhir_berlaku,deskripsi_pekerjaan,syarat_jenis_kelamin,syarat_pendidikan,syarat_ipk,syarat_pengalaman,syarat_jurusan,syarat_usia,tanggal,status) VALUES('".$_POST["bidang_bisnis"]."','".$_POST["id-perusahaan"]."','".$_POST["fungsi"]."','".$_POST["posisi"]."','".$_POST["level_jabatan"]."','".$_POST["awal_berlaku"]."','".$_POST["akhir_berlaku"]."','".$_POST["deskripsi"]."',NULLIF('".$kelamin."',''),NULLIF('".$_POST["pendidikan"]."',''),NULLIF('".$_POST["ipk"]."',''),NULLIF('".$_POST["pengalaman"]."',''),NULLIF('".$_POST["jurusan"]."',''),NULLIF('".$_POST["usia"]."',''),DATE(NOW()),".$status.")";
        echo $sql;
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: lowongan");
        }
    }
    if($_GET["act"]=="update")
    {
        isset($_POST["kelamin"])?$kelamin=$_POST["kelamin"]:$kelamin="";
        $sql = "UPDATE tb_lowongan SET id_bidang_perusahaan='".$_POST["bidang_bisnis"]."', id_klien='".$_POST["id-perusahaan"]."', id_function='".$_POST["fungsi"]."', id_posisi='".$_POST["posisi"]."', id_jabatan='".$_POST["level_jabatan"]."',awal_berlaku='".$_POST["awal_berlaku"]."',akhir_berlaku='".$_POST["akhir_berlaku"]."',deskripsi_pekerjaan='".$_POST["deskripsi"]."',syarat_jenis_kelamin=NULLIF('".$kelamin."',''),syarat_pendidikan=NULLIF('".$_POST["pendidikan"]."',''),syarat_ipk=NULLIF('".$_POST["ipk"]."',''),syarat_pengalaman=NULLIF('".$_POST["pengalaman"]."',''),syarat_jurusan=NULLIF('".$_POST["jurusan"]."',''),syarat_usia=NULLIF('".$_POST["usia"]."',''),status='".$status."' WHERE id='".$_POST["idEdit"]."'";
        $query = mysql_query($sql);
        if($query)
        {
            header("Location: lowongan");
        }
    }
    if($_GET["act"] == "Edit")
    {
        $act = "update";
        $sql = "SELECT a.*,b.perusahaan FROM tb_lowongan a LEFT JOIN tb_klien b ON a.id_klien=b.id WHERE a.id='".$_GET["id"]."'";
        $query = mysql_query($sql);
        $edit = mysql_fetch_array($query);
    }
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-briefcase"></i> Lowongan Pekerjaan</h1>
        </div>
    </div>
    <ol class="breadcrumb text-right">
        <li><a href="lowongan">Lowongan Pekerjaan</a></li>
        <li class="active"><?php echo $_GET["act"] ?> Data</li>
    </ol>
    <form action="lowongan-form?act=<?php echo $act ?>" method="post" onsubmit="return val()">
        <?php 
            if($_GET["act"] == "Edit")
            {
                echo "<input type='hidden' name='idEdit' value='".$_GET["id"]."'>";
            }
        ?>
        <div class="form-group">
            <label>Bidang Bisnis</label>
            <select name="bidang_bisnis" class="form-control bidang_bisnis">
                <option value="">- - Pilih Bidang Bisnis - -</option>
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
                        echo "<option value='".$result["id"]."' ".$selected.">".$result["bidang_bisnis"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Perusahaan</label>
            <input type="hidden" value="<?php echo isset($edit['id_klien'])?$edit['id_klien']:'' ?>" class="id-perusahaan" name="id-perusahaan">
            <div class="input-group">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-perusahaan" type="button"><i class="fa fa-plus-circle"></i></button>
                </span>
                <input type="text" name="perusahaan" value="<?php echo isset($edit['perusahaan'])?$edit['perusahaan']:'' ?>" class="form-control nama-perusahaan" disabled="disabled" required>
            </div>
        </div>
        <div class="form-group">
            <label>Spesialisasi</label>
            <select name="fungsi" class="form-control fungsi">
                <option value="">- - Pilih Spesialisasi - -</option>
                <?php
                    $sql = "SELECT * FROM tb_struktur_fungsi_kerja";
                    $query = mysql_query($sql);
                    while($result = mysql_fetch_array($query))
                    {
                        $selected = "";
                        if($result["id"] == $edit["id_function"])
                        {
                            $selected = "selected";
                        }
                        echo "<option value='".$result["id"]."' ".$selected.">".$result["fungsi_kerja"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Posisi</label>
            <select name="posisi" class="form-control posisi">
                <option value="">- - Pilih Posisi - -</option>
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
                        echo "<option value='".$result["id"]."' ".$selected.">".$result["posisi_kerja"]."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Level Jabatan</label>
            <select name="level_jabatan" class="form-control level_jabatan">
                <option value="">- - Pilih Level Jabatan - -</option>
                <?php
                    $sql = "SELECT * FROM tb_struktur_level_jabatan";
                    $query = mysql_query($sql);
                    while($result = mysql_fetch_array($query))
                    {
                        $selected = "";
                        if($result["id"] == $edit["id_jabatan"])
                        {
                            $selected = "selected";
                        }
                        echo "<option value='".$result["id"]."' ".$selected.">".$result["level_jabatan"]."</option>";
                    }
                ?>
            </select>
        </div>

        
        <div class="row">
            <div class="col-md-6">
                <label>Awal Berlaku</label>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="awal_berlaku" class="form-control tanggal awal_berlaku" readonly="readonly" value="<?php echo isset($edit['awal_berlaku'])?$edit['awal_berlaku']:'' ?>">
                </div>
            </div>
            <div class="col-md-6">
                <label>Akhir Berlaku</label>
                <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="akhir_berlaku" class="form-control tanggal akhir_berlaku" readonly="readonly" value="<?php echo isset($edit['akhir_berlaku'])?$edit['akhir_berlaku']:'' ?>">
                </div>
            </div>
        </div>


        <div class="form-group">
            <label>Deskripsi Pekerjaan</label>
            <textarea name="deskripsi" class="form-control" id="deskripsi"><?php echo isset($edit['deskripsi_pekerjaan'])?$edit['deskripsi_pekerjaan']:'' ?></textarea>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-default btn-sm show-hide"><i class="fa fa-refresh fa-fw"></i> Filter</button>
            <span class="help-block">(Kosongkan jika tidak diperlukan)</span>
            <div class="well syarat invisible">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio">
                        <div class="col-sm-2">
                            <input type="radio" name="kelamin" class="kelamin" value="1" <?php echo isset($edit['syarat_jenis_kelamin'])?optRadio(1,$edit["syarat_jenis_kelamin"]):"" ?>>
                            Laki-laki
                        </div>
                        <div class="col-sm-2">
                            <input type="radio" name="kelamin" class="kelamin" value="2" <?php echo isset($edit['syarat_jenis_kelamin'])?optRadio(2,$edit["syarat_jenis_kelamin"]):"" ?>>
                            Perempuan
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-warning btn-xs reset-kelamin" data-toggle="tooltip" data-placement="top" data-original-title="Unselect" onmouseover="$(this).tooltip('show')"><i class="fa fa-eraser"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pendidikan Terakhir</label>
                    <select name="pendidikan" class="form-control pendidikan">
                        <option value="">- - Pilih Pendidikan - -</option>
                        <option value="1" <?php echo isset($edit["syarat_pendidikan"])?optSelect(1,$edit["syarat_pendidikan"]):"" ?>>SMA</option>
                        <option value="2" <?php echo isset($edit["syarat_pendidikan"])?optSelect(2,$edit["syarat_pendidikan"]):"" ?>>Diploma</option>
                        <option value="3" <?php echo isset($edit["syarat_pendidikan"])?optSelect(3,$edit["syarat_pendidikan"]):"" ?>>Sarjana</option>
                        <option value="4" <?php echo isset($edit["syarat_pendidikan"])?optSelect(4,$edit["syarat_pendidikan"]):"" ?>>Pascasarjana</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>IPK</label>
                    <input type="text" maxlength="5" value="<?php echo isset($edit['syarat_ipk'])?$edit['syarat_ipk']:'' ?>" name="ipk" class="form-control ipk">
                </div>
                <div class="form-group">
                    <label>Pengalaman Kerja</label> <small>(Tahun)</small>
                    <input type="text" value="<?php echo isset($edit['syarat_pengalaman'])?$edit['syarat_pengalaman']:'' ?>" name="pengalaman" class="form-control pengalaman">
                </div>
                <div class="form-group">
                    <label>Bidang Keahlian / Jurusan</label>
                    <select name="jurusan" class="form-control jurusan">
                        <option value="">- - Pilih Jurusan - -</option>
                        <?php
                            $sql = "SELECT * FROM tb_jurusan";
                            $query = mysql_query($sql);
                            while($result = mysql_fetch_array($query))
                            {
                                $selected = "";
                                if($result["id"] == $edit["syarat_jurusan"])
                                {
                                    $selected = "selected";
                                }
                                echo "<option value='".$result["id"]."' ".$selected.">".$result["jurusan"]."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Usia</label> <small>(Max)</small>
                    <input type="text" name="usia" value="<?php echo isset($edit['syarat_usia'])?$edit['syarat_usia']:'' ?>" class="form-control usia">
                </div>
        </div>
        <hr>
        <div>
            <button type="reset" class="btn btn-success reset" onclick="window.location.reload();"><i class="fa fa-refresh fa-fw"></i> Reset</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>           
        </div>
    </form> 
</div>

<?php include("includes/footer.php"); ?>

<div id="modal-form" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 70%;">
        <div class="modal-content">
            <div class="modal-body">
                <table id="my-table" class="table table-bordered table-hover table-nopadding">
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var data = [];
    function val() {
        bidangBisnis = $('.bidang_bisnis').val();
        idPerusahaan = $('.id-perusahaan').val();
        fungsi = $('.fungsi').val();
        posisi = $('.posisi').val();
        levelJabatan = $('.level_jabatan').val();
        awalBerlaku = $('.awal_berlaku').val();
        akhirBerlaku = $('.akhir_berlaku').val();
        deskripsi = CKEDITOR.instances['deskripsi'].getData();
        if(bidangBisnis==''||idPerusahaan==''||fungsi==''||posisi==''||levelJabatan==''||awalBerlaku==''||akhirBerlaku==''||deskripsi=='')
        {
            bootbox.alert('Mohon melengkapi informasi utama lowongan pekerjaan.');
            return false;
        } else
        {
            ipk = $('.ipk').val().replace(/,/g,'.');
            pengalamanKerja = $('.pengalaman').val();
            usia = $('.usia').val();
            if(new Date(awalBerlaku) > new Date(akhirBerlaku))
            {
                bootbox.alert('Awal berlaku harus lebih kecil dari akhir berlaku.');
                return false;
            } else if((ipk != '') && (ipk/ipk != 1))
            {
                bootbox.alert('Input IPK harus berupa bilangan. Mohon cek kembali.');
                return false;
            } else if((pengalamanKerja != '') && (pengalamanKerja/pengalamanKerja != 1))
            {
                bootbox.alert('Input Pengalaman Kerja harus berupa bilangan. Mohon cek kembali.');
                return false;
            } else if((usia != '') && (usia/usia != 1))
            {
                bootbox.alert('Input Usia harus berupa bilangan. Mohon cek kembali.');
                return false;
            } else
            {
                $('.ipk').val($('.ipk').val().replace(/,/g,'.'));
                return true;                
            }

        }
    }
    $(document).ready(function() {
        $('.tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true
        });
        CKEDITOR.replace( 'deskripsi', {
            toolbar : [
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'insert', items: [ 'Table', 'SpecialChar' ] },
                { name: 'styles', items: [ 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor' ] }
            ]
        });
        $('.show-hide').click(function(event) {
            $('.syarat').slideToggle('slow');
        });
        $('.reset-kelamin').click(function(event) {
            $('.kelamin').removeAttr('checked');
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
                    "sAjaxSource": "klien-tbl?act=lowongan",
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
                data.fnNewAjax( "klien-tbl?act=lowongan" );
            }
        });
        $('#modal-form').on('click', '.pilih-perusahaan', function(event) {
            event.preventDefault();
            $('.id-perusahaan').val($(this).data("id"));
            $('.nama-perusahaan').val($(this).data("nama"));
            $('#modal-form').modal('hide');
        });
    });
</script>