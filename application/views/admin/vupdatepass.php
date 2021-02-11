<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Form Setting</h1>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h2>Ubah Password</h2>
                        <ul class="header-dropdown dropdown">
                            <li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
                        </ul>
                    </div>
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>
                    <div class="body">

                        <div id="form-hidden2">
                            <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php echo base_url('adminconfig/action_update') ?>" novalidate>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" id="password" name="password" data-parsley-minlength="8" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" id="password_w" data-parsley-equalto="#password" name="password_w" data-parsley-minlength="8" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Edit'; ?></button>
                                <a href="<?php echo base_url() ?>" class="btn btn-primary">Batal</a>
                                <a href="<?php echo base_url('adminconfig/tambahadmin') ?>" class="btn btn-primary pull-right">Tambah Admin Baru</a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

</div>

</div>
<div id="particles-js"></div>