<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Form Data Asal User</h1>
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
                        <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                            <input type="hidden" name="id_datautama" value="<?php if (isset($getrow)) echo $getrow->id_datautama ?>" class="form-control">
                            <input type="hidden" name="id_user" value="<?= $this->input->get('id') ?>" class="form-control">
                            <div class="form-group">
                                <label>Ka. UPT</label>
                                <select class="custom-select" name="kecamatan" data-parsley-required data-parsley-trigger-after-failure="change" data-parsley-errors-container="#error-multiselect">
                                    <option value="">Silahkan Pilih</option>
                                    <?php foreach ($kecamatan as $item) : ?>
                                        <option value="<?php echo $item->id_kecamatan ?>" <?php
                                                                                            if (isset($getrow)) {
                                                                                                echo ($getrow->ka_upt == $item->id_kecamatan) ? "selected" : "";
                                                                                            }
                                                                                            ?>>
                                            <?php echo $item->nama_kecamatan ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" value="<?php if (isset($getrow)) echo $getrow->nama ?>" class="form-control" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Simpan'; ?></button>
                            <a href="<?php echo base_url('adminconfig/tambahadmin') ?>" class="btn btn-primary">Batal</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="particles-js"></div>