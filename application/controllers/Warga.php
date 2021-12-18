<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $user = $this->UserModel->cekData(['email' => $this->session->userdata('email')])
            ->row_array();
        $data = [
            'nama' => $user['nama'],
            'status' => $user['status'],
            'username' => $user['username'],
            'created_at' => $user['created_at'],
            'warga' => $this->WargaModel->getWarga()->result_array(),
            'title' => 'Data Warga'
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('warga/index', $data);
        $this->load->view('layouts/footer');
    }

    public function tambah()
    {
        $user = $this->UserModel->cekData(['email' => $this->session->userdata('email')])
            ->row_array();
        $data = [
            'nama' => $user['nama'],
            'status' => $user['status'],
            'username' => $user['username'],
            'created_at' => $user['created_at'],
            'title' => 'Tambah Data Warga'
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('layouts/navbar');
        $this->load->view('layouts/sidebar', $data);
        $this->load->view('warga/tambah_data');
        $this->load->view('layouts/footer');
    }

    public function edit_warga($id_warga)
    {
        $user = $this->UserModel->cekData(['email' => $this->session->userdata('email')])
            ->row_array();
        $data = [
            'nama' => $user['nama'],
            // 'id_warga' => $id_warga,
            'warga' => $this->WargaModel->getWargaById($id_warga),
            'jenis_kelamin' => ['PEREMPUAN', 'LAKI-LAKI'],
            'agama' => ['ISLAM', 'KRISTEN', 'KONGHUCU', 'HINDU', 'BUDHA'],
            'pendidikan_terakhir' => ['SD / SEDERAJAT', 'SMP / SEDERAJAT', 'SMA / SEDERAJAT', 'DIPLOMA I / II', 'DIPLOMA III', 'DIPLOMA IV / STRATA I', 'STRATA II', 'STRATA III'],
            'status_warga' => ['TETAP', 'KONTRAK'],
            'status_perkawinan' => ['KAWIN', 'BELUM KAWIN'],
            'status' => $user['status'],
            'username' => $user['username'],
            'created_at' => $user['created_at'],
            'title' => 'Edit Warga'
        ];

        $this->form_validation->set_rules('nik_warga', 'NIK Warga', 'required|trim|max_length[16]', [
            'max_length' => 'NIK Warga maksimal 16 karakter!'
        ]);
        $this->form_validation->set_rules('nama_warga', 'Nama Warga', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');
        $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rt_rw', 'RT RW', 'required|trim');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('kabupaten_kota', 'Kabupaten Kota', 'required|trim');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('negara', 'Negara', 'required|trim');
        $this->form_validation->set_rules('status_warga', 'Status Warga', 'required|trim');
        $this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('layouts/header', $data);
            $this->load->view('layouts/navbar');
            $this->load->view('layouts/sidebar', $data);
            $this->load->view('warga/edit_data', $data);
            $this->load->view('layouts/footer');
        } else {
            $this->WargaModel->editData();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data warga berhasil di edit</div>');
            redirect('warga/index');
        }
    }

    public function proses_tambah()
    {
        $this->form_validation->set_rules('nik_warga', 'NIK Warga', 'required|trim|max_length[16]', [
            'max_length' => 'NIK Warga maksimal 16 karakter!'
        ]);
        $this->form_validation->set_rules('nama_warga', 'Nama Warga', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim');
        $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required|trim');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('rt_rw', 'RT RW', 'required|trim');
        $this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required|trim');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim');
        $this->form_validation->set_rules('kabupaten_kota', 'Kabupaten Kota', 'required|trim');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required|trim');
        $this->form_validation->set_rules('negara', 'Negara', 'required|trim');
        $this->form_validation->set_rules('status_warga', 'Status Warga', 'required|trim');
        $this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Data Gagal Ditambahkan!</div>');
            redirect('warga/tambah');
        } else {
            $data = [
                'nik_warga' => htmlspecialchars($this->input->post('nik_warga', true)),
                'nama_warga' => htmlspecialchars($this->input->post('nama_warga', true)),
                'tempat_lahir' => htmlspecialchars($this->input->post('tempat_lahir', true)),
                'tanggal_lahir' => htmlspecialchars($this->input->post('tanggal_lahir', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenis_kelamin', true)),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'kelurahan' => htmlspecialchars($this->input->post('kelurahan', true)),
                'kecamatan' => htmlspecialchars($this->input->post('kecamatan', true)),
                'kabupaten_kota' => htmlspecialchars($this->input->post('kabupaten_kota', true)),
                'provinsi' => htmlspecialchars($this->input->post('provinsi', true)),
                'negara' => htmlspecialchars($this->input->post('negara', true)),
                'rt_rw' => htmlspecialchars($this->input->post('rt_rw', true)),
                'agama' => htmlspecialchars($this->input->post('agama', true)),
                'pendidikan_terakhir' => htmlspecialchars($this->input->post('pendidikan_terakhir', true)),
                'status_perkawinan' => htmlspecialchars($this->input->post('status_perkawinan', true)),
                'status_warga' => htmlspecialchars($this->input->post('status_warga', true)),
                'pekerjaan' => htmlspecialchars($this->input->post('pekerjaan', true)),
            ];

            // var_dump($data);
            // die;

            $this->WargaModel->insertData($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data baru telah ditambahkan</div>');
            redirect('warga/index');
        }
    }

    public function hapus_warga($id_warga)
    {
        $this->WargaModel->deleteData($id_warga);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
        redirect('warga/index');
    }
}
