<?php 
    include("includes/header.php");

    set_time_limit(0);
    cekLogin(array('2'));
?>
    <link rel="stylesheet" type="text/css" href="css/data-lamaran.css" />

    <div class="container container-index">
        <div class="row">
            <div class="col-md-12">
                <!-- Lamaran Section -->
                <section id="lamaran">
                    <div class="container-agency">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="section-heading">Data Lamaran</h2>
                                <hr class="heading-line">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 lamaran-placer">
                                <div class="lamaran-form">
                                    <div class="lamaran-kop-heading">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <h3>FORMULIR LAMARAN PEKERJAAN - 1</h3>
                                                <h5>APPLICATION FORM - 1</h5>
                                            </div>
                                        </div>
                                        <hr class="kop-hr">
                                    </div>

                                    <!-- FORM I -->
                                    <form class="form-horizontal" role="form" onsubmit="return formIdentitas()">

                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">I.</label>
                                            <label class="sub-heading">IDENTITAS / <i>IDENTITY</i></label>
                                        </div>

                                        <?php 
                                            $sqlIdentitas = "SELECT * FROM tb_pelamar WHERE id_user = ".$_SESSION['loginID'];
                                            $queryIdentitas = mysql_query($sqlIdentitas);
                                            $resultIdentitas = mysql_fetch_array($queryIdentitas);
                                        ?>

                                        <div class="lamaran-form-body">
                                            <div class="form-group">
                                                <label for="nama-lengkap" class="col-sm-2 control-label required">
                                                    <span class="main-field">Nama Lengkap</span>
                                                    <p class="english-field">Full Name</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="nama-lengkap" placeholder="Nama Lengkap" value="<?php echo $resultIdentitas['nama_lengkap'] ?>" required>
                                                </div>
                                                <label for="nama-panggilan" class="col-sm-2 control-label required">
                                                    <span class="main-field">Nama Panggilan</span>
                                                    <p class="english-field">Nick Name</p>
                                                </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control upper-text" id="nama-panggilan" placeholder="Nama Panggilan" value="<?php echo $resultIdentitas['nama_panggilan'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempat-lahir" class="col-sm-2 control-label required">
                                                    <span class="main-field">Tempat & Tanggal Lahir</span>
                                                    <p class="english-field">Place & Date of Birth</p>
                                                </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control upper-text" id="tempat-lahir" placeholder="Tempat Lahir" value="<?php echo $resultIdentitas['tempat_lahir'] ?>" required>
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="text" class="form-control upper-text" id="tgl-lahir" placeholder="YYYY-MM-DD" value="<?php echo $resultIdentitas['tgl_lahir'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenis_kelamin" class="col-sm-2 control-label required">
                                                    <span class="main-field">Jenis Kelamin</span>
                                                    <p class="english-field">Sex</p>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="row">
                                                        <?php 
                                                            if ($resultIdentitas['jenis_kelamin'] == 1) {
                                                                $radio1 = 'checked';
                                                                $radio2 = '';
                                                            }elseif ($resultIdentitas['jenis_kelamin'] == 2) {
                                                                $radio1 = '';
                                                                $radio2 = 'checked';
                                                            }
                                                        ?>
                                                        <div class="col-sm-2 radio">
                                                            <label>
                                                                <input type="radio" name="jenis-kelamin" id="jenis-kelamin" value="1" <?php echo $radio1 ?> required>
                                                                Laki-Laki
                                                                <p class="english-field">Male</p>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-2 radio">
                                                            <label>
                                                                <input type="radio" name="jenis-kelamin" id="jenis-kelamin" value="2" <?php echo $radio2 ?> required>
                                                                Perempuan
                                                                <p class="english-field">Female</p>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat" class="col-sm-2 control-label required">
                                                    <span class="main-field">Alamat</span>
                                                    <p class="english-field">Address</p>
                                                </label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control upper-text" id="alamat" placeholder="Alamat" value="<?php echo $resultIdentitas['alamat'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="negara" class="col-sm-2 control-label required">
                                                    <span class="main-field">Negara</span>
                                                    <p class="english-field">State</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control upper-text" id="negara" placeholder="Negara" value="<?php echo $resultIdentitas['negara_id'] ?>" disabled required>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button"><i class="fa fa-folder-open"></i></button>
                                                        </span>
                                                    </div>
                                                    <!-- <input type="text" class="form-control upper-text" id="negara" placeholder="Negara" value="<?php echo $resultIdentitas['negara_id'] ?>" required> -->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="provinsi" class="col-sm-2 control-label required">
                                                    <span class="main-field">Provinsi</span>
                                                    <p class="english-field">Province</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="provinsi" placeholder="Provinsi" value="<?php echo $resultIdentitas['provinsi_id'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kota" class="col-sm-2 control-label required">
                                                    <span class="main-field">Kota</span>
                                                    <p class="english-field">City</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="kota" placeholder="Kota" value="<?php echo $resultIdentitas['kota_id'] ?>" required>
                                                </div>
                                                <label for="kode-pos" class="col-sm-2 control-label required">
                                                    <span class="main-field">Kode Pos</span>
                                                    <p class="english-field">Zip Code</p>
                                                </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control upper-text" id="kode-pos" placeholder="Kode Pos" value="<?php echo $resultIdentitas['kode_pos'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon" class="col-sm-2 control-label">
                                                    <span class="main-field">Telepon</span>
                                                    <p class="english-field">Phone</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="telepon" placeholder="Telepon" value="<?php echo $resultIdentitas['telepon'] ?>">
                                                </div>
                                                <label for="hp" class="col-sm-2 control-label required">
                                                    <span class="main-field">Handphone</span>
                                                    <p class="english-field">Handphone</p>
                                                </label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control upper-text" id="hp" placeholder="Handphone" value="<?php echo $resultIdentitas['hp'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-sm-2 control-label required">
                                                    <span class="main-field">Email</span>
                                                    <p class="english-field">Email</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $resultIdentitas['email'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="agama" class="col-sm-2 control-label required">
                                                    <span class="main-field">Agama</span>
                                                    <p class="english-field">Religion</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <?php 
                                                        $option1 = '';
                                                        $option2 = '';
                                                        $option3 = '';
                                                        $option4 = '';
                                                        $option5 = '';
                                                        $option6 = '';
                                                        if ($resultIdentitas['agama'] == 1) {
                                                            $option1 = 'selected';
                                                        }elseif($resultIdentitas['agama'] == 2){
                                                            $option2 = 'selected';
                                                        }elseif($resultIdentitas['agama'] == 3){
                                                            $option3 = 'selected';
                                                        }elseif($resultIdentitas['agama'] == 4){
                                                            $option4 = 'selected';
                                                        }elseif($resultIdentitas['agama'] == 5){
                                                            $option5 = 'selected';
                                                        }elseif($resultIdentitas['agama'] == 6){
                                                            $option6 = 'selected';
                                                        }
                                                    ?>
                                                    <select class="form-control upper-text" id="agama" required>
                                                        <option value="">Pilih Agama</option>
                                                        <option <?php echo $option1; ?> value="1">Budha</option>
                                                        <option <?php echo $option2; ?> value="2">Hindu</option>
                                                        <option <?php echo $option3; ?> value="3">Islam</option>
                                                        <option <?php echo $option4; ?> value="4">Kristen Katolik</option>
                                                        <option <?php echo $option5; ?> value="5">Kristen Protestan</option>
                                                        <option <?php echo $option6; ?> value="6">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="no-identitas" class="col-sm-2 control-label required">
                                                    <span class="main-field">Nomor Identitas</span>
                                                    <p class="english-field">Identity Number</p>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="no-identitas" placeholder="KTP / SIM / Kartu Pelajar / Kartu Mahasiswa" value="<?php echo $resultIdentitas['no_identitas'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM II -->
                                    <form class="form-horizontal" role="form" onsubmit="return formPendidikan()">

                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">II.</label>
                                            <label class="sub-heading">PENDIDIKAN / <i>EDUCATION BACKGROUND</i></label>
                                        </div>
                                        <div class="lamaran-form-body">
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">1.</label>
                                                    Pendidikan Formal<br>
                                                    <i class="english-sub">Formal Education</i>
                                                </label>

                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        <table class="table table-bordered pend-formal-table add-more">
                                                            <tr>
                                                                <th rowspan="2" width="5%"><input type="checkbox" class="check-all"></th>
                                                                <th rowspan="2" width="15%">Tingkatan <p class="english-table">Level</p></th>
                                                                <th colspan="2" width="15%">Tingkatan Tahun Sekolah <p class="english-table">Years Attended</p></th>
                                                                <th rowspan="2" width="15%">Nama Sekolah/ Universitas <p class="english-table">Name of School</p></th>
                                                                <th rowspan="2">Tempat <p class="english-table">Place</p></th>
                                                                <th rowspan="2">Fakultas <p class="english-table">Faculty</p></th>
                                                                <th rowspan="2">Jurusan <p class="english-table">Major</p></th>
                                                                <th rowspan="2" width="7%">IPK <p class="english-table">GPA</p></th>
                                                                <th rowspan="2">Keterangan <p class="english-table">Remarks</p></th>
                                                            </tr>
                                                            <tr>
                                                                <th><p class="english-table">Start</p></th>
                                                                <th><p class="english-table">Ending</p></th>
                                                            </tr>

                                                            <?php 
                                                                $sqlSMU = "SELECT * FROM tb_pend_formal WHERE id_pelamar = ".$_SESSION['loginID']." AND tingkatan = 1";
                                                                $querySMU = mysql_query($sqlSMU);

                                                                if (mysql_num_rows($querySMU) < 1) {
                                                                    $checkSMU = "";
                                                                    $disabledSMU = "disabled";
                                                                }else{
                                                                    $checkSMU = "checked";
                                                                    $disabledSMU = "";
                                                                }

                                                                $resultSMU = mysql_fetch_array($querySMU);
                                                                if ($resultSMU['ipk'] == 0) {
                                                                    $ipkSMU = "";
                                                                }else{
                                                                    $ipkSMU = $resultSMU['ipk'];
                                                                }
                                                            ?>

                                                            <tr id='addr_2_1_0'>
                                                                <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkSMU ?>></td>
                                                                <td class="td-input">
                                                                    <input type="hidden" class="tingkatan-id" value="1">
                                                                    SMU 
                                                                    <p class="english-table">Senior High School</p>
                                                                </td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['tahun_mulai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['tahun_selesai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['nama_instansi'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['tempat'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['fakultas'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm jurusan" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['jurusan'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center ipk" <?php echo $disabledSMU ?> value="<?php echo $ipkSMU ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['keterangan'] ?>"></td>
                                                            </tr>

                                                            <?php 
                                                                $sqlAkademi = "SELECT * FROM tb_pend_formal WHERE id_pelamar = ".$_SESSION['loginID']." AND tingkatan = 2";
                                                                $queryAkademi = mysql_query($sqlAkademi);

                                                                if (mysql_num_rows($queryAkademi) < 1) {
                                                                    $checkAkademi = "";
                                                                    $disabledAkademi = "disabled";
                                                                }else{
                                                                    $checkAkademi = "checked";
                                                                    $disabledAkademi = "";
                                                                }

                                                                $resultAkademi = mysql_fetch_array($queryAkademi);
                                                                if ($resultAkademi['ipk'] == 0) {
                                                                    $ipkAkademi = "";
                                                                }else{
                                                                    $ipkAkademi = $resultAkademi['ipk'];
                                                                }
                                                            ?>

                                                            <tr id='addr_2_1_1'>
                                                                <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkAkademi ?>></td>
                                                                <td class="td-input">
                                                                    <input type="hidden" class="tingkatan-id" value="2">
                                                                    Akademi 
                                                                    <p class="english-table">Academy</p>
                                                                </td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['tahun_mulai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['tahun_selesai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['nama_instansi'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['tempat'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['fakultas'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm jurusan" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['jurusan'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center ipk" <?php echo $disabledAkademi ?> value="<?php echo $ipkAkademi ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['keterangan'] ?>"></td>
                                                            </tr>

                                                            <?php 
                                                                $sqlStrata = "SELECT * FROM tb_pend_formal WHERE id_pelamar = ".$_SESSION['loginID']." AND tingkatan = 3";
                                                                $queryStrata = mysql_query($sqlStrata);

                                                                if (mysql_num_rows($queryStrata) < 1) {
                                                                    $checkStrata = "";
                                                                    $disabledStrata = "disabled";
                                                                }else{
                                                                    $checkStrata = "checked";
                                                                    $disabledStrata = "";
                                                                }

                                                                $resultStrata = mysql_fetch_array($queryStrata);
                                                                if ($resultStrata['ipk'] == 0) {
                                                                    $ipkStrata = "";
                                                                }else{
                                                                    $ipkStrata = $resultStrata['ipk'];
                                                                }
                                                            ?>

                                                            <tr id='addr_2_1_2'>
                                                                <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkStrata ?>></td>
                                                                <td class="td-input">
                                                                    <input type="hidden" class="tingkatan-id" value="3">
                                                                    Strata 1 
                                                                    <p class="english-table">Under Graduate</p>
                                                                </td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['tahun_mulai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['tahun_selesai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['nama_instansi'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['tempat'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['fakultas'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm jurusan" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['jurusan'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center ipk" <?php echo $disabledStrata ?> value="<?php echo $ipkStrata ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['keterangan'] ?>"></td>
                                                            </tr>

                                                            <?php 
                                                                $sqlPasca = "SELECT * FROM tb_pend_formal WHERE id_pelamar = ".$_SESSION['loginID']." AND tingkatan = 4";
                                                                $queryPasca = mysql_query($sqlPasca);

                                                                if (mysql_num_rows($queryPasca) < 1) {
                                                                    $checkPasca = "";
                                                                    $disabledPasca = "disabled";
                                                                }else{
                                                                    $checkPasca = "checked";
                                                                    $disabledPasca = "";
                                                                }

                                                                $resultPasca = mysql_fetch_array($queryPasca);
                                                                if ($resultPasca['ipk'] == 0) {
                                                                    $ipkPasca = "";
                                                                }else{
                                                                    $ipkPasca = $resultPasca['ipk'];
                                                                }
                                                            ?>

                                                            <tr id='addr_2_1_3'>
                                                                <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkPasca ?>></td>
                                                                <td class="td-input">
                                                                    <input type="hidden" class="tingkatan-id" value="4">
                                                                    Pasca Sarjana 
                                                                    <p class="english-table">Post Graduate</p>
                                                                </td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['tahun_mulai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['tahun_selesai'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['nama_instansi'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['tempat'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['fakultas'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm jurusan" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['jurusan'] ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center ipk" <?php echo $disabledPasca ?> value="<?php echo $ipkPasca ?>"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['keterangan'] ?>"></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label for="ket" class="sub-category">
                                                    <label for="ket" class="sub-category-number">2.</label>
                                                    Pendidikan Informal (Kursus / Pelatihan)<br>
                                                    <i class="english-sub">Informal Education (Course / Training)</i>
                                                </label>

                                                <?php 
                                                    $sqlPendidInformal = "SELECT * FROM tb_pend_informal WHERE id_pelamar = ".$_SESSION['loginID'];
                                                    $queryPendInformal = mysql_query($sqlPendidInformal);
                                                    $countPendInformal = mysql_num_rows($queryPendInformal);
                                                ?>

                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        <table class="table table-bordered pend-informal-table add-more" id="tab_logic_2_2">
                                                            <tr>
                                                                <th>Nomor <p class="english-table">Number</p></th>
                                                                <th>Jenis Kursus / Pelatihan <p class="english-table">Type of Course / Training</p></th>
                                                                <th width="20%">Tempat <p class="english-table">Place</p></th>
                                                                <th width="10%">Periode <p class="english-table">Time Period</p></th>
                                                                <th>Keterangan <p class="english-table">Remarks</p></th>
                                                            </tr>

                                                            <?php
                                                                if ($countPendInformal<1) {
                                                                ?>
                                                                    <tr id='addr_2_2_0'>
                                                                        <td class="td-input text-center">1</td>
                                                                        <td class="td-input"><input type="text" class="form-control input-sm jenis-kursus"></td>
                                                                        <td class="td-input"><input type="text" class="form-control input-sm tempat"></td>
                                                                        <td class="td-input"><input id="numeric" type="text" class="form-control input-sm text-center numeric periode" placeholder="YYYY"></td>
                                                                        <td class="td-input"><input type="text" class="form-control input-sm keterangan"></td>
                                                                    </tr>
                                                                    <tr id='addr_2_2_1'></tr>
                                                                    <?php
                                                                }else{
                                                                    $barisInformal = 0;
                                                                    while ($resultPenInformal = mysql_fetch_array($queryPendInformal)) {
                                                                    ?>
                                                                        <tr id='addr_2_2_<?php echo $barisInformal ?>'>
                                                                            <td class="td-input text-center">
                                                                                <?php echo $barisInformal+=1 ?>
                                                                                <input type="hidden" class="informal-id" value="<?php echo $resultPenInformal['id'] ?>">
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm jenis-kursus" value="<?php echo $resultPenInformal['jenis_kursus'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm tempat" value="<?php echo $resultPenInformal['tempat'] ?>"></td>
                                                                            <td class="td-input"><input id="numeric" type="text" class="form-control input-sm text-center numeric periode" placeholder="YYYY" value="<?php echo $resultPenInformal['periode'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm keterangan" value="<?php echo $resultPenInformal['keterangan'] ?>"></td>
                                                                        </tr>
                                                                        <?php
                                                                        $barisInformal++;
                                                                    }
                                                                    ?>
                                                                    <tr id='addr_2_2_<?php echo $barisInformal ?>'></tr>
                                                                    <?php
                                                                }
                                                            ?>

                                                        </table>
                                                    </div>
                                                    <div class="add-field">
                                                        <a class="btn btn-default" href="#" id="add_row_2_2">Tambah</a>
                                                        <a class="btn btn-default" href="#" id="delete_row_2_2">Hapus</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label for="ket" class="sub-category">
                                                    <label for="ket" class="sub-category-number">3.</label>
                                                    Bahasa Asing<br>
                                                    <i class="english-sub">Foreign Language</i>
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        <table class="table table-bordered add-more" id="tab_logic_2_3">
                                                            <tr>
                                                                <th rowspan="2">Nomor <p class="english-table">Number</p></th>
                                                                <th rowspan="2">Bahasa <p class="english-table">Language</p></th>
                                                                <th colspan="3">Lisan <p class="english-table">Oral</p></th>
                                                                <th colspan="3">Tertulis <p class="english-table">Written</p></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Kurang <p class="english-table">Poor</p></th>
                                                                <th>Cukup <p class="english-table">Fair</p></th>
                                                                <th>Baik <p class="english-table">Good</p></th>
                                                                <th>Kurang <p class="english-table">Poor</p></th>
                                                                <th>Cukup <p class="english-table">Fair</p></th>
                                                                <th>Baik <p class="english-table">Good</p></th>
                                                            </tr>
                                                            <tr id='addr_2_3_0'>
                                                                <td class="td-input text-center">1</td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                                <td class="td-input text-center"><input type="radio" name="language-lisan-1" id="1" value="1"></td>
                                                                <td class="td-input text-center"><input type="radio" name="language-lisan-1" id="2" value="1"></td>
                                                                <td class="td-input text-center"><input type="radio" name="language-lisan-1" id="3" value="1"></td>
                                                                <td class="td-input text-center"><input type="radio" name="language-tertulis-1" id="1" value="1"></td>
                                                                <td class="td-input text-center"><input type="radio" name="language-tertulis-1" id="2" value="1"></td>
                                                                <td class="td-input text-center"><input type="radio" name="language-tertulis-1" id="3" value="1"></td>
                                                            </tr>
                                                            <tr id='addr_2_3_1'></tr>
                                                        </table>
                                                    </div>
                                                    <div class="add-field">
                                                        <a class="btn btn-default" href="#" id="add_row_2_3">Tambah</a>
                                                        <a class="btn btn-default" href="#" id="delete_row_2_3">Hapus</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM III -->
                                    <form class="form-horizontal" role="form" onsubmit="return formStatusKeluarga()">
                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">III.</label>
                                            <label class="sub-heading">STATUS KELUARGA / <i>FAMILY STATUS</i></label>
                                        </div>
                                        <div class="lamaran-form-body">
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">1.</label>
                                                    Status Perkawinan<br>
                                                    <i class="english-sub">Marital Status</i>
                                                </label>
                                                <div class="sub-padding-2 status-kawin-form">
                                                    <div class="row">
                                                        <div class="col-sm-2 radio">
                                                            <label>
                                                                <input type="radio" name="status-kawin" id="1" value="1">
                                                                <span class="main-field">Lajang</span>
                                                                <p class="english-field">Single</p>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-3 radio">
                                                            <label>
                                                                <input type="radio" name="status-kawin" class="status-kawin" id="2" value="2">
                                                                <span class="main-field">Tunangan sejak</span>
                                                                <p class="english-field">Engaged since</p>
                                                                <input type="text" class="form-control upper-text numeric" placeholder="YYYY">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-3 radio">
                                                            <label>
                                                                <input type="radio" name="status-kawin" class="status-kawin" id="3" value="3">
                                                                <span class="main-field">Menikah sejak</span>
                                                                <p class="english-field">Married since</p>
                                                                <input type="text" class="form-control upper-text numeric" placeholder="YYYY">
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-3 radio">
                                                            <label>
                                                                <input type="radio" name="status-kawin" class="status-kawin" id="4" value="4">
                                                                <span class="main-field">Bercerai sejak</span>
                                                                <p class="english-field">Divorce since</p>
                                                                <input type="text" class="form-control upper-text numeric" placeholder="YYYY">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM IV -->
                                    <form class="form-horizontal" role="form" onsubmit="return formRiwayatPekerjaan()">
                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">IV.</label>
                                            <label class="sub-heading">RIWAYAT PEKERJAAN / <i>OCCUPATIONAL BACKGROUND</i></label>
                                        </div>
                                        <div class="lamaran-form-body">
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">1.</label>
                                                    Pengalaman Kerja<br>
                                                    <i class="english-sub">Work Experience</i>
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        <table class="table table-bordered add-more" id="tab_logic_4_1">
                                                            <tr>
                                                                <th>Nomor <p class="english-table">Number</p></th>
                                                                <th>Perusahaan <p class="english-table">Company</p></th>
                                                                <th>Periode <p class="english-table">Time Period</p></th>
                                                                <th>Posisi <p class="english-table">Position</p></th>
                                                                <th>Jumlah Bawahan <p class="english-table">Number of Subordinate</p></th>
                                                                <th width="18%">Gaji Terakhir (IDR)<p class="english-table">Last Salary (IDR)</p></th>
                                                                <th>Alasan Pindah <p class="english-table">Reason for Leaving</p></th>
                                                                <th>Keterangan <p class="english-table">Remarks</p></th>
                                                            </tr>
                                                            <tr id='addr_4_1_0'>
                                                                <td class="td-input text-center">1</td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric" placeholder="YYYY"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center"></td>
                                                                <td class="td-input">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Rp</span>
                                                                        <input type="text" class="form-control text-right numeric">
                                                                        <span class="input-group-addon">.00</span>
                                                                    </div>
                                                                </td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                            </tr>
                                                            <tr id='addr_4_1_1'></tr>
                                                        </table>
                                                    </div>
                                                    <div class="add-field">
                                                        <a class="btn btn-default" href="#" id="add_row_4_1">Tambah</a>
                                                        <a class="btn btn-default" href="#" id="delete_row_4_1">Hapus</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label for="ket" class="sub-category">
                                                    <label for="ket" class="sub-category-number"></label>
                                                    Berikan gambaran mengenai jabatan-jabatan di atas pada kolom keterangan<br>
                                                    <i class="english-sub">Explain your main job for each position above in remarks column</i>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM V -->
                                    <form class="form-horizontal" role="form" onsubmit="return formMinatHarapan()">
                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">V.</label>
                                            <label class="sub-heading">MINAT DAN HARAPAN / <i>INTEREST AND EXPECTATION</i></label>
                                        </div>
                                        <div class="lamaran-form-body harapan-form">
                                            <div class="form-group">
                                                <label for="lokasi-provinsi" class="col-sm-3 sub-category control-label required">
                                                    <label class="sub-category-number">1.</label>
                                                    Preferensi lokasi yang diinginkan<br>
                                                </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control upper-text" id="lokasi-provinsi" placeholder="Provinsi">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="lokasi-kota" placeholder="Kota">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gaji-negara" class="col-sm-3 sub-category control-label required">
                                                    <label class="sub-category-number">2.</label>
                                                    Gaji Bulanan yang diharapkan<br>
                                                </label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control upper-text" id="gaji-negara" placeholder="Negara">
                                                </div>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control upper-text" id="gaji-nominal" placeholder="Nominal">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan-pekerjaan" class="col-sm-3 sub-category control-label required">
                                                    <label class="sub-category-number">3.</label>
                                                    Jabatan yang diinginkan<br>
                                                </label>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="1" value="1">
                                                                CEO/ GM/  Direktur/ Manajer Senior
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="2" value="2">
                                                                Manajer/ Asisten Manajer
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="3" value="3">
                                                                Supervisor / Koordinator
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="4" value="4">
                                                                Pegawai (non-manajemen & non supervisor)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="row">
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="5" value="5">
                                                                Lulusan baru / Pengalaman kerja kurang dari 1 tahun 
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="6" value="6">
                                                                Seorang mahasiswa yang mencari pekerjaan 
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="7" value="7">
                                                                Magang
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-12 radio">
                                                            <label>
                                                                <input type="radio" name="jabatan-pekerjaan" id="8" value="8">
                                                                Lainnya
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="kota" class="col-sm-3 sub-category control-label required">
                                                    <label class="sub-category-number">4.</label>
                                                    Jenis pekerjaan yang diharapkan<br>
                                                </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="harapan-pekerjaan">
                                                        <option value="">Pilih Harapan</option>
                                                        <option value="1">Kaya</option>
                                                        <option value="2">Sukses</option>
                                                        <option value="3">Lapang Dada</option>
                                                        <option value="4">Rajin Menabung</option>
                                                        <option value="5">Berbakat</option>
                                                        <option value="6">Lainnya</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM VI -->
                                    <form class="form-horizontal" role="form" onsubmit="return formAktifitasSosial()">
                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">VI.</label>
                                            <label class="sub-heading">AKTIVITAS SOSIAL / <i>SOCIAL ACTIVITIES</i></label>
                                        </div>
                                        <div class="lamaran-form-body">
                                            <div class="form-group">
                                                <label for="sport" class="col-sm-3 sub-category control-label required">
                                                    <label class="sub-category-number">1.</label>
                                                    Olahraga<br>
                                                    <i class="english-sub">Sport</i>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control upper-text" id="sport" placeholder="Olahraga / Sport">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="hobby" class="col-sm-3 sub-category control-label required">
                                                    <label class="sub-category-number"></label>
                                                    Hobi<br>
                                                    <i class="english-sub">Hobbies</i>
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control upper-text" id="hobby" placeholder="Hobi / Hobbies">
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">2.</label>
                                                    Organisasi<br>
                                                    <i class="english-sub">Organization</i>
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        <table class="table table-bordered add-more" id="tab_logic_6_2">
                                                            <tr>
                                                                <th>Nomor <p class="english-table">Number</p></th>
                                                                <th>Organisasi <p class="english-table">Organization</p></th>
                                                                <th>Periode <p class="english-table">Period</p></th>
                                                                <th>Tempat <p class="english-table">Place</p></th>
                                                                <th>Posisi <p class="english-table">Position</p></th>
                                                                <th>Keterangan <p class="english-table">Remarks</p></th>
                                                            </tr>
                                                            <tr id='addr_6_2_0'>
                                                                <td class="td-input text-center">1</td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric" placeholder="YYYY"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                            </tr>
                                                            <tr id='addr_6_2_1'></tr>
                                                        </table>
                                                    </div>
                                                    <div class="add-field">
                                                        <a class="btn btn-default" href="#" id="add_row_6_2">Tambah</a>
                                                        <a class="btn btn-default" href="#" id="delete_row_6_2">Hapus</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM VII -->
                                    <form class="form-horizontal" role="form" onsubmit="return formLain()">
                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">VII.</label>
                                            <label class="sub-heading">LAIN-LAIN</label>
                                        </div>
                                        <div class="lamaran-form-body">
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">1.</label>
                                                    Pernahkah Anda dirawat di rumah sakit dalam 2 tahun terakhir?<br>
                                                    <i class="english-sub">Have you ever been hospitalized in the last 2 years?</i>
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        <table class="table table-bordered add-more" id="tab_logic_7_1">
                                                            <tr>
                                                                <th>Nomor <p class="english-table">Number</p></th>
                                                                <th>Jenis Penyakit <p class="english-table">Kind of Disease</p></th>
                                                                <th>Periode <p class="english-table">Period</p></th>
                                                                <th>Pengaruh <p class="english-table">Effect</p></th>
                                                            </tr>
                                                            <tr id='addr_7_1_0'>
                                                                <td class="td-input text-center">1</td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm text-center numeric" placeholder="YYYY"></td>
                                                                <td class="td-input"><input type="text" class="form-control input-sm"></td>
                                                            </tr>
                                                            <tr id='addr_7_1_1'></tr>
                                                        </table>
                                                    </div>
                                                    <div class="add-field">
                                                        <a class="btn btn-default" href="#" id="add_row_7_1">Tambah</a>
                                                        <a class="btn btn-default" href="#" id="delete_row_7_1">Hapus</a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatan-pekerjaan" class="col-sm-12 sub-category control-label required">
                                                    <label class="sub-category-number">2.</label>
                                                    Tahu informasi  PT Selaras Mitra Intergra dari
                                                </label>
                                                <br><br>
                                                <div class="sub-padding-2">
                                                    <div class="col-sm-3">
                                                        <div class="row">
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="1" value="1">
                                                                    Radio
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="2" value="2">
                                                                    Google search engine
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="3" value="3">
                                                                    Yahoo search engine
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="row">
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="4" value="4">
                                                                    Website
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="5" value="5">
                                                                    Majalah 
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="6" value="6">
                                                                    Koran 
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="row">
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="7" value="7">
                                                                    Pameran
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="8" value="8">
                                                                    Teman
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-12 radio">
                                                                <label>
                                                                    <input type="radio" name="sumber-informasi" id="8" value="8">
                                                                    Lain-lain
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- FORM VIII -->
                                    <form class="form-horizontal" role="form" onsubmit="return formLampiran()">
                                        <div class="lamaran-form-heading">
                                            <label class="sub-heading-number">VIII.</label>
                                            <label class="sub-heading">LAMPIRAN</label>
                                        </div>
                                        <div class="lamaran-form-body">
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">1.</label>
                                                    Upload Foto Pelamar
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">2.</label>
                                                    Upload Scan Ijazah
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">3.</label>
                                                    Upload Scan Transkrip Nilai
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="field-row">
                                                <label class="sub-category">
                                                    <label class="sub-category-number">4.</label>
                                                    Upload Surat Referensi Kerja
                                                </label>
                                                <div class="sub-padding-2">
                                                    <div class="table-responsive formal-placer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="lamaran-form-footer">
                                            <div class="form-group">
                                                <div class="sub-footer">
                                                    <div class="col-sm-12 text-right">
                                                        <button type="reset" class="btn btn-default">Reset</button>
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php 
                // include("includes/sidebar.php"); 
            ?>
        </div>
    </div>

<?php include("includes/footer.php") ?>

<div class="modal fade" id="modal-confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Informasi</h4>
            </div>
            <div class="modal-body">
                <span id="console-placer"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tempat">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Pilihan Negara</h4>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    // Table Variable
    var i_2_1=4; var i_loop_2_1;
    var i_2_2=1; var i_loop_2_2;
    var i_2_3=1; var i_loop_2_3;
    var i_4_1=1; var i_loop_4_1;
    var i_6_2=1; var i_loop_6_2;
    var i_7_1=1; var i_loop_7_1;

    // I Identitas
    function formIdentitas(){
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                namaLengkap: $('#nama-lengkap').val(),
                namaPanggilan: $('#nama-panggilan').val(),
                tempatLahir: $('#tempat-lahir').val(),
                tglLahir: $('#tgl-lahir').val(),
                jenisKelamin: $('#jenis-kelamin').val(),
                alamat: $('#alamat').val(),
                negara: $('#negara').val(),
                provinsi: $('#provinsi').val(),
                kota: $('#kota').val(),
                kodePos: $('#kode-pos').val(),
                telepon: $('#telepon').val(),
                hp: $('#hp').val(),
                email: $('#email').val(),
                agama: $('#agama').val(),
                noIdentitas: $('#no-identitas').val(),
                action: 'identitas',
                auth: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                $('#console-placer').html('Data telah dirubah.');
                $('#modal-confirm').modal('show');
            }else{
                $('#console-placer').html('Data gagal dirubah.');
                $('#modal-confirm').modal('show');
            };
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    // II Pendidikan
    function formPendidikan(){
        var confirmed = 0;
        var formal_table = $('.pend-formal-table').find('.check');
        formal_table.each(function() {
            var check_tr = $(this).closest('tr');
            if(check_tr.find('.check').is(':checked')){
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        tingkatan: check_tr.find('.tingkatan-id').val(),
                        tahun_mulai: check_tr.find('.tahun-mulai').val(),
                        tahun_selesai: check_tr.find('.tahun-selesai').val(),
                        nama_instansi: check_tr.find('.nama-instansi').val(),
                        tempat: check_tr.find('.tempat').val(),
                        fakultas: check_tr.find('.fakultas').val(),
                        jurusan: check_tr.find('.jurusan').val(),
                        ipk: check_tr.find('.ipk').val(),
                        keterangan: check_tr.find('.keterangan').val(),
                        action: 'pendidikan_formal',
                        content: '1',
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    if (data == 'success') {
                        confirmed = confirmed+1;
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            }else{
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        tingkatan: check_tr.find('.tingkatan-id').val(),
                        action: 'pendidikan_formal',
                        content: '0',
                        auth: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    if (data == 'success') {
                        confirmed = confirmed+1;
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            }
        });
        return false
    };

    $(document).ready(function() {
        // Modal Tempat

        // Check All
        $('.table').on('click', '.check-all', function() {
            var that = $(this);
            var check_child = that.closest('.table').find('.check');

            if(that.is(':checked')){
                check_child.each(function(){
                    if(!$(this).is(':checked')){
                        $(this).click();
                    }
                });
                that.attr('checked','checked');
            }else{
                check_child.each(function(){
                    if($(this).is(':checked')){
                        $(this).click();
                    }
                });
                that.removeAttr('checked');
            }
        });

        // Enable input
        $('.table').on('change', '.check', function(event) {
            event.preventDefault();
            var count_all = $(this).closest('.table').find('.check').length;
            if($(this).is(':checked')){
                $(this).closest('tr').find('.input-sm').removeAttr('disabled').attr('required', 'required');;

            }else{
                $(this).closest('tr').find('.input-sm').attr('disabled', 'disabled').removeAttr('required');
            }
        });

        // Validate Number
        $('#lamaran').on('keydown', '.numeric', function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || 
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });

        // Auto Fokus Status Kawin
        $('.status-kawin-form').on('click', '.status-kawin', function() {
            $(this).closest('.radio').find('.form-control').focus();
        });

        // Tanggal Lahir
        $("#tgl-lahir").ionDatePicker({
            lang: "en",                     // language
            sundayFirst: false,             // first week day
            years: "80",                    // years diapason
            format: "YYYY-MM-DD",           // date format
        });

        // Required Field
        $('.required').find('.main-field').append('<span class="required-main-field">*</span>');

        // Table Row Form 2 Number 2
        $("#add_row_2_2").click(function(){
            $('#addr_2_2_'+i_2_2).html("<td class='td-input text-center'>"+(i_2_2+1)+"</td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center numeric' placeholder='YYYY'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
            );

            $('#tab_logic_2_2').append('<tr id="addr_2_2_'+(i_2_2+1)+'"></tr>');
            i_2_2++;
            return false;
        });

        $("#delete_row_2_2").click(function(){
            if(i_2_2>1){
                $("#addr_2_2_"+(i_2_2-1)).html('');
                i_2_2--;
            }
            return false;
        });

        // Table Row Form 2 Number 3
        $("#add_row_2_3").click(function(){
            $('#addr_2_3_'+i_2_3).html("<td class='td-input text-center'>"+(i_2_3+1)+"</td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input text-center'><input type='radio' name='language-lisan-3' id='1' value='1'></td>"
                +"<td class='td-input text-center'><input type='radio' name='language-lisan-3' id='2' value='1'></td>"
                +"<td class='td-input text-center'><input type='radio' name='language-lisan-3' id='3' value='1'></td>"
                +"<td class='td-input text-center'><input type='radio' name='language-tertulis-3' id='1' value='1'></td>"
                +"<td class='td-input text-center'><input type='radio' name='language-tertulis-3' id='2' value='1'></td>"
                +"<td class='td-input text-center'><input type='radio' name='language-tertulis-3' id='3' value='1'></td>"
            );

            $('#tab_logic_2_3').append('<tr id="addr_2_3_'+(i_2_3+1)+'"></tr>');
            i_2_3++;
            return false;
        });

        $("#delete_row_2_3").click(function(){
            if(i_2_3>1){
                $("#addr_2_3_"+(i_2_3-1)).html('');
                i_2_3--;
            }
            return false;
        });

        // Table Row Form 4 Number 1
        $("#add_row_4_1").click(function(){
            $('#addr_4_1_'+i_4_1).html("<td class='td-input text-center'>"+(i_4_1+1)+"</td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center numeric' placeholder='YYYY'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center'></td>"
                +"<td class='td-input'>"
                    +"<div class='input-group'>"
                        +"<span class='input-group-addon'>Rp</span>"
                        +"<input type='text' class='form-control text-right numeric'>"
                        +"<span class='input-group-addon'>.00</span>"
                    +"</div>"
                +"</td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
            );

            $('#tab_logic_4_1').append('<tr id="addr_4_1_'+(i_4_1+1)+'"></tr>');
            i_4_1++;
            return false;
        });

        $("#delete_row_4_1").click(function(){
            if(i_4_1>1){
                $("#addr_4_1_"+(i_4_1-1)).html('');
                i_4_1--;
            }
            return false;
        });

        // Table Row Form 6 Number 2
        $("#add_row_6_2").click(function(){
            $('#addr_6_2_'+i_6_2).html("<td class='td-input text-center'>"+(i_6_2+1)+"</td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center numeric' placeholder='YYYY'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
            );

            $('#tab_logic_6_2').append('<tr id="addr_6_2_'+(i_6_2+1)+'"></tr>');
            i_6_2++;
            return false;
        });

        $("#delete_row_6_2").click(function(){
            if(i_6_2>1){
                $("#addr_6_2_"+(i_6_2-1)).html('');
                i_6_2--;
            }
            return false;
        });

        // Table Row Form 7 Number 1
        $("#add_row_7_1").click(function(){
            $('#addr_7_1_'+i_7_1).html("<td class='td-input text-center'>"+(i_7_1+1)+"</td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm text-center numeric' placeholder='YYYY'></td>"
                +"<td class='td-input'><input type='text' class='form-control input-sm'></td>"
            );

            $('#tab_logic_7_1').append('<tr id="addr_7_1_'+(i_7_1+1)+'"></tr>');
            i_7_1++;
            return false;
        });

        $("#delete_row_7_1").click(function(){
            if(i_7_1>1){
                $("#addr_7_1_"+(i_7_1-1)).html('');
                i_7_1--;
            }
            return false;
        });

    });
</script>