<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
        $this->load->library('curl');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('auth', 'refresh');
        }
        if ($this->session->userdata('level') == 'user') {
            redirect('dashboard', 'refresh');
        }
    }
    public $urlapi = "http://36.91.115.125:9192";

    public function index()
    {
        $data = $this->rest_getapi("{$this->urlapi}/laporankunjungan");
        $hasil = json_decode($data);
        $majarajal = 0;
        $majaranap = 0;
        $majaigd = 0;
        $kdwrajal = 0;
        $kdwranap = 0;
        $kdwigd = 0;
        $malraj = 0;
        $malran = 0;
        $maligd = 0;
        foreach ($hasil->data as $val) {
            if (date('m', strtotime($val->tgl)) == date('m')) {
                if ($val->kode_entitas == 6) {
                    $majarajal = $majarajal + $val->rajal;
                    $majaranap = $majaranap + $val->ranap;
                    $majaigd = $majaigd + $val->igd;
                } else if ($val->kode_entitas == 5) {
                    $kdwrajal = $kdwrajal + $val->rajal;
                    $kdwranap = $kdwranap + $val->ranap;
                    $kdwigd = $kdwigd + $val->igd;
                } else if ($val->kode_entitas == 7) {
                    $malraj = $malraj + $val->rajal;
                    $malran = $malran + $val->ranap;
                    $maligd = $maligd + $val->igd;
                }
            }
        }
        $kunjungan['totmaja'] = $majarajal + $majaranap + $majaigd;
        $kunjungan['totkdw'] = $kdwrajal + $kdwranap + $kdwigd;
        $kunjungan['totmalang'] = $malraj + $malran + $maligd;
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vdashboard', $kunjungan);
        $this->load->view('vfooterlogin');
    }
    function rest_getapi($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlciI6InRlZ3VoIiwiY3JlYXRlZEF0IjoiMjAyMS0wMi0yNVQwMjo1MTozMC40NjhaIiwidXBkYXRlZEF0IjoiMjAyMS0wMi0yNVQwMjo1MTozMC40NjhaIiwiaWF0IjoxNjE0MjIxNTgzfQ.YeT3yjFRsFvoNZLbkFLxwTOj3aT0QLswYUJsvu6K8zA'
        ));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    function getkunjungan()
    {
        $data = $this->rest_getapi("{$this->urlapi}/laporankunjungan");
        echo $data;
    }
    function bor()
    {
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vbor');
        $this->load->view('vfooterlogin');
    }
    function getbor()
    {
        $data = $this->rest_getapi("{$this->urlapi}/laporanbor");
        echo $data;
    }

    public function datapelamar()
    {
        $data['hasil'] = $this->Muser->get_data_allarray_loker('tgl_akhir >=', date('Y-m-d'), 'lowongan');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vfilterdata', $data);
        $this->load->view('vfooterlogin');
    }
    public function caridata()
    {
        $tgl_awal = $this->input->post('tgl_awal');
        $tgl_akhir = $this->input->post('tgl_akhir');
        $lowongan = $this->input->post('lowongan');
        $status = $this->input->post('status');
        $data['hasil'] = $this->Muser->get_data_filter(
            'tgl_lamar',
            $tgl_awal,
            $tgl_akhir,
            'lowongan',
            $lowongan,
            'submit.status',
            $status,
            'submit'
        );
        // $jawaban = $this->Muser->jumlah_benar('jawaban', 'jawaban_user', 'jawaban_benar');
        // if ($jawaban != null) {
        //     $data['totalbenar'] = count($jawaban);
        // } else {
        //     $data['totalbenar'] = '-';
        // }
        if ($data == null) {
            echo "Data Tidak Di Temukan";
        } else {
            $this->load->view('vheaderlogin');
            $this->load->view('vmenu');
            $this->load->view('admin/vtampildata', $data);
            $this->load->view('vfooterlogin');
        }
    }
    public function detailpelamar()
    {
        $id_submit = $this->input->get('id');
        $submit = $this->Muser->get_data('id_submit', $id_submit, 'submit');

        if ($submit == null || $submit == 'undefined') {
            echo "Data tidak ditemukan";
        } else {
            $id = $submit->id_user;
            $data['id_submit'] = $id_submit;
            $data['submit'] = $this->Muser->get_data_join_str('id_submit', $id_submit, 'submit', 'lowongan', 'submit.lowongan=lowongan.id_lowongan');
            $data['email'] = $this->Muser->get_data_allarray('id_auth', $id, 'auth');
            $data['biodata'] = $this->Muser->get_data_allarray('id_user', $id, 'datautama');
            $data['pendidikan'] = $this->Muser->get_data_join_str('id_user', $id, 'pendidikan', 'jenis_pendidikan', 'pendidikan.tingkat_pendidikan=jenis_pendidikan.id_jenis_pendidikan');
            $data['disabilitas'] = $this->Muser->get_data_join_str('id_user', $id, 'datautama', 'jenis_disabilitas', 'datautama.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas');
            $data['kerja'] = $this->Muser->get_data_allarray('id_user', $id, 'kerja');
            $data['dokumen'] = $this->Muser->get_data_join_str('id_user', $id, 'dokumen', 'jenis_dokumen', 'dokumen.jenis_dokumen=jenis_dokumen.id_jenis_dokumen');
            $data['str'] = $this->Muser->get_data_join_str('id_user', $id, 'str', 'jenis_str', 'str.jenis_str=jenis_str.id_jenis_str');
            $data['pelatihan'] = $this->Muser->get_data_allarray('id_user', $id, 'pelatihan');
            $data['beasiswa'] = $this->Muser->get_data_allarray('id_user', $id, 'beasiswa');
            $this->load->view('vheaderlogin');
            $this->load->view('vmenu');
            $this->load->view('admin/vdetaildata', $data);
            $this->load->view('vfooterlogin');
        }
    }
    public function postlowongan()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');
        if ($func == 'updatelowongan') {
            $data['getrow'] = $this->Muser->get_data('id_lowongan', $id_row, 'lowongan');
            $data['action'] = base_url('admin/update_postlowongan');
        } else {
            $data['action'] = base_url('admin/create_postlowongan');
        }
        $data['hasil'] = $this->Muser->get_threejoin_admin(
            'lowongan.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas',
            'lowongan.id_perusahaan=perusahaan_client.id_perusahaan',
            'lowongan',
            'jenis_disabilitas',
            'perusahaan_client'
        );
        $data['jenis_disabilitas'] = $this->Muser->get_data_all('jenis_disabilitas');
        $data['jenis_usaha'] = $this->Muser->get_data_all('perusahaan_client');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vpostlowongan', $data);
        $this->load->view('vfooterlogin');
    }
    public function create_postlowongan()
    {
        $data = array(
            'posisi' => $this->input->post('posisi'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_disabilitas' => $this->input->post('id_disabilitas'),
            'id_perusahaan' => $this->input->post('id_perusahaan')
        );
        $this->Muser->create_data('lowongan', $data);
        $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
        redirect('admin/postlowongan');
    }
    public function update_postlowongan()
    {
        $id = $this->input->post('id_lowongan');
        $data = array(
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'deskripsi' => $this->input->post('deskripsi'),
            'id_disabilitas' => $this->input->post('id_disabilitas'),
            'id_perusahaan' => $this->input->post('id_perusahaan')
        );
        $this->Muser->update_data('id_lowongan', $id, $data, 'lowongan');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('admin/postlowongan');
    }
    public function validasi()
    {
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vvalidasi');
        $this->load->view('vfooterlogin');
    }
    public function cari_validasi()
    {
        $id_submit = $this->input->get('noreg');
        $submit = $this->Muser->get_data('id_submit', $id_submit, 'submit');
        $id = $submit->id_user;
        if ($id_submit == null) {
            echo "No registrasi tidak boleh kosong";
        } else {
            if ($submit->status != 'terkirim') {
                $url = base_url('admin/validasi');
                echo '<script>';
                echo 'alert("Pelamar ini sudah tervalidasi.!!");';
                echo 'window.location= "' . $url . '";';
                echo '</script>';
            } else {
                $data['submit'] = $this->Muser->get_data_join_str('id_submit', $id_submit, 'submit', 'lowongan', 'submit.lowongan=lowongan.id_lowongan');
                $data['biodata'] = $this->Muser->get_data_allarray('id_user', $id, 'datautama');
                $this->load->view('vheaderlogin');
                $this->load->view('vmenu');
                $this->load->view('admin/vpostvalidasi', $data);
                $this->load->view('vfooterlogin');
            }
        }
    }
    public function validasi_viaajax()
    {
        $id = $this->input->post('id_submit');
        $status = $this->input->post('status');
        $data = array(
            'status' => $status,
        );
        $this->Muser->update_data('id_submit', $id, $data, 'submit');
        echo json_encode("200");
    }
    public function create_validasi()
    {
        $id = $this->input->post('id_submit');
        $data = array(
            'status' => $this->input->post('status'),
        );
        $this->Muser->update_data('id_submit', $id, $data, 'submit');
        $this->session->set_flashdata('msg', 'Berhasil di Validasi!');
        redirect('admin/validasi');
    }

    function perusahaan()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');
        if ($func == 'updateperusahaan') {
            $data['getrow'] = $this->Muser->get_data('id_perusahaan', $id_row, 'perusahaan_client');
            $data['action'] = base_url('admin/update_perusahaan');
        } else {
            $data['action'] = base_url('admin/create_perusahaan');
        }
        $data['hasil'] = $this->Muser->get_data_all('perusahaan_client');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vperusahaan', $data);
        $this->load->view('vfooterlogin');
    }
    function create_perusahaan()
    {
        $data = array(
            'nama_usaha' => $this->input->post('nama_usaha'),
            'bidang_usaha' => $this->input->post('bidang_usaha'),
            'lokasi_usaha' => $this->input->post('lokasi_usaha'),
            'alamat_usaha' => $this->input->post('alamat_usaha'),
            'hp_usaha' => $this->input->post('hp_usaha'),
            'email_usaha' => $this->input->post('email_usaha')
        );
        $this->Muser->create_data('perusahaan_client', $data);
        $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
        redirect('admin/perusahaan');
    }
    function update_perusahaan()
    {
        $id = $this->input->post('id_perusahaan');
        $data = array(
            'nama_usaha' => $this->input->post('nama_usaha'),
            'bidang_usaha' => $this->input->post('bidang_usaha'),
            'lokasi_usaha' => $this->input->post('lokasi_usaha'),
            'alamat_usaha' => $this->input->post('alamat_usaha'),
            'hp_usaha' => $this->input->post('hp_usaha'),
            'email_usaha' => $this->input->post('email_usaha')
        );
        $this->Muser->update_data('id_perusahaan', $id, $data, 'perusahaan_client');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('admin/perusahaan');
    }
    function kontrakkerja()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');
        if ($func == 'updatekontrak') {
            $data['getrow'] = $this->Muser->get_dataone_join(
                'id_kontrak_kerja',
                $id_row,
                'kontrak_kerja.id_submit=submit.id_submit',
                'submit.id_user=datautama.id_user',
                'submit.lowongan=lowongan.id_lowongan',
                'kontrak_kerja',
                'submit',
                'datautama',
                'lowongan'
            );
            $data['action'] = base_url('admin/update_kontrakkerja');
        } else {
            $data['action'] = base_url('admin/create_kontrakkerja');
        }
        $data['jenis_disabilitas'] = $this->Muser->get_data_all('jenis_disabilitas');
        $data['jenis_usaha'] = $this->Muser->get_data_all('perusahaan_client');
        $data['hasil'] = $this->Muser->tampilkontrak('kontrak_kerja');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vkontrakkerja', $data);
        $this->load->view('vfooterlogin');
    }
    function create_kontrakkerja()
    {
        $data = array(
            'status_kontrak' => $this->input->post('status_kontrak'),
            'id_submit' => $this->input->post('id_submit'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'nama_pembuat' => $this->input->post('nama_pembuat')
        );
        $this->Muser->create_data('kontrak_kerja', $data);
        $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
        redirect('admin/kontrakkerja');
    }
    function update_kontrakkerja()
    {
        $id = $this->input->post('id_kontrak_kerja');
        $data = array(
            'status_kontrak' => $this->input->post('status_kontrak'),
            'id_submit' => $this->input->post('id_submit'),
            'tgl_awal' => $this->input->post('tgl_awal'),
            'tgl_akhir' => $this->input->post('tgl_akhir'),
            'nama_pembuat' => $this->input->post('nama_pembuat')
        );
        $this->Muser->update_data('id_kontrak_kerja', $id, $data, 'kontrak_kerja');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('admin/kontrakkerja');
    }
    function caripelamarjson()
    {
        $param = $this->input->get('param');
        $data = $this->Muser->caridatapelamarlike('nama', $param, 'submit');
        echo json_encode($data);
    }
    function cariperusahaanjson()
    {
        $param = $this->input->get('param');
        $data = $this->Muser->caridatalike('nama_usaha', $param, 'perusahaan_client');
        echo json_encode($data);
    }
    function interview()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');
        if ($func == 'updateinterview') {
            $data['getrow'] = $this->Muser->get_dataone_join(
                'id_interview',
                $id_row,
                'interview.id_submit=submit.id_submit',
                'submit.id_user=datautama.id_user',
                'submit.lowongan=lowongan.id_lowongan',
                'interview',
                'submit',
                'datautama',
                'lowongan'
            );
            $data['action'] = base_url('admin/update_interview');
        } else {
            $data['action'] = base_url('admin/create_interview');
        }
        $data['hasil'] = $this->Muser->get_multijoin(
            'interview.id_submit=submit.id_submit',
            'submit.id_user=datautama.id_user',
            'submit.lowongan=lowongan.id_lowongan',
            'lowongan.id_perusahaan=perusahaan_client.id_perusahaan',
            'interview',
            'submit',
            'datautama',
            'lowongan',
            'perusahaan_client'
        );
        $data['soal'] = $this->Muser->get_data_all('soal_interview');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vinterview', $data);
        $this->load->view('vfooterlogin');
    }
    function create_interview()
    {
        $data = array(
            'id_submit' => $this->input->post('id_submit'),
            'tgl_interview' => $this->input->post('tgl_interview'),
            'nama_interviewer' => $this->input->post('nama_interviewer'),
        );
        $this->Muser->create_data('interview', $data);
        $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
        redirect('admin/interview');
    }
    function update_interview()
    {
        $id = $this->input->post('id_interview');
        $data = array(
            'id_submit' => $this->input->post('id_submit'),
            'tgl_interview' => $this->input->post('tgl_interview'),
            'nama_interviewer' => $this->input->post('nama_interviewer'),
        );
        $this->Muser->update_data('id_interview', $id, $data, 'interview');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('admin/interview');
    }
    public function soalinterview()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');
        if ($func == 'updatesoalinterview') {
            $data['getrow'] = $this->Muser->get_data('id_soal_interview', $id_row, 'soal_interview');
            $data['action'] = base_url('admin/update_soalinterview');
        } else {
            $data['action'] = base_url('admin/create_soalinterview');
        }
        $data['hasil'] = $this->Muser->get_data_all('soal_interview');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vsoalinterview', $data);
        $this->load->view('vfooterlogin');
    }
    public function create_soalinterview()
    {
        $data = array(
            'soal_interview' => $this->input->post('soal_interview'),
        );
        $this->Muser->create_data('soal_interview', $data);
        $this->session->set_flashdata('msg', 'Berhasil Tersimpan!');
        redirect('admin/soalinterview');
    }
    public function update_soalinterview()
    {
        $id = $this->input->post('id_soal_interview');
        $data = array(
            'soal_interview' => $this->input->post('soal_interview'),
        );
        $this->Muser->update_data('id_soal_interview', $id, $data, 'soal_interview');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('admin/soalinterview');
    }
    function getexistinterview()
    {
        $id = $this->input->post('id_interview');
        $data = $this->Muser->get_data_all_where_join(
            'jawaban_interview.id_soal_interview=soal_interview.id_soal_interview',
            'id_interview',
            $id,
            'jawaban_interview',
            'soal_interview',
            'jawaban_interview.id_soal_interview',
            'ASC'
        );
        echo json_encode($data);
    }
    function jawabaninterview()
    {
        $soal = $this->input->post('id_soal[]');
        $jwb = $this->input->post('jwb_int[]');

        foreach ($soal as $key => $value) {
            $data = array(
                'id_interview' => $this->input->post('id_interview'),
                'id_soal_interview' => $value,
                'jawaban_interview' => $jwb[$key]
            );
            $this->Muser->create_data('jawaban_interview', $data);
        }
        echo json_encode("Berhasil");
    }
    public function delete()
    {
        $func = $this->input->get('func');
        $id = $this->input->get('id');
        if ($func == 'perusahaan') {
            $this->Muser->delete('id_perusahaan', $id, 'perusahaan_client');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('admin/perusahaan');
        } elseif ($func == 'lowongan') {
            $this->Muser->update_data('id_lowongan', $id, ['status_lowongan' => 0], 'lowongan');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('admin/postlowongan');
        } elseif ($func == 'interview') {
            $this->Muser->delete('id_interview', $id, 'interview');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('admin/interview');
        } elseif ($func == 'soalinterview') {
            $this->Muser->delete('id_soal_interview', $id, 'soal_interview');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('admin/soalinterview');
        } elseif ($func == 'kontrakkerja') {
            $this->Muser->delete('id_kontrak_kerja', $id, 'kontrak_kerja');
            $this->session->set_flashdata('msg', 'Terhapus!');
            redirect('admin/kontrakkerja');
        }
    }
}
