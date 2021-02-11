<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminconfig extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Muser');
        $this->load->model('Mauth');
        if (($this->session->userdata('id_login') == null) && ($this->session->userdata('status') == null)) {
            $this->session->sess_destroy();
            redirect('auth', 'refresh');
        }
        if ($this->session->userdata('level') == 'user') {
            redirect('dashboard', 'refresh');
        }
    }
    public function index()
    {
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vupdatepass');
        $this->load->view('vfooterlogin');
    }
    public function action_update()
    {
        $id = $this->session->userdata('id_login');
        $newpass = $this->input->post('password_w');
        $hash = password_hash($newpass, PASSWORD_DEFAULT);
        $data = array(
            'password' => $hash,
        );
        $this->Muser->update_data('id_auth', $id, $data, 'auth');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('admin');
    }
    public function tambahadmin()
    {
        $func = $this->input->get('func');
        $id_row = $this->input->get('id');
        if ($func == 'updateadmin') {
            $data['getrow'] = $this->Muser->get_data('id_auth', $id_row, 'auth');
            $data['action'] = base_url('adminconfig/update_admin');
        } else {
            $data['action'] = base_url('adminconfig/create_admin');
        }
        $data['hasil'] = $this->Muser->get_data_allarray('level', 'admin', 'auth');
        $this->load->view('vheaderlogin');
        $this->load->view('vmenu');
        $this->load->view('admin/vtambahadmin', $data);
        $this->load->view('vfooterlogin');
    }
    public function create_admin()
    {
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $cek = $this->Mauth->cek_email($email);
        if (!$cek) {
            $data = array(
                'email' => $email,
                'password' => $hash,
                'level' => 'admin'
            );
            $this->Mauth->create_akun('auth', $data);
            $this->session->set_flashdata('msg', 'Create Account Success !! ');
            redirect('adminconfig/tambahadmin');
        } else {
            $this->session->set_flashdata('msg', 'Email telah terdaftar !!');
            redirect('adminconfig/tambahadmin');
        }
    }
    public function update_admin()
    {
        $id = $this->input->post('id_auth');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $data = array(
            'email' => $email,
            'password' => $hash
        );
        $this->Muser->update_data('id_auth', $id, $data, 'auth');
        $this->session->set_flashdata('msg', 'Berhasil di Update!');
        redirect('adminconfig/tambahadmin');
    }
}
