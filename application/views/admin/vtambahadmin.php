<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Form Tambah Login</h1>
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
                    <?php if ($this->session->flashdata('msg')) : ?>
                        <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                    <?php endif; ?>
                    <div class="body">
                        <div id="form-hidden">
                            <form id="basic-form" autocomplete="off" method="post" enctype="multipart/form-data" action="<?php if (isset($action)) echo $action ?>" novalidate>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="hidden" name="id_auth" value="<?php if (isset($getrow)) echo $getrow->id_auth ?>">
                                    <input type="email" name="email" value="<?php if (isset($getrow)) echo $getrow->email ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" data-parsley-minlength="8" class="form-control" required>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <label>User Type</label>
                                    <br />
                                    <label class="fancy-radio">
                                        <input type="radio" name="level" value="admin" <?php
                                                                                        if (isset($getrow)) {
                                                                                            echo ($getrow->level == 'admin') ? 'checked' : '';
                                                                                        }
                                                                                        ?> required>
                                        <span><i></i>Admin</span>
                                    </label>
                                    <label class="fancy-radio">
                                        <input type="radio" name="level" value="user" <?php if (isset($getrow)) {
                                                                                            echo ($getrow->level == 'user') ? 'checked' : '';
                                                                                        } ?> required>
                                        <span><i></i>User</span>
                                    </label>
                                    <p id="error-radio"></p>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary"><?php echo (isset($getrow)) ? 'Edit' : 'Simpan'; ?></button>
                                <a href="<?php echo base_url('adminconfig/tambahadmin') ?>" class="btn btn-primary">Batal</a>
                            </form>
                        </div>
                        <p></p>
                        <a href="#" id="btntambah" class="btn btn-primary pull-right">Tambah</a>
                        <div class="table-responsive">
                            <table class="table table-hover js-basic-example dataTable table-custom spacing5">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (isset($hasil)) foreach ($hasil as $val) : ?>
                                        <tr>
                                            <td class="w60"><?php echo $no++; ?></td>
                                            <td><?php echo $val->email; ?></td>
                                            <td>
                                                <?php if ($val->level == 'user') : ?>
                                                    <a href='<?php echo base_url('admin/datautama') . '?id=' . $val->id_auth ?>' type="button" class="btn btn-primary mb-2" title="Data User"><span class="sr-only">Data User</span> <i class="fa fa-plus"></i></a>
                                                <?php endif ?>
                                                <a href='<?php echo base_url('adminconfig/tambahadmin') . '?func=updateadmin&id=' . $val->id_auth ?>' type="button" class="btn btn-success mb-2" title="Edit"><span class="sr-only">Edit</span> <i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo base_url('admin/delete') . '?func=deleteadmin&id=' . $val->id_auth ?>" onclick="return confirm('Yakin hapus data ini ?')" type="button" class="btn btn-danger mb-2" title="Delete">
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
</div>

</div>

</div>
<div id="particles-js"></div>