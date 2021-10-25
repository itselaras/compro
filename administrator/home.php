<?php 
    include("includes/header.php"); 
    cekLogin(array('1'));  
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><i class="fa fa-home"></i> Dashboard</h1>
        </div>
    </div>
    <p align="justify">Selamat datang di halaman administrator Selaras Mitra Integra. Pastikan data dan informasi telah ter-<i>update</i> untuk kenyamanan pengguna dan menjamin informasi yang valid.</p>
    <hr>
    <label>Master Data</label>
    <div class="row">
        <div class="col-md-4">
            <a href="master-struktur_pekerjaan-bidang_bisnis" class="btn btn-default btn-block"><i class="fa fa-bar-chart-o pull-left fa-fw"></i> Struktur Pekerjaan</a>
        </div>
        <div class="col-md-4">
            <a href="master-jurusan" class="btn btn-default btn-block"><i class="fa fa-bar-chart-o pull-left fa-fw"></i> Bidang Keahlian / Jurusan</a>
        </div>
        <div class="col-md-4">
            <a href="master-negara" class="btn btn-default btn-block"><i class="fa fa-bar-chart-o pull-left fa-fw"></i> Negara</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-4">
            <a href="master-provinsi" class="btn btn-default btn-block"><i class="fa fa-bar-chart-o pull-left fa-fw"></i> Provinsi / Negara Bagian</a>
        </div>
        <div class="col-md-4">
            <a href="master-kota" class="btn btn-default btn-block"><i class="fa fa-bar-chart-o pull-left fa-fw"></i> Kota</a>
        </div>
        <div class="col-md-2"></div>
    </div>
    <hr>
    <label>Sistem Manajemen Data</label>
    <div class="row">
        <div class="col-md-4">
            <a href="pelamar" class="btn btn-default btn-lg btn-block"><i class="fa fa-users pull-left fa-lg fa-fw"></i> Source</a>
        </div>
        <div class="col-md-4">
            <a href="lowongan" class="btn btn-default btn-lg btn-block"><i class="fa fa-briefcase pull-left fa-lg fa-fw"></i> Lowongan</a>
        </div>
        <div class="col-md-4">
            <a href="rekrutmen" class="btn btn-default btn-lg btn-block"><i class="fa fa-tags pull-left fa-lg fa-fw"></i> Pelamar</a>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

    