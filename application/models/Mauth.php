<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mauth extends CI_Model
{

    function cek_email($email)
    {
        $this->db->where('email', $email);
        $data = $this->db->get('auth');
        if ($data->num_rows() > 0) {
            return true;
        }
        return false;
    }
    function cek_password($email)
    {
        $this->db->where('email', $email);
        $data = $this->db->get('auth');
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function create_akun($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }
}
