<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Total Kunjungan Bulan Ini</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Majalengka</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($totmaja) ? $totmaja : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-azura text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Kedawung</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($totkdw) ? $totkdw : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="body">
                        <div class="d-flex align-items-center">
                            <div class="icon-in-bg bg-orange text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
                            <div class="ml-4">
                                <span>Malang</span>
                                <h4 class="mb-0 font-weight-medium"><?= isset($totmalang) ? $totmalang : '-' ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Grafik Kunjungan RAJAL 10 Hari Terakhir </h2>
                    </div>
                    <div class="body">
                        <div id="chart-bar" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Grafik Kunjungan RANAP 10 Hari Terakhir </h2>
                    </div>
                    <div class="body">
                        <div id="chart-bar2" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Grafik Kunjungan IGD 10 Hari Terakhir </h2>
                    </div>
                    <div class="body">
                        <div id="chart-bar3" style="height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div id="particles-js"></div>