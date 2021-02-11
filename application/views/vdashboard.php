<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-md-6 col-sm-12">
                    <h1>Riwayat Lamaran</h1>
                </div>
            </div>
        </div>
        <div class="card border-danger">
            <div class="body text-danger">
                <h4 class="card-title">Perhatian</h4>
                <p>- Jika telah melamar, status lamaran anda bisa terlihat di bawah ini. </p>
                <p>- Pengumuman kelulusan akan kami kabarkan via telp. </p>
                <p>- Jangan lupa print kartu tanda registrasi pelamar untuk keperluan tes (jika dinyatakan lulus).</p>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12">
                <?php if ($this->session->flashdata('msg')) : ?>
                    <?php echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('msg') . '</div>'; ?>
                <?php endif; ?>
                <div class="table-responsive">
                    <table class="table table-hover table-custom spacing5">
                        <thead>
                            <tr>
                                <th style="width: 20px;">#</th>
                                <th style="width: 20px;">Posisi</th>
                                <th> Pendidikan</th>
                                <th style="width: 20px;"> Assesment</th>
                                <th style="width: 20px;">Dokumen</th>
                                <th style="width: 110px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            if (isset($hasil)) foreach ($hasil as $val) : ?>
                                <tr>
                                    <td>
                                        <span><?php echo $no++ ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ml-0">
                                                <?php echo $val->posisi ?>
                                                <p class="mb-0"><?php echo date("d-m-Y h:i:s", strtotime($val->tgl_lamar)) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ml-0">
                                            <?php echo $val->tingkat . ' - ' . $val->jurusan ?>
                                            <p class="mb-0"><?php echo  $val->nama_institusi ?></p>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($val->id_status_tes != null) : ?>
                                            <a href="#" type="button" onclick="detailnilai(<?= $val->id_kategori_soal ?>)" class="btn btn-success btn-sm" title="Lihat Hasil"><span class="sr-only">Detail Laporan</span> <i class="fa fa-book"></i></a>
                                        <?php else : ?>
                                            <?php if (($val->status)) : ?>
                                                <a href="<?php echo base_url('mulaites') . '?id=' . $val->lowongan ?>" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-sm btn-default" title="Ikuti Assesment"><i class="icon-pencil"></i></a>
                                            <?php else : ?>

                                            <?php endif ?>
                                        <?php endif ?>

                                    </td>
                                    <td><span class="badge badge-<?= $val->status == 'terkirim' || $val->status == 'lulus' ? 'info' : 'danger' ?> ml-0 mr-0"><?php echo $val->status ?></span></td>
                                    <td>
                                        <?php if ($val->status == 'lulus') : ?>
                                            <a href="<?php echo base_url('lowongan/cetakbarcode') . '?id=' . $val->id_submit ?>" data-toggle="tooltip" data-placement="top" type="button" class="btn btn-sm btn-default" title="Print" target="_blank"><i class="icon-printer"></i></a>
                                        <?php endif; ?>
                                        <?php if ($val->status == 'terkirim') : ?>
                                            <a href="<?php echo base_url('lowongan/delete') . '?func=submit&id=' . $val->id_submit ?>" data-toggle="tooltip" data-placement="top" onclick="return confirm('Yakin akan menghapus lamaran ini?')" type="button" class="btn btn-sm btn-default" title="Delete"><i class="icon-trash"></i></a>
                                        <?php endif; ?>
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
<div id="particles-js"></div>

<!-- print nilai -->
<div class="modal fade" id="detaillaporan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Hasil Tes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="detail-laporan">

                </div>

            </div>
        </div>
    </div>
</div>