  <script src="<?php echo base_url() ?>assets/vendor/bundles/libscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/vendorscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/mainscripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/c3.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/parsleyjs/js/parsley.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/dropify/js/dropify.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/forms/dropify.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/bundles/datatablescripts.bundle.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
  <script src="<?php echo base_url() ?>assets/vendor/tables/jquery-datatable.js"></script>
  <!-- include summernote css/js -->
  <link href="<?php echo base_url() ?>assets/vendor/summernote/dist/summernote.css" rel="stylesheet">
  <script src="<?php echo base_url() ?>assets/vendor/summernote/dist/summernote.js"></script>

  <script src="<?php echo base_url() ?>assets/vendor/sweetalert2.min.js"></script>

  <link href="<?php echo base_url() ?>assets/vendor/select2.min.css" rel="stylesheet" />
  <script src="<?php echo base_url() ?>assets/vendor/select2.min.js"></script>

  <script>
      const api_url = `<?= base_url() ?>admin/getkunjungan`;
      const api_bor = `<?= base_url() ?>admin/getbor`;
  </script>
  <script src="<?php echo base_url() ?>assets/rajal.js"></script>
  <script src="<?php echo base_url() ?>assets/ranap.js"></script>
  <script src="<?php echo base_url() ?>assets/igd.js"></script>
  <script src="<?php echo base_url() ?>assets/bor.js"></script>
  <script>
  </script>
  <script>
      $(function() {
          let searchParams = new URLSearchParams(window.location.search);

          if (searchParams.has('func')) {
              $('#form-hidden').show();
          } else {
              $('#form-hidden').hide();
          }
          $('#basic-form').parsley();
          $('#btntambah').on('click', function(e) {
              e.preventDefault();
              $('#form-hidden').show('slow');
          });

          $('#summernote').summernote({
              //   toolbar: [
              //       ['style', ['bold', 'italic', 'underline', 'clear']],
              //       ['font', ['strikethrough', 'superscript', 'subscript']],
              //       ['fontsize', ['fontsize']],
              //       ['color', ['color']],
              //       ['para', ['ul', 'ol', 'paragraph']],
              //       ['height', ['height']],
              //   ],
              //   placeholder: 'Kualifikasi Loker',
              tabsize: 2,
              height: 230
          });



      });
  </script>
  </body>

  </html>