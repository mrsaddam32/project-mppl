<?php

class WargaModel extends CI_Model
{
    public function getWarga()
    {
        return $this->db->get('warga');
    }

    public function insertData($data = null)
    {
        return $this->db->insert('warga', $data);
    }

    public function deleteData($nik_warga)
    {
        return $this->db->delete('warga', ['nik_warga' => $nik_warga]);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('warga', $where);
    }

    public function countAll()
    {
        return $this->db->count_all('warga');
    }

    public function countJenisKelamin($jenis_kelamin)
    {
        return $this->db->where('jenis_kelamin', $jenis_kelamin)->count_all_results('warga');
    }
}
