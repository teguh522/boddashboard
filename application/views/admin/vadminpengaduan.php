<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Form Pengaduan</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>P2TP2A</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>
                    <div class="body">
                        <div id="form-hidden">
                            <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                                <input type="hidden" name="id_pengaduan" value="<?php if (isset($getrow)) echo $getrow->id_pengaduan ?>" class="form-control">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="custom-select" name="kecamatan" data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-multiselect">
                                        <option value="">Silahkan Pilih</option>
                                        <?php foreach ($kecamatan as $item) : ?>
                                            <option value="<?php echo $item->id_kecamatan ?>" <?php
                                                                                                if (isset($getrow)) {
                                                                                                    echo ($getrow->id_kecamatan == $item->id_kecamatan) ? "selected" : "";
                                                                                                }
                                                                                                ?>>
                                                <?php echo $item->nama_kecamatan ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No. KK</label>
                                    <input type="text" name="no_kk" value="<?php if (isset($getrow)) echo $getrow->no_kk ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" value="<?php if (isset($getrow)) echo $getrow->nama_lengkap ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" value="<?php if (isset($getrow)) echo $getrow->tempat_lahir ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input data-provide="datepicker" name='tgl_lahir' data-date-autoclose="true" value="<?php if (isset($getrow)) echo $getrow->tgl_lahir ?>" class="form-control" data-date-format="yyyy-mm-dd" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>Jenis Kelamin</label>
                                    <br />
                                    <label class="fancy-radio">
                                        <input type="radio" name="jk" value="pria" <?php
                                                                                    if (isset($getrow)) {
                                                                                        echo ($getrow->jk == 'pria') ? 'checked' : '';
                                                                                    }
                                                                                    ?> required>
                                        <span><i></i>Pria</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="jk" value="wanita" <?php if (isset($getrow)) {
                                                                                            echo ($getrow->jk == 'wanita') ? 'checked' : '';
                                                                                        } ?> required>
                                        <span><i></i>Wanita</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Tinggal</label>
                                    <textarea class="form-control" name='alamat_tinggal' rows="2" cols="15" required><?php if (isset($getrow)) echo $getrow->alamat_tinggal ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Agama</label>
                                    <input type="text" name="agama" value="<?php if (isset($getrow)) echo $getrow->agama ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Pendidikan</label>
                                    <input type="text" name="pendidikan" value="<?php if (isset($getrow)) echo $getrow->pendidikan ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" value="<?php if (isset($getrow)) echo $getrow->pekerjaan ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Ibu Kandung</label>
                                    <input type="text" name="ibu_kandung" value="<?php if (isset($getrow)) echo $getrow->ibu_kandung ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control" name='alamat' rows="2" cols="15" required><?php if (isset($getrow)) echo $getrow->alamat ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="number" name="hp" value="<?php if (isset($getrow)) echo $getrow->hp ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kasus</label>
                                    <select class="custom-select" name="jenis_kasus" data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-multiselect">
                                        <?php foreach ($jenis_kasus as $item) : ?>
                                            <option value="<?php echo $item->id_kasus ?>" <?php
                                                                                            if (isset($getrow)) {
                                                                                                echo ($getrow->jenis_kasus == $item->id_kasus) ? "selected" : "";
                                                                                            }
                                                                                            ?>>
                                                <?php echo $item->nama_kasus ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Kejadian</label>
                                    <input data-provide="datepicker" name='tgl_kejadian' data-date-autoclose="true" value="<?php if (isset($getrow)) echo $getrow->tgl_kejadian ?>" class="form-control" data-date-format="yyyy-mm-dd" required>
                                </div>
                                <div class="form-group">
                                    <label>Kronologi</label>
                                    <textarea class="form-control" name='kronologi' rows="2" cols="15" required><?php if (isset($getrow)) echo $getrow->kronologi ?></textarea>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Simpan'; ?></button>
                                <a href="<?php echo base_url('pengaduan') ?>" class="btn btn-primary">Batal</a>
                            </form>
                        </div>
                        <a href="#" id="btntambah" class="btn btn-primary pull-right">Tambah</a>
                        <br>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. KK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>TTL</th>
                                        <th>JK</th>
                                        <th>Pendidikan</th>
                                        <th>Pekerjaan</th>
                                        <th>Jenis Kasus</th>
                                        <th>Tanggal Kejadian</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->no_kk; ?></td>
                                            <td><?php echo $val->nama_lengkap; ?></td>
                                            <td><?php echo $val->alamat_tinggal; ?></td>
                                            <td><?php echo $val->tempat_lahir . ", " . date('d M Y', strtotime($val->tgl_lahir)); ?></td>
                                            <td><?php echo $val->jk; ?></td>
                                            <td><?php echo $val->pendidikan; ?></td>
                                            <td><?php echo $val->pekerjaan; ?></td>
                                            <td><?php echo $val->nama_kasus; ?></td>
                                            <td><?php echo $val->tgl_kejadian; ?></td>
                                            <td><?php echo $val->keterangan; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('admin/printlaporan') ?>?idpengaduan=<?= $val->id_pengaduan ?>" target="_blank" rel="noopener noreferrer" type="button" class="btn btn-primary mb-2" title="Print"><span class="sr-only">Print</span><i class="fa fa-print"></i></a>
                                                <a href='<?php echo base_url('admin/pengaduan') . '?func=updatepengaduan&id=' . $val->id_pengaduan ?>' type="button" class="btn btn-success mb-2" title="Edit"><span class="sr-only">Edit</span>
                                                    <i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo base_url('admin/delete') . '?func=pengaduan&id=' . $val->id_pengaduan ?>" onclick="return confirm('Yakin hapus data ini ?')" type="button" class="btn btn-danger mb-2" title="Delete">
                                                    <span class="sr-only">Delete</span> <i class="fa fa-trash-o"></i></a>
                                            </td>
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