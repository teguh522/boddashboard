<div id="wrapper">

    <nav class="navbar top-navbar">
        <div class="container-fluid">

            <div class="navbar-left">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                </div>
            </div>

            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo base_url() ?>auth/logout" class="icon-menu"><i class="icon-power"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="progress-container">
            <div class="progress-bar" id="myBar"></div>
        </div>
    </nav>


    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href="<?php echo base_url() ?>admin"><span>Dashboard Sistem</span></a>
            <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
        </div>
        <div class="sidebar-scroll">
            <div class="user-account">
                <div class="user_div">
                    <img src="
                 <?php if (isset($data)) {
                        echo base_url('upload/foto/' . $data->foto);
                    } else {
                        echo base_url('upload/foto/user.png');
                    }
                    ?>" class="user-photo" alt="User Profile Picture">
                </div>
                <div class="dropdown">
                    <span>Selamat Datang,</span>
                    <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown">
                        <strong>
                            <?php
                            if (isset($data)) {
                                echo $data->nama;
                            } else if ($this->session->userdata('level') == 'user') {
                                echo "-";
                            } else {
                                echo "Administrator";
                            } ?>
                        </strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                        <li><a href="<?php echo base_url('auth/update_password') ?>"><i class="icon-user"></i>Setting</a></li>
                    </ul>
                </div>
            </div>
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu">
                    <li class="header">Main</li>
                    <?php if ($this->session->userdata('level') == 'user') { ?>
                        <li><a href="<?php echo base_url() ?>dashboard"><i class="icon-home"></i><span>Dashboard</span></a></li>
                        <li>
                            <a href="#myPage" class="has-arrow"><i class="icon-user"></i><span>Profile</span></a>
                            <ul>
                                <li><a href="<?php echo base_url() ?>profile">Data Utama</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#myPage" class="has-arrow"><i class="icon-briefcase"></i><span>Riwayat</span></a>
                            <ul>
                                <li><a href="<?php echo base_url() ?>riwayat/pendidikan">Pendidikan</a></li>
                                <li><a href="<?php echo base_url() ?>riwayat/kerja">Kerja</a></li>
                                <li><a href="<?php echo base_url() ?>riwayat/dokumen">Dukumen Pendukung</a></li>
                                <li><a href="<?php echo base_url() ?>riwayat/pelatihan">Pelatihan</a></li>
                                <li><a href="<?php echo base_url() ?>riwayat/str">STR/SIP</a></li>
                                <li><a href="<?php echo base_url() ?>riwayat/beasiswa">Beasiswa</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url() ?>lowongan"><i class="icon-pin"></i><span>Daftar Lowongan</span></a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo base_url() ?>admin"><i class="icon-user-following"></i><span>Kunjungan</span></a></li>
                        <li><a href="<?php echo base_url() ?>admin/bor"><i class="icon-grid"></i><span>BOR</span></a></li>
                        <!--<li><a href="<?php echo base_url() ?>admin/postlowongan"><i class="icon-list"></i><span>Lowongan</span></a></li>
                        
                        <li>
                            <a href="#myPage" class="has-arrow"><i class="icon-pencil"></i><span>Assesment</span></a>
                            <ul>
                                <li><a href="<?php echo base_url() ?>assesment/daftarkategori">Kategori Soal</a></li>
                                <li><a href="<?php echo base_url() ?>assesment/daftarsoal">Daftar Soal</a></li>
                                <li><a href="<?php echo base_url() ?>assesment/caridaftarnilai">Nilai Peserta</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#myPage" class="has-arrow"><i class="icon-speech"></i><span>Interview</span></a>
                            <ul>
                                <li><a href="<?php echo base_url() ?>admin/interview">Tambah Interview</a></li>
                                <li><a href="<?php echo base_url() ?>admin/soalinterview">Soal Interview</a></li>
                            </ul>
                        </li>

                        <li><a href="<?php echo base_url() ?>admin/kontrakkerja"><i class="icon-notebook"></i><span>Kontrak Kerja</span></a></li>
                        <li>
                            <a href="#myPage" class="has-arrow"><i class="icon-envelope-open"></i><span>Email</span></a>
                            <ul>
                                <li><a href="<?php echo base_url() ?>sendemail">Send Email</a></li>
                                <li><a href="<?php echo base_url() ?>sendemail/config">Config Email</a></li>
                            </ul>
                        </li> -->
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
    <div class="overlay"></div>