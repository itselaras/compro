<?php 
    include("includes/header.php");

    set_time_limit(0);
    cekLogin(array('2'));
?>
    <link rel="stylesheet" type="text/css" href="css/data-lamaran-step.css" />

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
                                <div class="wizard-placer">
                                    <div id="wizard">
                                        <h2>Identitas</h2>
                                        <section>
                                            <!-- FORM I -->
                                            <p>
                                                <form class="form-horizontal" role="form" onsubmit="return formIdentitas()">

                                                    <div class="lamaran-form-heading">
                                                        <label class="sub-heading-number">I.</label>
                                                        <label class="sub-heading">IDENTITAS / <i>IDENTITY</i></label>
                                                    </div>

                                                    <?php 
                                                        $sqlIdentitas = "SELECT * FROM tb_pelamar a 
                                                        LEFT JOIN tb_negara b ON b.id = a.negara_id
                                                        LEFT JOIN tb_negara_bagian c ON c.id = a.provinsi_id
                                                        LEFT JOIN tb_kota d ON d.id = a.kota_id
                                                        WHERE a.id_user = ".$_SESSION['loginID'];
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
                                                                        $radio1 = '';
                                                                        $radio2 = '';
                                                                        if ($resultIdentitas['jenis_kelamin'] == 1) {
                                                                            $radio1 = 'checked';
                                                                        }elseif ($resultIdentitas['jenis_kelamin'] == 2) {
                                                                            $radio2 = 'checked';
                                                                        }
                                                                    ?>
                                                                    <div class="col-sm-2 radio">
                                                                        <label>
                                                                            <input type="radio" name="jenis-kelamin" class="jenis-kelamin" value="1" <?php echo $radio1 ?> required>
                                                                            Laki-Laki
                                                                            <p class="english-field">Male</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-2 radio">
                                                                        <label>
                                                                            <input type="radio" name="jenis-kelamin" class="jenis-kelamin" value="2" <?php echo $radio2 ?> required>
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
                                                            <div class="col-sm-5 button-browse-placer">
                                                                <div class="input-group">
                                                                    <input type="hidden" id="negara-id" value="<?php echo $resultIdentitas['negara_id'] ?>">
                                                                    <input type="text" class="form-control upper-text browse-tempat" id="negara" placeholder="Negara" value="<?php echo $resultIdentitas['negara'] ?>" required>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-info pilih-tempat" type="button" id="negara-browse"><i class="fa fa-folder-open"></i> Browse</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="provinsi" class="col-sm-2 control-label required">
                                                                <span class="main-field">Provinsi</span>
                                                                <p class="english-field">Province</p>
                                                            </label>
                                                            <div class="col-sm-5 button-browse-placer">
                                                                <div class="input-group">
                                                                    <input type="hidden" id="provinsi-id" value="<?php echo $resultIdentitas['provinsi_id'] ?>">
                                                                    <input type="text" class="form-control upper-text browse-tempat" id="provinsi" placeholder="Provinsi" value="<?php echo $resultIdentitas['bagian'] ?>" required>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-info pilih-tempat" type="button" id="provinsi-browse"><i class="fa fa-folder-open"></i> Browse</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kota" class="col-sm-2 control-label required">
                                                                <span class="main-field">Kota</span>
                                                                <p class="english-field">City</p>
                                                            </label>
                                                            <div class="col-sm-5 button-browse-placer">
                                                                <div class="input-group">
                                                                    <input type="hidden" id="kota-id" value="<?php echo $resultIdentitas['kota_id'] ?>">
                                                                    <input type="text" class="form-control upper-text browse-tempat" id="kota" placeholder="Kota" value="<?php echo $resultIdentitas['kota'] ?>" required>
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-info pilih-tempat" type="button" id="kota-browse"><i class="fa fa-folder-open"></i> Browse</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <label for="kode-pos" class="col-sm-2 control-label required">
                                                                <span class="main-field">Kode Pos</span>
                                                                <p class="english-field">Zip Code</p>
                                                            </label>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control upper-text numeric" id="kode-pos" placeholder="Kode Pos" value="<?php echo $resultIdentitas['kode_pos'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telepon" class="col-sm-2 control-label">
                                                                <span class="main-field">Telepon</span>
                                                                <p class="english-field">Phone</p>
                                                            </label>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control upper-text numeric" id="telepon" placeholder="Telepon" value="<?php echo $resultIdentitas['telepon'] ?>">
                                                            </div>
                                                            <label for="hp" class="col-sm-2 control-label required">
                                                                <span class="main-field">Handphone</span>
                                                                <p class="english-field">Handphone</p>
                                                            </label>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control upper-text numeric" id="hp" placeholder="Handphone" value="<?php echo $resultIdentitas['hp'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email" class="col-sm-2 control-label required">
                                                                <span class="main-field">Email</span>
                                                                <p class="english-field">Email</p>
                                                            </label>
                                                            <div class="col-sm-5">
                                                                <input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $resultIdentitas['email'] ?>" required disabled>
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
                                                                <select class="form-control upper-text" id="jenis-identitas" required>
                                                                    <option value="">Pilih Jenis Identitas</option>
                                                                    <option <?php echo $option1; ?> value="1">Kartu Tanda Penduduk (KTP)</option>
                                                                    <option <?php echo $option2; ?> value="2">Surat Izin Mengemudi (SIM)</option>
                                                                    <option <?php echo $option3; ?> value="3">Kartu Pelajar</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <input type="text" class="form-control upper-text" id="no-identitas" placeholder="Nomor Identitas" value="<?php echo $resultIdentitas['no_identitas'] ?>" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lamaran-form-footer">
                                                        <div class="form-group">
                                                            <div class="sub-footer">
                                                                <div class="col-sm-12 text-right">
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Pendidikan</h2>
                                        <section>
                                            <p>
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
                                                                            <th rowspan="2" width="5%">#</th>
                                                                            <th rowspan="2" width="15%">Tingkatan <p class="english-table">Level</p></th>
                                                                            <th colspan="2" width="15%">Tingkatan Tahun Sekolah <p class="english-table">Years Attended</p></th>
                                                                            <th rowspan="2" width="15%">Nama Sekolah/ Universitas <p class="english-table">Name of School</p></th>
                                                                            <th rowspan="2">Tempat <p class="english-table">Place</p></th>
                                                                            <th rowspan="2">Fakultas <p class="english-table">Faculty</p></th>
                                                                            <th rowspan="2">Jurusan <p class="english-table">Major</p></th>
                                                                            <th rowspan="2" width="7%">IPK <p class="english-table">GPA</p></th>
                                                                            <th rowspan="2" width="5%">Keterangan <p class="english-table">Remarks</p></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th><p class="english-table">Start</p></th>
                                                                            <th><p class="english-table">Ending</p></th>
                                                                        </tr>

                                                                        <?php 
                                                                            $sqlSMU = "SELECT a.*, b.jurusan AS selected_jurusan FROM tb_pend_formal a 
                                                                            LEFT JOIN tb_jurusan b ON a.jurusan = b.id
                                                                            WHERE a.id_pelamar = ".$_SESSION['pelamarID']." AND a.tingkatan = 1";
                                                                            $querySMU = mysql_query($sqlSMU);


                                                                            if (mysql_num_rows($querySMU) < 1) {
                                                                                $checkSMU = "";
                                                                                $disabledSMU = "disabled";
                                                                            }else{
                                                                                $checkSMU = "checked";
                                                                                $disabledSMU = "";
                                                                            }

                                                                            $resultSMU = mysql_fetch_array($querySMU);
                                                                            $ipkSMU = ($resultSMU['ipk']) ? $resultSMU['ipk'] : '' ;
                                                                        ?>

                                                                        <tr>
                                                                            <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkSMU ?>></td>
                                                                            <td class="td-input">
                                                                                <input type="hidden" class="tingkatan-id" value="1">
                                                                                SMU 
                                                                                <p class="english-table">Senior High School</p>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['tahun_mulai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['tahun_selesai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['nama_instansi'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['tempat'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['fakultas'] ?>"></td>
                                                                            <td class="td-input">
                                                                                <select class="form-control jurusan input-sm" <?php echo $disabledSMU ?>>
                                                                                    <?php jurusanSelected($resultSMU['jurusan']) ?>
                                                                                </select>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm numeric text-center ipk ipk-4" <?php echo $disabledSMU ?> value="<?php echo $ipkSMU ?>" maxlength="5"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledSMU ?> value="<?php echo $resultSMU['keterangan'] ?>"></td>
                                                                        </tr>

                                                                        <?php 
                                                                            $sqlAkademi = "SELECT a.*, b.jurusan AS selected_jurusan FROM tb_pend_formal a 
                                                                            LEFT JOIN tb_jurusan b ON a.jurusan = b.id
                                                                            WHERE a.id_pelamar = ".$_SESSION['pelamarID']." AND a.tingkatan = 2";
                                                                            $queryAkademi = mysql_query($sqlAkademi);

                                                                            if (mysql_num_rows($queryAkademi) < 1) {
                                                                                $checkAkademi = "";
                                                                                $disabledAkademi = "disabled";
                                                                            }else{
                                                                                $checkAkademi = "checked";
                                                                                $disabledAkademi = "";
                                                                            }

                                                                            $resultAkademi = mysql_fetch_array($queryAkademi);
                                                                            $ipkAkademi = ($resultAkademi['ipk']) ? $resultAkademi['ipk'] : '' ;
                                                                        ?>

                                                                        <tr>
                                                                            <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkAkademi ?>></td>
                                                                            <td class="td-input">
                                                                                <input type="hidden" class="tingkatan-id" value="2">
                                                                                Akademi 
                                                                                <p class="english-table">Academy</p>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['tahun_mulai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['tahun_selesai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['nama_instansi'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['tempat'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['fakultas'] ?>"></td>
                                                                            <td class="td-input">
                                                                                <select class="form-control jurusan input-sm" <?php echo $disabledAkademi ?>>
                                                                                    <?php jurusanSelected($resultAkademi['jurusan']) ?>
                                                                                </select>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm numeric text-center ipk ipk-3" <?php echo $disabledAkademi ?> value="<?php echo $ipkAkademi ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledAkademi ?> value="<?php echo $resultAkademi['keterangan'] ?>"></td>
                                                                        </tr>

                                                                        <?php 
                                                                            $sqlStrata = "SELECT * FROM tb_pend_formal WHERE id_pelamar = ".$_SESSION['pelamarID']." AND tingkatan = 3";
                                                                            $queryStrata = mysql_query($sqlStrata);

                                                                            if (mysql_num_rows($queryStrata) < 1) {
                                                                                $checkStrata = "";
                                                                                $disabledStrata = "disabled";
                                                                            }else{
                                                                                $checkStrata = "checked";
                                                                                $disabledStrata = "";
                                                                            }

                                                                            $resultStrata = mysql_fetch_array($queryStrata);
                                                                            $ipkStrata = ($resultStrata['ipk']) ? $resultStrata['ipk'] : '' ;
                                                                        ?>

                                                                        <tr>
                                                                            <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkStrata ?>></td>
                                                                            <td class="td-input">
                                                                                <input type="hidden" class="tingkatan-id" value="3">
                                                                                Strata 1 
                                                                                <p class="english-table">Under Graduate</p>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['tahun_mulai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['tahun_selesai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['nama_instansi'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['tempat'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['fakultas'] ?>"></td>
                                                                            <td class="td-input">
                                                                                <select class="form-control jurusan input-sm" <?php echo $disabledStrata ?>>
                                                                                    <?php jurusanSelected($resultStrata['jurusan']) ?>
                                                                                </select>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm numeric text-center ipk ipk-3" <?php echo $disabledStrata ?> value="<?php echo $ipkStrata ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledStrata ?> value="<?php echo $resultStrata['keterangan'] ?>"></td>
                                                                        </tr>

                                                                        <?php 
                                                                            $sqlPasca = "SELECT a.*, b.jurusan AS selected_jurusan FROM tb_pend_formal a 
                                                                            LEFT JOIN tb_jurusan b ON a.jurusan = b.id
                                                                            WHERE a.id_pelamar = ".$_SESSION['pelamarID']." AND a.tingkatan = 4";
                                                                            $queryPasca = mysql_query($sqlPasca);

                                                                            if (mysql_num_rows($queryPasca) < 1) {
                                                                                $checkPasca = "";
                                                                                $disabledPasca = "disabled";
                                                                            }else{
                                                                                $checkPasca = "checked";
                                                                                $disabledPasca = "";
                                                                            }

                                                                            $resultPasca = mysql_fetch_array($queryPasca);
                                                                            $ipkPasca = ($resultPasca['ipk']) ? $resultPasca['ipk'] : '' ;
                                                                        ?>

                                                                        <tr id='addr_2_1_3'>
                                                                            <td width="5%" class="td-input text-center"><input type="checkbox" class="check" <?php echo $checkPasca ?>></td>
                                                                            <td class="td-input">
                                                                                <input type="hidden" class="tingkatan-id" value="4">
                                                                                Pasca Sarjana 
                                                                                <p class="english-table">Post Graduate</p>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-mulai" placeholder="YYYY" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['tahun_mulai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm text-center numeric tahun-selesai" placeholder="YYYY" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['tahun_selesai'] ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm nama-instansi" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['nama_instansi'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm tempat" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['tempat'] ?>"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm fakultas" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['fakultas'] ?>"></td>
                                                                            <td class="td-input">
                                                                                <select class="form-control jurusan input-sm" <?php echo $disabledPasca ?>>
                                                                                    <?php jurusanSelected($resultPasca['jurusan']) ?>
                                                                                </select>
                                                                            </td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm numeric text-center ipk ipk-3" <?php echo $disabledPasca ?> value="<?php echo $ipkPasca ?>" maxlength="4"></td>
                                                                            <td class="td-input"><input type="text" class="form-control input-sm keterangan" <?php echo $disabledPasca ?> value="<?php echo $resultPasca['keterangan'] ?>"></td>
                                                                        </tr>
                                                                    </table>
                                                                    <div class="text-right">
                                                                        <i class="english-sub">
                                                                            Gunakan tanda titik (.) untuk pemisah.<br>
                                                                            Nilai maksimal IPK (GPA) SMU <i>Senior High School</i> adalah 99.99.<br>
                                                                            Nilai maksimal IPK (GPA) selain SMU <i>Senior High School</i> adalah 4.00.<br>
                                                                        </i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="field-row">
                                                            <label for="ket" class="sub-category">
                                                                <label for="ket" class="sub-category-number">2.</label>
                                                                Pendidikan Informal (Kursus / Pelatihan)<br>
                                                                <i class="english-sub">Informal Education (Course / Training)</i>
                                                            </label>

                                                            <div class="sub-padding-2">
                                                                <div class="table-responsive formal-placer">
                                                                    <table class="table table-bordered pend-informal-table add-more" id="tab_logic_2_2">
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="8%">Nomor <p class="english-table">Number</p></th>
                                                                                <th>Jenis Kursus / Pelatihan <p class="english-table">Type of Course / Training</p></th>
                                                                                <th width="20%">Tempat <p class="english-table">Place</p></th>
                                                                                <th colspan="2" width="20%">Periode <p class="english-table">Time Period</p></th>
                                                                                <th>Keterangan <p class="english-table">Remarks</p></th>
                                                                                <th width="10%">Option <p class="english-table">Option</p></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="tbody-data">
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="add-field">
                                                                    <span class="display-loading"></span>
                                                                    <button class="btn btn-default btn-sm pull-right" id="add-informal-row"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
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
                                                                    <table class="table table-bordered bahasa-table add-more" id="tab_logic_2_3">
                                                                        <thead>
                                                                            <tr>
                                                                                <th rowspan="2" width="8%">Nomor <p class="english-table">Number</p></th>
                                                                                <th rowspan="2">Bahasa <p class="english-table">Language</p></th>
                                                                                <th colspan="3">Lisan <p class="english-table">Oral</p></th>
                                                                                <th colspan="3">Tertulis <p class="english-table">Written</p></th>
                                                                                <th rowspan="2" width="10%">Option <p class="english-table">Option</p></th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th width="9%">Kurang <p class="english-table">Poor</p></th>
                                                                                <th width="9%">Cukup <p class="english-table">Fair</p></th>
                                                                                <th width="9%">Baik <p class="english-table">Good</p></th>
                                                                                <th width="9%">Kurang <p class="english-table">Poor</p></th>
                                                                                <th width="9%">Cukup <p class="english-table">Fair</p></th>
                                                                                <th width="9%">Baik <p class="english-table">Good</p></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="tbody-data">
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="add-field">
                                                                    <span class="display-loading"></span>
                                                                    <button class="btn btn-default btn-sm pull-right" id="add-bahasa-row"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lamaran-form-footer">
                                                        <div class="form-group">
                                                            <div class="sub-footer">
                                                                <div class="col-sm-12 text-right">
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Keluarga</h2>
                                        <section>
                                            <p>
                                                <!-- FORM III -->
                                                <form class="form-horizontal" role="form" onsubmit="return formStatusKeluarga()">
                                                    <div class="lamaran-form-heading">
                                                        <label class="sub-heading-number">III.</label>
                                                        <label class="sub-heading">STATUS KELUARGA / <i>FAMILY STATUS</i></label>
                                                    </div>

                                                    <?php 
                                                        $sqlKeluarga = "SELECT * FROM tb_status_keluarga WHERE id_pelamar = ".$_SESSION['pelamarID'];
                                                        $queryKeluarga = mysql_query($sqlKeluarga);
                                                        $resultKeluarga = mysql_fetch_array($queryKeluarga);

                                                        $radio1 = ''; $sejak1 = '';
                                                        $radio2 = ''; $sejak2 = '';
                                                        $radio3 = ''; $sejak3 = '';
                                                        $radio4 = ''; $sejak4 = '';
                                                        if ($resultKeluarga['status'] == 1) {
                                                            $radio1 = 'checked';
                                                            $sejak1 = $resultKeluarga['sejak'];
                                                        }elseif ($resultKeluarga['status'] == 2) {
                                                            $radio2 = 'checked';
                                                            $sejak2 = $resultKeluarga['sejak'];
                                                        }elseif ($resultKeluarga['status'] == 3) {
                                                            $radio3 = 'checked';
                                                            $sejak3 = $resultKeluarga['sejak'];
                                                        }elseif ($resultKeluarga['status'] == 4) {
                                                            $radio4 = 'checked';
                                                            $sejak4 = $resultKeluarga['sejak'];
                                                        }
                                                    ?>

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
                                                                            <input type="radio" name="status-kawin" class="status-kawin" id="1" <?php echo $radio1 ?> value="1" required>
                                                                            <span class="main-field">Lajang</span>
                                                                            <p class="english-field">Single</p>
                                                                            <input type="text" class="form-control numeric invisible">
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-3 radio">
                                                                        <label>
                                                                            <input type="radio" name="status-kawin" class="status-kawin" id="2" <?php echo $radio2 ?> value="2" required>
                                                                            <span class="main-field">Tunangan sejak</span>
                                                                            <p class="english-field">Engaged since</p>
                                                                            <input type="text" class="form-control numeric sejak" value="<?php echo $sejak2 ?>" placeholder="YYYY" maxlength="4" disabled>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-3 radio">
                                                                        <label>
                                                                            <input type="radio" name="status-kawin" class="status-kawin" id="3" <?php echo $radio3 ?> value="3" required>
                                                                            <span class="main-field">Menikah sejak</span>
                                                                            <p class="english-field">Married since</p>
                                                                            <input type="text" class="form-control numeric sejak" value="<?php echo $sejak3 ?>" placeholder="YYYY" maxlength="4" disabled>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-sm-3 radio">
                                                                        <label>
                                                                            <input type="radio" name="status-kawin" class="status-kawin" id="4" <?php echo $radio4 ?> value="4" required>
                                                                            <span class="main-field">Bercerai sejak</span>
                                                                            <p class="english-field">Divorce since</p>
                                                                            <input type="text" class="form-control numeric sejak" value="<?php echo $sejak4 ?>" placeholder="YYYY" maxlength="4" disabled>
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
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Pekerjaan</h2>
                                        <section>
                                            <p>
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
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="8%">Nomor <p class="english-table">Number</p></th>
                                                                                <th>Perusahaan <p class="english-table">Company</p></th>
                                                                                <th>Bisnis Perusahaan <p class="english-table">Company Bussines</p></th>
                                                                                <th colspan="2" width="20%">Periode <p class="english-table">Time Period</p></th>
                                                                                <th>Posisi <p class="english-table">Position</p></th>
                                                                                <th>Jumlah Bawahan <p class="english-table">Number of Subordinate</p></th>
                                                                                <th width="15%">Gaji Terakhir (IDR)<p class="english-table">Last Salary (IDR)</p></th>
                                                                                <th>Alasan Pindah <p class="english-table">Reason for Leaving</p></th>
                                                                                <th>Keterangan <p class="english-table">Remarks</p></th>
                                                                                <th width="10%">Option <p class="english-table">Option</p></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="tbody-data">
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="add-field">
                                                                    <span class="display-loading"></span>
                                                                    <button class="btn btn-default btn-sm pull-right" id="add-pekerjaan-row"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="lamaran-form-footer">
                                                        <div class="form-group">
                                                            <div class="sub-footer">
                                                                <div class="col-sm-12 text-right">
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Minat</h2>
                                        <section>
                                            <p>
                                                <!-- FORM V -->
                                                <form class="form-horizontal" role="form" onsubmit="return formMinatHarapan()">
                                                    <div class="lamaran-form-heading">
                                                        <label class="sub-heading-number">V.</label>
                                                        <label class="sub-heading">MINAT DAN HARAPAN / <i>INTEREST AND EXPECTATION</i></label>
                                                    </div>

                                                    <?php 
                                                        $sqlMinat = "SELECT a.*, b.bagian AS provinsi_minat, c.kota AS kota_minat, d.negara AS negara_minat FROM tb_minat a 
                                                        LEFT JOIN tb_negara_bagian b ON b.id = a.lokasi_provinsi
                                                        LEFT JOIN tb_kota c ON c.id = a.lokasi_kota
                                                        LEFT JOIN tb_negara d ON d.id = a.lokasi_negara
                                                        WHERE a.id_pelamar = ".$_SESSION['pelamarID'];
                                                        $queryMinat = mysql_query($sqlMinat);
                                                        $resultMinat = mysql_fetch_array($queryMinat);
                                                    ?>

                                                    <div class="lamaran-form-body harapan-form">
                                                        <div class="table-responsive formal-placer">
                                                            <table class="table table-bordered add-more" id="tab_logic_5_1">
                                                                <thead>
                                                                    <tr>
                                                                        <th rowspan="2">Nomor</th>
                                                                        <th colspan="3">Preferensi Lokasi</th>
                                                                        <th rowspan="2">Gaji Bulanan (IDR)</th>
                                                                        <th rowspan="2">Bidang Bisnis</th>
                                                                        <th rowspan="2">Spesialisasi</th>
                                                                        <th rowspan="2">Posisi Kerja</th>
                                                                        <th rowspan="2">Level Jabatan</th>
                                                                        <th rowspan="2" width="10%">Option</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Negara</th>
                                                                        <th>Provinsi</th>
                                                                        <th>Kota</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="tbody-data">
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="add-field">
                                                            <span class="display-loading"></span>
                                                            <button class="btn btn-default btn-sm pull-right" id="add-minat-row"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <div class="lamaran-form-footer">
                                                        <div class="form-group">
                                                            <div class="sub-footer">
                                                                <div class="col-sm-12 text-right">
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Aktifitas</h2>
                                        <section>
                                            <p>
                                                <!-- FORM VI -->
                                                <form class="form-horizontal" role="form" onsubmit="return formAktifitasSosial()">
                                                    <div class="lamaran-form-heading">
                                                        <label class="sub-heading-number">VI.</label>
                                                        <label class="sub-heading">AKTIVITAS SOSIAL / <i>SOCIAL ACTIVITIES</i></label>
                                                    </div>

                                                    <?php 
                                                        $sqlSosial = "SELECT * FROM tb_soc_act WHERE id_pelamar = '".$_SESSION['pelamarID']."'";
                                                        $querySosial = mysql_query($sqlSosial);
                                                        $sport = '';
                                                        $hobby = '';
                                                        while ($resultSosial = mysql_fetch_array($querySosial)) {
                                                            if ($resultSosial['type'] == 1) {
                                                                $sport = $resultSosial['keterangan'];
                                                            }else if($resultSosial['type'] == 2){
                                                                $hobby = $resultSosial['keterangan'];
                                                            }
                                                        }
                                                    ?>

                                                    <div class="lamaran-form-body">
                                                        <div class="form-group">
                                                            <label for="sport" class="col-sm-2 sub-category control-label required">
                                                                <label class="sub-category-number required">1.</label>
                                                                Olahraga<br>
                                                                <i class="english-sub">Sport</i>
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control upper-text" id="sport" value="<?php echo $sport ?>" placeholder="Olahraga / Sport" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hobby" class="col-sm-2 sub-category control-label required">
                                                                <label class="sub-category-number required"></label>
                                                                Hobi<br>
                                                                <i class="english-sub">Hobbies</i>
                                                            </label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control upper-text" id="hobby" value="<?php echo $hobby ?>" placeholder="Hobi / Hobbies" required>
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
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="8%">Nomor <p class="english-table">Number</p></th>
                                                                                <th>Organisasi <p class="english-table">Organization</p></th>
                                                                                <th colspan="2" width="20%">Periode <p class="english-table">Time Period</p></th>
                                                                                <th>Tempat <p class="english-table">Place</p></th>
                                                                                <th>Posisi <p class="english-table">Position</p></th>
                                                                                <th>Keterangan <p class="english-table">Remarks</p></th>
                                                                                <th width="10%">Option <p class="english-table">Option</p></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="tbody-data">
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="add-field">
                                                                    <span class="display-loading"></span>
                                                                    <button class="btn btn-default btn-sm pull-right" id="add-organisasi-row"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
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
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Lain-lain</h2>
                                        <section>
                                            <p>
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
                                                                        <thead>
                                                                            <tr>
                                                                                <th width="8%">Nomor <p class="english-table">Number</p></th>
                                                                                <th>Jenis Penyakit <p class="english-table">Kind of Disease</p></th>
                                                                                <th colspan="2" width="20%">Periode <p class="english-table">Time Period</p></th>
                                                                                <th>Pengaruh <p class="english-table">Effect</p></th>
                                                                                <th width="10%">Option <p class="english-table">Option</p></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="tbody-data">
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="add-field">
                                                                    <span class="display-loading"></span>
                                                                    <button class="btn btn-default btn-sm pull-right" id="add-sakit-row"><i class="fa fa-plus-circle"></i> Tambah Baris</button>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jabatan-pekerjaan" class="col-sm-12 sub-category control-label required">
                                                                <label class="sub-category-number">2.</label>
                                                                Tahu informasi  PT Selaras Mitra Integra dari
                                                            </label>
                                                            <br><br>

                                                            <?php
                                                                $sqlInformasi = "SELECT * FROM tb_informasi WHERE id_pelamar = '".$_SESSION['pelamarID']."'";
                                                                $queryInformasi = mysql_query($sqlInformasi);
                                                                $resultInformasi = mysql_fetch_array($queryInformasi);

                                                                $radioInformasi1 = '';
                                                                $radioInformasi2 = '';
                                                                $radioInformasi3 = '';
                                                                $radioInformasi4 = '';
                                                                $radioInformasi5 = '';
                                                                $radioInformasi6 = '';
                                                                $radioInformasi7 = '';
                                                                $radioInformasi8 = '';
                                                                $radioInformasi9 = '';

                                                                if ($resultInformasi['sumber_informasi'] == 1) {
                                                                    $radioInformasi1 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 2) {
                                                                    $radioInformasi2 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 3) {
                                                                    $radioInformasi3 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 4) {
                                                                    $radioInformasi4 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 5) {
                                                                    $radioInformasi5 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 6) {
                                                                    $radioInformasi6 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 7) {
                                                                    $radioInformasi7 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 8) {
                                                                    $radioInformasi8 = 'checked';
                                                                }elseif ($resultInformasi['sumber_informasi'] == 9) {
                                                                    $radioInformasi9 = 'checked';
                                                                }
                                                            ?>

                                                            <div class="sub-padding-2">
                                                                <div class="col-sm-3">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi1 ?> id="1" value="1" required>
                                                                                Radio
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi2 ?> id="2" value="2" required>
                                                                                Google search engine
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi3 ?> id="3" value="3" required>
                                                                                Yahoo search engine
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi4 ?> id="4" value="4" required>
                                                                                Website
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi5 ?> id="5" value="5" required>
                                                                                Majalah 
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi6 ?> id="6" value="6" required>
                                                                                Koran 
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi7 ?> id="7" value="7" required>
                                                                                Pameran
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi8 ?> id="8" value="8" required>
                                                                                Teman
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-sm-12 radio">
                                                                            <label>
                                                                                <input type="radio" name="sumber-informasi" <?php echo $radioInformasi9 ?> id="9" value="9" required>
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
                                                                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                                                    <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </p>
                                        </section>

                                        <h2>Lampiran</h2>
                                        <section>
                                            <p>
                                                <!-- FORM VIII -->
                                                <div class="form-horizontal">
                                                    
                                                    <div class="lamaran-form-heading">
                                                        <label class="sub-heading-number">VIII.</label>
                                                        <label class="sub-heading">LAMPIRAN</label>
                                                    </div>
                                                    <span class="display-loading"></span>
                                                    <div id="lampiran-list" class="lamaran-form-body">
                                                    </div>
                                                </div>
                                            </p>
                                            <div class="lamaran-form-footer">
                                                <div class="form-group">
                                                    <div class="sub-footer">
                                                        <div class="col-sm-12 link-output-placer text-right">
                                                            <a target="_blank" href="cv-pelamar" id="preview" class="btn btn-success"><i class="fa fa-file-text-o"></i> Preview CV</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

<?php include("includes/footer.php") ?>

<!-- Upload Lampiran -->
<script src="js/upload-lampiran.js"></script>

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
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                <span class="next-form-placer"></span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
                <span id="console-placer"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-sm btn-danger" id="delete-confirm">Hapus</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-tempat" id="modal-add" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<div class="modal fade modal-tempat" id="negara-tempat" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Negara</h4>
            </div>
            <div class="modal-body">
                <table id="negara-table" class="table table-hover table-striped">
                    <thead>
                        <tr class="center">
                            <th class="text-center" width="10%">#</th>
                            <th class="title-tempat">Negara</th>
                            <th class="text-right" width="30%">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-tempat" id="provinsi-tempat" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Provinsi / Negara Bagian</h4>
            </div>
            <div class="modal-body">
                <table id="provinsi-table" class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr class="center">
                            <th>#</th>
                            <th class="text-center">Negara</th>
                            <th class="title-tempat">Provinsi / Negara Bagian</th>
                            <th class="text-right">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-tempat" id="kota-tempat" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Kota</h4>
            </div>
            <div class="modal-body">
                <table id="kota-table" class="table table-hover table-striped table-condensed">
                    <thead>
                        <tr class="center">
                            <th>#</th>
                            <th class="text-center">Provinsi / Negara Bagian</th>
                            <th class="title-tempat">Kota</th>
                            <th class="text-right">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-lampiran" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="cek" action="#" enctype="multipart/form-data" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Upload Lampiran</h4>
            </div>
            <div class="modal-body">
                <blockquote>
                    <h5>Ketentuan mengunggah lampiran</h5>
                    <small>Ekstensi file image: JPG, JPEG, PNG, BMP</small>
                    <small>Ekstensi file dokumen: PDF, XLS, XLSX, DOC, DOCX</small>
                    <small>Size maksimal: 500 KB</small>
                </blockquote>
                <a href="#" class="btn btn-primary btn-block browse-lampiran-modal"><i class="fa fa-folder-open-o"></i> Browse lampiran</a>
                <input type="file" name="file_upload" id="file_upload" class="invisible" multiple style="display:none">
                <div class="progress progress-striped active loading-lampiran invisible" style="display:none">
                    <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                        <span class="sr-only">Loading</span>
                    </div>
                </div>

                <div class="upload-lampiran"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success btn-sm upload-submit" name="submit">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    var negara;
    var provinsi;
    var kota;
    var source_lampiran;
    var image_status;
    var negara_id = $('#negara-id').val();
    var provinsi_id = $('#provinsi-id').val();
    var kota_id = $('#kota-id').val();
    var negara_minat_id = $('#negara-minat-id').val();
    var provinsi_minat_id = $('#provinsi-minat-id').val();
    var kota_minat_id = $('#kota-minat-id').val();

    // Table Variable
    var i_2_1=4; var i_loop_2_1;
    var i_2_2=1; var i_loop_2_2;
    var i_2_3=1; var i_loop_2_3;
    var i_4_1=1; var i_loop_4_1;
    var i_6_2=1; var i_loop_6_2;
    var i_7_1=1; var i_loop_7_1;

    $("#wizard").steps({
        /* Appearance */
        headerTag: "h2",
        bodyTag: "section",
        cssClass: "wizard",
        stepsOrientation: $.fn.steps.stepsOrientation.horizontal,

        /* Templates */
        loadingTemplate: '<span class="spinner"></span> Loading . . .',

        /* Behaviour */
        cycleSteps: true,
        autoFocus: true,
        enableAllSteps: true,
        enableKeyNavigation: true,
        enablePagination: true,
        suppressPaginationOnFocus: true,
        enableContentCache: true,
        enableCancelButton: false,
        enableFinishButton: false,
        preloadContent: true,
        showFinishButtonAlways: false,
        forceMoveForward: false,
        saveState: true,
        startIndex: 0,

        /* Transition Effects */
        transitionEffect: $.fn.steps.transitionEffect.fade,
        transitionEffectSpeed: 200,

        /* Events */
        onStepChanging: function (event, currentIndex, newIndex) {
            if(newIndex == 1){
                displayInformal();
                displayBahasa();
            }else if(newIndex == 3){
                displayPekerjaan();
            }else if(newIndex == 4){
                displayMinat();
            }else if(newIndex == 5){
                displayOrganisasi();
            }else if(newIndex == 6){
                displayPenyakit();
            }else if(newIndex == 7){
                displayLampiran();
            };
            return true; 

        },
        // onStepChanged: function (event, currentIndex, priorIndex) { }}, 
        // onCanceled: function (event) { },
        // onFinishing: function (event, currentIndex) { return true; }, 
        // onFinished: function (event, currentIndex) { },

        /* Labels */
        labels: {
            current: "current step:",
            pagination: "Pagination",
            finish: "Finish",
            next: "Next",
            previous: "Previous",
            loading: "Loading ..."
        }
    });

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
                jenisKelamin: $("input[name='jenis-kelamin']:checked").val(),
                alamat: $('#alamat').val(),
                negara: $('#negara-id').val(),
                provinsi: $('#provinsi-id').val(),
                kota: $('#kota-id').val(),
                kodePos: $('#kode-pos').val(),
                telepon: $('#telepon').val(),
                hp: $('#hp').val(),
                email: $('#email').val(),
                agama: $('#agama').val(),
                jenisIdentitas: $('#jenis-identitas').val(),
                noIdentitas: $('#no-identitas').val(),
                action: 'identitas',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                $('#console-placer').html('Data Identitas telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
                $('#modal-confirm').modal('show');
            }else{
                $('#console-placer').html('Data gagal disimpan.<br>Periksa kelengkapan data.');
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

    function modal_display_tempat(id_string){
        if (id_string == 'negara-browse') {
            negara.fnNewAjax("administrator/master-negara-tbl?source=lamaran");
            $('#negara-tempat').modal('show');
        }else if(id_string == 'provinsi-browse'){
            if (negara_id == '') {
                $('#console-placer').html('Negara belum ditentukan.');
                $('#modal-confirm').modal('show');
            }else{
                provinsi.fnNewAjax("administrator/master-provinsi-tbl?source=lamaran&id="+negara_id);
                $('#provinsi-tempat').modal('show');
            };
        }else if(id_string == 'kota-browse'){
            if (provinsi_id == '') {
                $('#console-placer').html('Provinsi belum ditentukan.');
                $('#modal-confirm').modal('show');
            }else{
                kota.fnNewAjax("administrator/master-kota-tbl?source=lamaran&id="+provinsi_id);
                $('#kota-tempat').modal('show');
            };
        };
    }

    // II Pendidikan
    function formPendidikan(){
        var confirmed = 0;
        var ipk_status = 0;
        var formal_table = $('.pend-formal-table').find('.check');
        formal_table.each(function() {
            var ipk_cek = $(this).closest('tr').find('.ipk');
            if (ipk_cek.is( ".ipk-3" )) {
                if (ipk_cek.val()>4) {
                    ipk_status++;
                };
            }
        });

        // alert("IPK Status = "+ipk_status);

        if (ipk_status == 0) {
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
                            auth: '<?php echo $_SESSION["pelamarID"] ?>',
                            login: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(data) {
                        // console.log("success");
                        if (data == 'success') {
                            confirmed+=1;
                        };
                        if (confirmed == 4) {
                            $('#console-placer').html('Data Pendidikan telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
                            $('#modal-confirm').modal('show');
                        }
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
                            auth: '<?php echo $_SESSION["pelamarID"] ?>',
                            login: '<?php echo $_SESSION["loginID"] ?>'
                        },
                    })
                    .done(function(data) {
                        // console.log("success");
                        if (data == 'success') {
                            confirmed+=1;
                        };
                        if (confirmed == 4) {
                            $('#console-placer').html('Data Pendidikan telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
                            $('#modal-confirm').modal('show');
                        }
                    })
                    .fail(function() {
                        // console.log("error");
                    })
                    .always(function() {
                        // console.log("complete");
                    });
                }
            });
        }else{
            $('#console-placer').html('<h4>Periksa kembali IPK Anda.</h4>'+
                '<ul><li>Maksimal nilai IPK = 4.00</li>'+
                '<li>Pemisah menggunakan tanda titik (.)</li>'+
                '<li>Nilai default = 0.00</li></ul>');
            $('#modal-confirm').modal('show');
        };
        return false;
    };

    function displayInformal(){
        $('#tab_logic_2_2').closest('.field-row').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'pendidikan_informal',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#tab_logic_2_2').find('.tbody-data').html(data);
            $('#tab_logic_2_2').closest('.field-row').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function formAddInformal(content,val){
        $('#modal-add').modal('hide');
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                jenis_kursus: $('#modal-add').find('#jenis-kursus').val(),
                tempat: $('#modal-add').find('#tempat').val(),
                periode_awal: $('#modal-add').find('#periode_awal').val(),
                periode_akhir: $('#modal-add').find('#periode_akhir').val(),
                keterangan: $('#modal-add').find('#keterangan').val(),
                action: 'pendidikan_informal',
                content: content,
                data_val: val,
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                displayInformal();
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

    function displayBahasa(){
        $('#tab_logic_2_3').closest('.field-row').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'bahasa',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#tab_logic_2_3').find('.tbody-data').html(data);
            $('#tab_logic_2_3').closest('.field-row').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function formAddBahasa(content,val){
        $('#modal-add').modal('hide');
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                bahasa: $('#modal-add').find('#bahasa').val(),
                lisan: $('#modal-add').find("input[name='language-lisan']:checked").val(),
                tertulis: $('#modal-add').find("input[name='language-tertulis']:checked").val(),
                action: 'bahasa',
                content: content,
                data_val: val,
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                displayBahasa();
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

    // III Status Keluarga
    function formStatusKeluarga(){
        var keluarga_option = $("input[name='status-kawin']:checked");
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                status: keluarga_option.val(),
                sejak: keluarga_option.closest('.radio').find('.form-control').val(),
                action: 'keluarga',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                $('#console-placer').html('Data Keluarga telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
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

    // IV Riwayat Pekerjaan
    function formRiwayatPekerjaan(){
        $('#console-placer').html('Data Riwayat Pekerjaan telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
        $('#modal-confirm').modal('show');
        return false;
    }

    function displayPekerjaan(){
        $('#tab_logic_4_1').closest('.field-row').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'riwayat_pekerjaan',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#tab_logic_4_1').find('.tbody-data').html(data);
            $('#tab_logic_4_1').closest('.field-row').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function formAddPekerjaan(content,val){
        $('#modal-add').modal('hide');
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                perusahaan: $('#modal-add').find('#perusahaan').val(),
                periode_awal: $('#modal-add').find('#periode_awal').val(),
                periode_akhir: $('#modal-add').find('#periode_akhir').val(),
                posisi: $('#modal-add').find('#posisi').val(),
                jumlah_bawahan: $('#modal-add').find('#jumlah-bawahan').val(),
                gaji_terakhir: $('#modal-add').find('#gaji-terakhir-number').val(),
                alasan_pindah: $('#modal-add').find('#alasan-pindah').val(),
                deskripsi_pekerjaan: $('#modal-add').find('#deskripsi-pekerjaan').val(),
                bidang_bisnis: $('#modal-add').find('#bidang_bisnis').val(),
                action: 'riwayat_pekerjaan',
                content: content,
                data_val: val,
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                displayPekerjaan();
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

    // V Minat
    function displayMinat(){
        $('#tab_logic_5_1').closest('.field-row').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'minat',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#tab_logic_5_1').find('.tbody-data').html(data);
            $('#tab_logic_5_1').closest('.field-row').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function minatDisplayTempat(id_string){
        if (id_string == 'negara-minat-browse') {
            negara.fnNewAjax("administrator/master-negara-tbl?source=minat_lamaran");
            $('#negara-tempat').modal('show');
        }else if(id_string == 'provinsi-minat-browse'){
            if (negara_minat_id == '') {
                $('#console-placer').html('Negara belum ditentukan.');
                $('#modal-confirm').modal('show');
            }else{
                provinsi.fnNewAjax("administrator/master-provinsi-tbl?source=minat_lamaran&id="+negara_minat_id);
                $('#provinsi-tempat').modal('show');
            };
        }else if(id_string == 'kota-minat-browse'){
            if (provinsi_minat_id == '') {
                $('#console-placer').html('Provinsi belum ditentukan.');
                $('#modal-confirm').modal('show');
            }else{
                kota.fnNewAjax("administrator/master-kota-tbl?source=minat_lamaran&id="+provinsi_minat_id);
                $('#kota-tempat').modal('show');
            };
        };
    }

    function formAddMinat(content,val){
        $('#modal-add').modal('hide');
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                lokasi_negara: $('#modal-add').find('#negara-minat-id').val(),
                lokasi_provinsi: $('#modal-add').find('#provinsi-minat-id').val(),
                lokasi_kota: $('#modal-add').find('#kota-minat-id').val(),
                gaji_nominal: $('#modal-add').find('#gaji-nominal').val(),
                bidang_bisnis: $('#modal-add').find('#bidang-bisnis').val(),
                fungsi_kerja: $('#modal-add').find('#fungsi-kerja').val(),
                posisi_kerja: $('#modal-add').find('#posisi-kerja').val(),
                level_jabatan: $('#modal-add').find('#level-jabatan').val(),
                action: 'minat',
                content: content,
                data_val: val,
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                displayMinat();
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

    function formMinatHarapan(){
        $('#console-placer').html('Data Minat dan Harapan telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
        $('#modal-confirm').modal('show');
        return false;
    }

    // VI Aktifitas
    function formAktifitasSosial(){
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                sport: $('#sport').val(),
                hobby: $('#hobby').val(),
                action: 'sosial',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                $('#console-placer').html('Data Aktifitas telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
            }else{
                $('#console-placer').html('Data gagal disimpan.');
            };
            $('#modal-confirm').modal('show');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    // Organisasi
    function displayOrganisasi(){
        $('#tab_logic_6_2').closest('.field-row').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'organisasi',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#tab_logic_6_2').find('.tbody-data').html(data);
            $('#tab_logic_6_2').closest('.field-row').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function formAddOrganisasi(content,val){
        $('#modal-add').modal('hide');
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                organisasi: $('#modal-add').find('#organisasi').val(),
                periode_awal: $('#modal-add').find('#periode_awal').val(),
                periode_akhir: $('#modal-add').find('#periode_akhir').val(),
                tempat: $('#modal-add').find('#tempat').val(),
                posisi: $('#modal-add').find('#posisi').val(),
                keterangan: $('#modal-add').find('#keterangan').val(),
                action: 'organisasi',
                content: content,
                data_val: val,
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                displayOrganisasi();
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

    // VI Lain-lain
    function formLain(){
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                informasi: $("input[name='sumber-informasi']:checked").val(),
                action: 'informasi',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                $('#console-placer').html('Data Tambahan Lainnya telah disimpan.<br><br><b>Saran:</b><ul><li>Pastikan Anda telah mengisi semua form untuk kelengkapan data lamaran.</li><li>Terdapat 8 form untuk diisi.</li></ul>');
            }else{
                $('#console-placer').html('Data gagal disimpan.');
            };
            $('#modal-confirm').modal('show');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    // Jenis Penyakit
    function displayPenyakit(){
        $('#tab_logic_7_1').closest('.field-row').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'sakit',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#tab_logic_7_1').find('.tbody-data').html(data);
            $('#tab_logic_7_1').closest('.field-row').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function formAddPenyakit(content,val){
        $('#modal-add').modal('hide');
        $.ajax({
            url: 'lamaran-manage',
            type: 'POST',
            data: {
                jenis_penyakit: $('#modal-add').find('#jenis_penyakit').val(),
                periode_awal: $('#modal-add').find('#periode_awal').val(),
                periode_akhir: $('#modal-add').find('#periode_akhir').val(),
                pengaruh: $('#modal-add').find('#pengaruh').val(),
                action: 'sakit',
                content: content,
                data_val: val,
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            if (data == 'success') {
                displayPenyakit();
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

    // VIII Lampiran
    function displayLampiran(){
        $('#lampiran-list').closest('.form-horizontal').find('.display-loading').html('Display loading...');
        $.ajax({
            url: 'lamaran-table-display',
            type: 'POST',
            data: {
                action: 'lampiran',
                auth: '<?php echo $_SESSION["pelamarID"] ?>',
                login: '<?php echo $_SESSION["loginID"] ?>'
            },
        })
        .done(function(data) {
            // console.log("success");
            $('#lampiran-list').html(data);
            $('#lampiran-list').closest('.form-horizontal').find('.display-loading').html('');
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("complete");
        });
        return false;
    }

    function provinsiKosong(){
        // Kosongkan Provinsi
        $('#provinsi').val('');
        $('#provinsi-id').val('');
        provinsi_id = '';
    }

    function kotaKosong(){
        // Kosongkan Kota
        $('#kota').val('');
        $('#kota-id').val('');
        kota_id = '';
    }

    $(document).ready(function() {

        $('#lamaran').on('click', '.manage-lampiran', function(event) {
            source_lampiran = $(this).data('source');
            var input_cek = $("#file_upload");
            input_cek.replaceWith(input_cek.val('').clone(true));
            $('#modal-lampiran').find('.upload-lampiran').hide();
            $('#modal-lampiran').modal('show');
        });

        $('#modal-lampiran').on('click', '.browse-lampiran-modal', function(event) {
            event.preventDefault();
            $('#file_upload').click();
        });

        $("#file_upload").change(function (e) {
            $('#modal-lampiran').find('.upload-lampiran').show();
            $('.loading-lampiran').show();
            $('.upload-lampiran').html('');

            var file_list = e.target.files;

            for (var i = 0, file; file = file_list[i]; i++) {

                var sFileName = file.name;
                var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
                var iFileSize = file.size;
                var iConvert = (file.size / 1024).toFixed(1);
                var maxSize = 500;

                if (!(sFileExtension === "pdf" || 
                      sFileExtension === "jpg" || 
                      sFileExtension === "jpeg"|| 
                      sFileExtension === "png" || 
                      sFileExtension === "bmp" || 
                      sFileExtension === "gif" || 
                      sFileExtension === "xls" || 
                      sFileExtension === "xlsx"|| 
                      sFileExtension === "doc" || 
                      sFileExtension === "docx") || iConvert > maxSize) {

                    notifFile = '<br><div class="text-center">'+
                                    '<dl class="dl-horizontal" style="margin:0">'+
                                        '<dt><span>File name</span></dt><dd class="text-left"><span>'+sFileName+'</span></dd>'+
                                        '<dt><span>Size</span></dt><dd class="text-left"><span>'+iConvert+' KB</span></dd>'+
                                    '</dl>'+
                                    '<hr>'+
                                    '<h4>Pastikan file sesuai ketentuan.</h4>'+
                                '</div>';
                    $('.loading-lampiran').hide().css('display', 'none');
                    $('.upload-lampiran').html('');
                    $('.upload-lampiran').html(notifFile);
                    $('#modal-lampiran').find('.upload-submit').attr('disabled', 'disabled');
                }else{
                    notifFile = '<br><div class="text-center">'+
                                    '<dl class="dl-horizontal" style="margin:0">'+
                                        '<dt><span>File name</span></dt><dd class="text-left"><span>'+sFileName+'</span></dd>'+
                                        '<dt><span>Size</span></dt><dd class="text-left"><span>'+iConvert+' KB</span></dd>'+
                                    '</dl>'+
                                '</div>';
                    $('.loading-lampiran').hide().css('display', 'none');
                    $('.upload-lampiran').html('');
                    $('.upload-lampiran').html(notifFile);
                    $('#modal-lampiran').find('.upload-submit').removeAttr('disabled');
                }
            }
        });

        // Data table
        negara = $('#negara-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": false, "sClass": "text-center", "bVisible": false},        
                { "bSearchable": true, "bSortable": true },     
                { "bSearchable": false, "bSortable": false, "sClass": "text-center"}        
            ],
            "aaSorting": [[ 0, "asc" ]],
            "iDisplayLength": 10,
            "bProcessing": false,
            "bServerSide": true,
            "bLengthChange": false,
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "sAjaxSource": "",
            "fnServerData": function( sSource, aoData, fnCallback ){
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });

        provinsi = $('#provinsi-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible":false },        
                { "bSearchable": false, "bSortable": false, "bVisible":false },     
                { "bSearchable": true, "bSortable": true },        
                { "bSearchable": false, "sClass": "text-center", "bSortable": false },        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": false,
            "bServerSide": true,
            "bLengthChange": false,
            "sAjaxSource": "administrator/master-provinsi-tbl?source=kota&id="+negara_id,
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });

        kota = $('#kota-table').dataTable({
            "aoColumns": [
                { "bSearchable": false, "bSortable": true, "sClass": "text-center", "bVisible":false },        
                { "bSearchable": false, "bSortable": false, "bVisible":false },     
                { "bSearchable": true, "bSortable": true },        
                { "bSearchable": false, "sClass": "text-center", "bSortable": false },        
            ],
            "aaSorting": [[ 0, "desc" ]],
            "iDisplayLength": 10,
            "bProcessing": false,
            "bServerSide": true,
            "bLengthChange": false,
            "sAjaxSource": "administrator/master-kota-tbl?source=lamaran&id="+provinsi_id,
            "bPaginate": true,
            "bSort": true,
            "bAutoWidth": false,
            "fnServerData": function( sSource, aoData, fnCallback ){                           
                $.getJSON( sSource, aoData, function (json) {
                    fnCallback(json);
                });
            }
        });

        $('#add-informal-row').click(function(event) {
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'pendidikan_informal',
                    content: 1,
                    data_val: 0,
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_2_2').on('click', '.edit-informal-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'pendidikan_informal',
                    content: 2,
                    data_val: that.data('id'),
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_2_2').on('click', '.delete-informal-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#modal-delete').find('#console-placer').html("Hapus data <b>"+that.data('nama')+"</b> ?");
            $('#modal-delete').modal('show');
            $('#delete-confirm').click(function(event) {
                /* Act on the event */
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        action: 'pendidikan_informal',
                        content: 3,
                        data_val: that.data('id'),
                        auth: '<?php echo $_SESSION["pelamarID"] ?>',
                        login: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    $('#modal-delete').modal('hide');
                    if (data != 'success') {
                        $('#modal-confirm').find('#console-placer').html("Data gagal dihapus.");
                        $('#modal-confirm').modal('show');
                    }else{
                        displayInformal();
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            });
            return false;
        });

        $('#add-bahasa-row').click(function(event) {
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'bahasa',
                    content: 1,
                    data_val: 0,
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_2_3').on('click', '.edit-bahasa-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'bahasa',
                    content: 2,
                    data_val: that.data('id'),
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_2_3').on('click', '.delete-bahasa-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#modal-delete').find('#console-placer').html("Hapus <b>"+that.data('nama')+"</b> ?");
            $('#modal-delete').modal('show');
            $('#delete-confirm').click(function(event) {
                /* Act on the event */
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        action: 'bahasa',
                        content: 3,
                        data_val: that.data('id'),
                        auth: '<?php echo $_SESSION["pelamarID"] ?>',
                        login: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    $('#modal-delete').modal('hide');
                    if (data != 'success') {
                        $('#modal-confirm').find('#console-placer').html("Data gagal dihapus.");
                        $('#modal-confirm').modal('show');
                    }else{
                        displayBahasa();
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            });
            return false;
        });

        $('#add-pekerjaan-row').click(function(event) {
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'riwayat_pekerjaan',
                    content: 1,
                    data_val: 0,
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
                $('.currency').number( true, 0 );
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_4_1').on('click', '.edit-pekerjaan-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'riwayat_pekerjaan',
                    content: 2,
                    data_val: that.data('id'),
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
                $('.currency').number( true, 0 );
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_4_1').on('click', '.delete-pekerjaan-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#modal-delete').find('#console-placer').html("Hapus data <b>"+that.data('nama')+"</b> ?");
            $('#modal-delete').modal('show');
            $('#delete-confirm').click(function(event) {
                /* Act on the event */
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        action: 'riwayat_pekerjaan',
                        content: 3,
                        data_val: that.data('id'),
                        auth: '<?php echo $_SESSION["pelamarID"] ?>',
                        login: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    $('#modal-delete').modal('hide');
                    if (data != 'success') {
                        $('#modal-confirm').find('#console-placer').html("Data gagal dihapus.");
                        $('#modal-confirm').modal('show');
                    }else{
                        displayPekerjaan();
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            });
            return false;
        });

        $('#add-minat-row').click(function(event) {
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'minat',
                    content: 1,
                    data_val: 0,
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_5_1').on('click', '.edit-minat-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'minat',
                    content: 2,
                    data_val: that.data('id'),
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
                $('.currency').number( true, 0 );
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_5_1').on('click', '.delete-minat-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#modal-delete').find('#console-placer').html("Hapus data <b>"+that.data('nama')+"</b> ?");
            $('#modal-delete').modal('show');
            $('#delete-confirm').click(function(event) {
                /* Act on the event */
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        action: 'minat',
                        content: 3,
                        data_val: that.data('id'),
                        auth: '<?php echo $_SESSION["pelamarID"] ?>',
                        login: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    $('#modal-delete').modal('hide');
                    if (data != 'success') {
                        $('#modal-confirm').find('#console-placer').html("Data gagal dihapus.");
                        $('#modal-confirm').modal('show');
                    }else{
                        displayMinat();
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            });
            return false;
        });

        // Pilih Negara Minat
        $('#negara-table').on('click', '.pilih-minat-negara', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#negara-minat').val(that.data('negara'));
            $('#negara-minat-id').val(that.data('id'));
            negara_minat_id = that.data('id');
            $('#negara-tempat').modal('hide');
        });

        // Pilih Provinsi Minat
        $('#provinsi-table').on('click', '.pilih-minat-provinsi', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#provinsi-minat').val(that.data('provinsi'));
            $('#provinsi-minat-id').val(that.data('id'));
            provinsi_minat_id = that.data('id');
            $('#provinsi-tempat').modal('hide');
        });

        // Pilih Kota Minat
        $('#kota-table').on('click', '.pilih-minat-kota', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#kota-minat').val(that.data('kota'));
            $('#kota-minat-id').val(that.data('id'));
            kota_minat_id = that.data('id');
            $('#kota-tempat').modal('hide');
        });

        // Pilih Minat Lokasi Kerja
        $('body').on('click', '.pilih-tempat-minat', function(event) {
            event.preventDefault();
            var id_element = this.id;
            minatDisplayTempat(id_element);
        });

        $('body').on('focus', '.browse-tempat-minat', function(event) {
            event.preventDefault();
            $(this).closest('.button-browse-placer').find('.pilih-tempat-minat').click();
        });

        // Organisasi
        $('#add-organisasi-row').click(function(event) {
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'organisasi',
                    content: 1,
                    data_val: 0,
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_6_2').on('click', '.edit-organisasi-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'organisasi',
                    content: 2,
                    data_val: that.data('id'),
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_6_2').on('click', '.delete-organisasi-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#modal-delete').find('#console-placer').html("Hapus data <b>"+that.data('nama')+"</b> ?");
            $('#modal-delete').modal('show');
            $('#delete-confirm').click(function(event) {
                /* Act on the event */
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        action: 'organisasi',
                        content: 3,
                        data_val: that.data('id'),
                        auth: '<?php echo $_SESSION["pelamarID"] ?>',
                        login: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    $('#modal-delete').modal('hide');
                    if (data != 'success') {
                        $('#modal-confirm').find('#console-placer').html("Data gagal dihapus.");
                        $('#modal-confirm').modal('show');
                    }else{
                        displayOrganisasi();
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            });
            return false;
        });

        // Penyakit
        $('#add-sakit-row').click(function(event) {
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'sakit',
                    content: 1,
                    data_val: 0,
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_7_1').on('click', '.edit-sakit-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $.ajax({
                url: 'lamaran-modal-display',
                type: 'POST',
                data: {
                    action: 'sakit',
                    content: 2,
                    data_val: that.data('id'),
                    auth: '<?php echo $_SESSION["pelamarID"] ?>',
                    login: '<?php echo $_SESSION["loginID"] ?>'
                },
            })
            .done(function(data) {
                // console.log("success");
                $('#modal-add').find('.modal-content').html(data);
                $('#modal-add').modal('show');
            })
            .fail(function() {
                // console.log("error");
            })
            .always(function() {
                // console.log("complete");
            });
            return false;
        });

        $('#tab_logic_7_1').on('click', '.delete-sakit-row', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#modal-delete').find('#console-placer').html("Hapus data <b>"+that.data('nama')+"</b> ?");
            $('#modal-delete').modal('show');
            $('#delete-confirm').click(function(event) {
                /* Act on the event */
                $.ajax({
                    url: 'lamaran-manage',
                    type: 'POST',
                    data: {
                        action: 'sakit',
                        content: 3,
                        data_val: that.data('id'),
                        auth: '<?php echo $_SESSION["pelamarID"] ?>',
                        login: '<?php echo $_SESSION["loginID"] ?>'
                    },
                })
                .done(function(data) {
                    // console.log("success");
                    $('#modal-delete').modal('hide');
                    if (data != 'success') {
                        $('#modal-confirm').find('#console-placer').html("Data gagal dihapus.");
                        $('#modal-confirm').modal('show');
                    }else{
                        displayPenyakit();
                    };
                })
                .fail(function() {
                    // console.log("error");
                })
                .always(function() {
                    // console.log("complete");
                });
            });
            return false;
        });

        // Pilih Negara
        $('#negara-table').on('click', '.pilih-negara', function(event) {
            event.preventDefault();
            kotaKosong();
            provinsiKosong();
            var that = $(this);
            $('#negara').val(that.data('negara'));
            $('#negara-id').val(that.data('id'));
            negara_id = that.data('id');
            $('#negara-tempat').modal('hide');
        });

        // Pilih Provinsi
        $('#provinsi-table').on('click', '.pilih-provinsi', function(event) {
            event.preventDefault();
            kotaKosong();
            var that = $(this);
            $('#provinsi').val(that.data('provinsi'));
            $('#provinsi-id').val(that.data('id'));
            provinsi_id = that.data('id');
            $('#provinsi-tempat').modal('hide');
        });

        // Pilih Kota
        $('#kota-table').on('click', '.pilih-kota', function(event) {
            event.preventDefault();
            var that = $(this);
            $('#kota').val(that.data('kota'));
            $('#kota-id').val(that.data('id'));
            kota_id = that.data('id');
            $('#kota-tempat').modal('hide');
        });

        // Pilih Tempat
        $('#lamaran').on('click', '.pilih-tempat', function(event) {
            event.preventDefault();
            var id_element = this.id;
            modal_display_tempat(id_element);
        });

        $('#lamaran').on('focus', '.browse-tempat', function(event) {
            event.preventDefault();
            $(this).closest('.button-browse-placer').find('.pilih-tempat').click();
        });

        // Enable input
        $('.table').on('change', '.check', function(event) {
            event.preventDefault();
            if($(this).is(':checked')){
                $(this).closest('tr').find('.input-sm').removeAttr('disabled');
            }else{
                $(this).closest('tr').find('.input-sm').attr('disabled', 'disabled');
                $(this).closest('tr').find('.input-sm').val('');
            }
        });

        // Validate Number
        $('body').on('keydown', '.numeric', function(e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||    // Allow: backspace, delete, tab, escape, enter and .
                (e.keyCode == 65 && e.ctrlKey === true) ||                      // Allow: Ctrl+A
                (e.keyCode >= 35 && e.keyCode <= 39)) {                         // Allow: home, end, left, right
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }

            // Validate IPK 3 digit
            $('.container').on('keyup', '.ipk-3', function(event) {
                event.preventDefault();
                /* Act on the event */
                if ($(this).hasClass('ipk')) {
                    $(this).removeClass('error');
                    if ($(this).val() > 4) {
                        $(this).addClass('error');
                    };
                };
            });

            // Validate IPK 4 digit
            $('.container').on('keyup', '.ipk-4', function(event) {
                event.preventDefault();
                /* Act on the event */
                if ($(this).hasClass('ipk')) {
                    $(this).removeClass('error');
                    if ($(this).val() > 99) {
                        $(this).addClass('error');
                    };
                };
            });
        });

        // View Lampiran
        $('#lamaran').on('click', '.view-lampiran', function(event) {
            event.preventDefault();
            var image_view = $(this).data('image');
            if (image_view != '') {
                $('#modal-confirm').find('#console-placer').html('<div class="text-center"><img class="view-image-modal" src="'+ image_view +'"></div>');
            }else{
                $('#modal-confirm').find('#console-placer').html('<div class="text-center"><i class="fa fa-exclamation-triangle fa-3x text-danger"><h4>File tidak terlampir</h4></div>');
            };
            $('#modal-confirm').modal('show');
        });

        // Auto Fokus Status Kawin
        $('.status-kawin-form').on('click', '.status-kawin', function() {
            $(this).closest('.status-kawin-form').find('.sejak').removeAttr('required').attr('disabled', 'disabled').val('');
            $(this).closest('.radio').find('.sejak').attr('required', 'required').removeAttr('disabled').focus();
        });

        // Tanggal Lahir
        $("#tgl-lahir").ionDatePicker({
            lang: "en",                     // language
            sundayFirst: false,             // first week day
            years: "80",                    // years diapason
            format: "YYYY-MM-DD",           // date format
        });

        // Periode
        $("#modal-add").on('shown.bs.modal', function(){
            $(this).find('#periode_awal').ionDatePicker({
                lang: "en",                     // language
                sundayFirst: false,             // first week day
                years: "50",                    // years diapason
                format: "YYYY-MM-DD",           // date format
            });
            $(this).find('#periode_akhir').ionDatePicker({
                lang: "en",                     // language
                sundayFirst: false,             // first week day
                years: "50",                    // years diapason
                format: "YYYY-MM-DD",           // date format
            });
        });

        // Currency
        $("#modal-add").on('shown.bs.modal', function(){
            var that = $(this);
            that.find('.currency').number( true, 0 );

            that.on('keyup', '.currency', function(event) {
                var val = $(this).val();
                $(this).closest('.currency-group').find('.currency-number').val(( val !== '' ? val : '(empty)' ));
            });
        });

        // Auto Focus Search
        $("#negara-tempat").on('shown.bs.modal', function(){
            $(this).find('input').focus();
        });
        $("#provinsi-tempat").on('shown.bs.modal', function(){
            $(this).find('input').focus();
        });
        $("#kota-tempat").on('shown.bs.modal', function(){
            $(this).find('input').focus();
        });

        // Required Field
        $('.required').find('.main-field').append('<span class="required-main-field">*</span>');
    });
</script>