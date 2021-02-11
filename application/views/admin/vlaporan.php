<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Laporan Pengaduan</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Map Penyebaran Perkecamatan Tahun <?= date('Y') ?></h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    <div class="body">
                        <div id="mapCirebon" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card user_statistics">
                    <div class="header">
                        <h2>Rekap Perkasus Tahun <?= date('Y') ?></h2>
                    </div>
                    <div class="body">
                        <div id="chart-bar" style="height: 302px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card user_statistics">
                    <div class="header">
                        <h2>Rekap Perkecamatan Tahun <?= date('Y') ?></h2>
                    </div>
                    <div class="body">
                        <div id="chart-bar2" style="height: 302px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="particles-js"></div>