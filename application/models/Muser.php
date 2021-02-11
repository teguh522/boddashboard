<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Muser extends CI_Model
{

    function create_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    function pagedata($limit, $offset, $coloum, $where, $tabel)
    {
        $this->db->select('*');
        $this->db->from($tabel);
        $this->db->where($coloum, $where);
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }
    function get_data($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function getcvuser($id_auth)
    {
        $data = $this->db->query("Select * from datautama a
        left join jenis_disabilitas b on a.id_disabilitas=b.id_jenis_disabilitas
        where id_user={$id_auth}");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function getprintloker($id)
    {
        $data = $this->db->query("Select * from lowongan a
        left join jenis_disabilitas b on a.id_disabilitas=b.id_jenis_disabilitas
        left join perusahaan_client c on a.id_perusahaan=c.id_perusahaan
        where id_lowongan={$id}");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function getprintsoal()
    {
        $data = $this->db->query("SELECT * FROM kategori_soal as a left join lowongan as b
        on a.id_lowongan=b.id_lowongan left join daftar_soal as c on a.id_kategori_soal=c.id_kategori
        order by a.id_kategori_soal DESC
        ");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_dataone_join(
        $coloum,
        $where,
        $samecoloum,
        $samecoloum2,
        $samecoloum3,
        $tabel1,
        $tabel2,
        $tabel3,
        $tabel4
    ) {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $this->db->join($tabel4, $samecoloum3);
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function get_soal_data($id_kategori, $id_soal, $id_auth, $tabel)
    {
        $this->db->where('id_kategori_soal', $id_kategori);
        $this->db->where('id_soal', $id_soal);
        $this->db->where('id_auth', $id_auth);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function jumlah_benar($tabel, $id, $id_kategori)
    {
        $data = $this->db->query("SELECT * from {$tabel} a join kategori_soal b on a.id_kategori_soal=b.id_kategori_soal
        WHERE id_auth={$id} and jawaban_user=jawaban_benar and a.id_kategori_soal={$id_kategori}");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function daftar_nilai($id_kategori)
    {
        $data = $this->db->query("select * from status_tes a join datautama b 
        on a.id_auth=b.id_user join kategori_soal c on a.id_kategori_soal=c.id_kategori_soal
        join lowongan d on c.id_lowongan=d.id_lowongan
        where a.id_kategori_soal={$id_kategori}");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_jawaban_bykategori($id_kategori)
    {
        $data = $this->db->query("SELECT * FROM jawaban WHERE jawaban_user=jawaban_benar and id_kategori_soal={$id_kategori}");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_last($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->order_by('id_submit', 'DESC');
        $data = $this->db->get($tabel, 1);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function get_data_all($tabel)
    {
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_all_where_join($samecoloum, $coloum, $where, $tabel, $tabel2, $order, $asc)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->where($coloum, $where);
        $this->db->order_by($order, $asc);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_data_array($coloum, $where, $tabel)
    {
        $this->db->join('jenis_pendidikan', 'pendidikan.tingkat_pendidikan=jenis_pendidikan.id_jenis_pendidikan');
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_submit($coloum, $where, $tabel)
    {
        $this->db->join('lowongan', 'submit.lowongan=lowongan.id_lowongan');
        $this->db->join('pendidikan', 'submit.pendidikan=pendidikan.id_pendidikan');
        $this->db->join('jenis_pendidikan', 'pendidikan.tingkat_pendidikan=jenis_pendidikan.id_jenis_pendidikan');
        $this->db->join('kategori_soal', 'submit.lowongan=kategori_soal.id_lowongan');
        $this->db->join('status_tes', 'kategori_soal.id_kategori_soal=status_tes.id_kategori_soal', 'left');
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_cv($coloum, $where, $tabel)
    {
        $this->db->join('lowongan', 'submit.lowongan=lowongan.id_lowongan');
        $this->db->join('pendidikan', 'submit.pendidikan=pendidikan.id_pendidikan');
        $this->db->join('jenis_pendidikan', 'pendidikan.tingkat_pendidikan=jenis_pendidikan.id_jenis_pendidikan');
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_str($coloum, $where, $tabel, $tabel2, $join)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_str_loker($coloum, $where, $tabel, $tabel2, $join)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $this->db->where("status_lowongan", 1);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_str2($coloum, $where, $coloum2, $where2, $tabel, $tabel2, $join)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $this->db->where($coloum2, $where2);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_twojoin($samecoloum, $tabel1, $tabel2)
    {
        $this->db->join($tabel2, $samecoloum);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_twojoinrow($samecoloum, $coloum, $where, $tabel1, $tabel2)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function get_threejoinrow($samecoloum, $samecoloum2, $coloum, $where, $tabel1, $tabel2, $tabel3)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }


    function get_threejoin($samecoloum, $samecoloum2, $tabel1, $tabel2, $tabel3)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_multijoin(
        $samecoloum,
        $samecoloum2,
        $samecoloum3,
        $samecoloum4,
        $tabel1,
        $tabel2,
        $tabel3,
        $tabel4,
        $tabel5
    ) {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $this->db->join($tabel4, $samecoloum3);
        $this->db->join($tabel5, $samecoloum4);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_threejoin_admin($samecoloum, $samecoloum2, $tabel1, $tabel2, $tabel3)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $this->db->where("status_lowongan", 1);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_email_penerima($tabel, $coloum, $where1, $where2)
    {
        $this->db->select('auth.email,datautama.nama');
        $this->db->join('auth', "{$tabel}.id_user = auth.id_auth");
        $this->db->join('datautama', "auth.id_auth = datautama.id_user");
        $this->db->where("{$tabel}.{$coloum}", $where1);
        $this->db->like("auth.email", $where2);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function caridatapelamarlike($kolom, $where2, $tabel)
    {
        $this->db->join('datautama', 'submit.id_user=datautama.id_user');
        $this->db->join('jenis_disabilitas', 'datautama.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas');
        $this->db->join('lowongan', 'submit.lowongan=lowongan.id_lowongan');
        $this->db->join('perusahaan_client', 'lowongan.id_perusahaan=perusahaan_client.id_perusahaan');
        $this->db->where('status', 'lulus');
        $this->db->like($kolom, $where2);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function tampilkontrak($tabel)
    {
        $this->db->join('submit', 'kontrak_kerja.id_submit=submit.id_submit');
        $this->db->join('datautama', 'submit.id_user=datautama.id_user');
        $this->db->join('jenis_disabilitas', 'datautama.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas');
        $this->db->join('lowongan', 'submit.lowongan=lowongan.id_lowongan');
        $this->db->join('perusahaan_client', 'lowongan.id_perusahaan=perusahaan_client.id_perusahaan');
        $this->db->where('status', 'lulus');
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function caridatalike($kolom, $where2, $tabel)
    {
        $this->db->like($kolom, $where2);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function cari_loker($tabel, $where2, $coloum, $where, $coloum2, $where3)
    {
        $this->db->select('*');
        $this->db->join('perusahaan_client', 'lowongan.id_perusahaan=perusahaan_client.id_perusahaan');
        $this->db->join('jenis_disabilitas', 'lowongan.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas');
        $this->db->where($coloum2, $where3);
        $this->db->where($coloum, $where);
        $this->db->where('status_lowongan', 1);
        $this->db->like("{$tabel}.posisi", $where2);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_config_email($tabel)
    {
        $this->db->select('id_config_email,protocol,smtp_host,smtp_port,smtp_user,
        smtp_pass,smtp_crypto,mailtype,smtp_timeout,charset,wordwrap');
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function get_data_allarray($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_allarray_loker($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->where('status_lowongan', 1);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_by_disabilitas($coloum, $where, $tabel, $coloum2, $where2)
    {
        $this->db->join('perusahaan_client', 'lowongan.id_perusahaan=perusahaan_client.id_perusahaan');
        $this->db->join('jenis_disabilitas', 'lowongan.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas');
        $this->db->where($coloum2, $where2);
        $this->db->where($coloum, $where);
        $this->db->where('status_lowongan', 1);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_filter($coloum, $minvalue, $maxvalue, $coloum1, $where1, $coloum2, $where2, $tabel)
    {
        $this->db->join('datautama', 'submit.id_user=datautama.id_user');
        $this->db->join('auth', 'datautama.id_user=auth.id_auth');
        $this->db->join('lowongan', 'submit.lowongan=lowongan.id_lowongan');
        $this->db->join('pendidikan', 'submit.pendidikan=pendidikan.id_pendidikan');
        $this->db->join('jenis_pendidikan', 'pendidikan.tingkat_pendidikan=jenis_pendidikan.id_jenis_pendidikan');
        $this->db->join('jenis_disabilitas', 'datautama.id_disabilitas=jenis_disabilitas.id_jenis_disabilitas');
        $this->db->where($coloum1, $where1);
        $this->db->where($coloum2, $where2);
        $this->db->where($coloum . ' BETWEEN "' . date('Y-m-d', strtotime($minvalue)) . '" and "' . date('Y-m-d', strtotime($maxvalue)) . '"');
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function update_data($coloum, $where, $data, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->update($tabel, $data);
    }

    function cek_noktp($noktp)
    {
        $this->db->where('noktp', $noktp);
        $data = $this->db->get('datautama');
        if ($data->num_rows() > 0) {
            return true;
        }
        return false;
    }
    function delete($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->delete($tabel);
    }
}
