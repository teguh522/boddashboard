<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Laporan Pengaduan </h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>

                    <div class="body">
                        <div class="table-responsive">
                            <table id="table-data" class="table table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kasus</th>
                                        <th>Pria</th>
                                        <th>Wanita</th>
                                        <th>Total Kasus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $val->nama_kasus . "(" . $val->tahun . ")" ?></td>
                                            <td><?php echo $val->pria ?></td>
                                            <td><?php echo $val->wanita ?></td>
                                            <td><?php echo $val->totalkasus ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="particles-js"></div>