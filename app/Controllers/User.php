<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\ArtikelModel;
use App\Models\PenyuluhanModel;
use App\Models\AnakModel;
use App\Models\ImunisasiModel;
use App\Models\PemeriksaanposyanduModel;
use App\Models\PesanModel;
use App\Models\PosianduModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $artikelmodel;
    protected $penyuluhanmodel;
    protected $anakmodel;
    protected $imunisasiModel;
    protected $PesanModel;
    protected $PosianduModel;
    protected $PemeriksaanposyanduModel;

    public function __construct()
    {
        $view = \Config\Services::renderer();
        $this->artikelmodel = new ArtikelModel();
        $this->penyuluhanmodel = new PenyuluhanModel();
        $this->anakmodel = new AnakModel();
        $this->imunisasiModel = new ImunisasiModel();
        $this->PemeriksaanposyanduModel = new PemeriksaanposyanduModel();
        $this->PesanModel = new PesanModel();
        $this->PosianduModel = new PosianduModel();
        $this->userModel = new UserModel();
        $data = [
            'totalpesan' => $this->PesanModel->totalMessage(session()->get('id'))
        ];
        $view->setData($data);
    }

    public function index()
    {
        if (session()->get('level') != 4) {
            session()->setFlashdata('warning', 'Anda Belum Login !');
            return redirect()->to(base_url('/home/index'));
        }
        $posiandu = $this->PosianduModel->orderBy('tanggal_posiandu', 'DESC')->findAll();

        $artikel = $this->artikelmodel->findAll();

        $data = [
            'title' => "Panduan Posyandu",
            'artikel' => $artikel,
            'posiandu' => $posiandu
        ];
        return view('user/index', $data);
    }

    public function profile()
    {
        $data = ['title' => "Profile",
                'data' =>  $this->userModel->getOrangtuaId(session()->get('id'))];
        return view('user/profile', $data);
    }

    public function perkembangan()
    {
        $kk = session()->get('id_keluarga');
        $anak = $this->anakmodel->where('id_keluarga', $kk)->findAll();
        $data = [
            'title' => "Perkembangan Anak",
            'anak' => $anak
        ];
        return view('user/perkembangan', $data);
    }

    public function jadwalimunisasi()
    {
        $id = session()->get('id_keluarga');
        // $imunisasi = $this->imunisasiModel->findAll();
        $pemeriksaan = $this->anakmodel->getImunisasiAnak($id);
        $data = [
            'title' => "Daftar Imunisasi",
            // 'imunisasi' => $imunisasi,
            'pemeriksaan' => $pemeriksaan
        ];
        return view('user/jadwalimunisasi', $data);
    }

    public function jadwalposyandu()
    {
        $posiandu = $this->PosianduModel->orderBy('tanggal_posiandu', 'DESC')->findAll();
        $data = [
            'title' => "Jadwal Posiandu",
            'posiandu' => $posiandu
        ];
        return view('user/jadwalposyandu', $data);
    }

    public function penyuluhan()
    {
        $penyuluhan = $this->penyuluhanmodel->findAll();
        $data = [
            'title' => "Penyuluhan",
            'penyuluhan' => $penyuluhan
        ];

        return view('user/penyuluhan', $data);
    }

    public function detailarticle($id)
    {
        $artikel = $this->artikelmodel->getDetail($id);
        $data = [
            'title' => "Artikel",
            'artikel' => $artikel
        ];
        // dd($data);
        return view('user/artikeldetail', $data);
    }

    public function edit_profile()
    {
        $data = ['title' => "Edit Profile",
                'data' => $this->userModel->find(session()->get('id'))];
        return view('user/editprofile', $data);
    }

    public function editProfile($id)
    {
        if ($this->request->getVar('password') != null) {
            $data = array(
                'id' => $id,
                'user_email' => $this->request->getVar('email'),
                'user_name' => $this->request->getVar('username'),
                'user_password' => $this->request->getVar('password'),
                'user_alamat' => $this->request->getVar('alamat'),
                'user_kk' => $this->request->getVar('kk'),
                'user_nik' => $this->request->getVar('nik')
            );
            
        }else{
            $data = array(
                'id' => $id,
                'user_email' => $this->request->getVar('email'),
                'user_name' => $this->request->getVar('username'),
                'user_alamat' => $this->request->getVar('alamat'),
                'user_kk' => $this->request->getVar('kk'),
                'user_nik' => $this->request->getVar('nik')
            );
            
        }
        
        $this->userModel->save($data);
        session()->setFlashdata('berhasil', 'Berhasil mengubah profile , untuk melihat perubahan harap logout terlebih dahulu. ');
        return redirect()->to(base_url('user/edit_Profile'));
    }

    public function detail($id)
    {
        $detail = $this->PemeriksaanposyanduModel->getPerkembangan($id);
        $data = [
            'title' => "Detail Anak",
            'detail' => $detail
        ];
        return view('user/detail', $data);
    }

    public function pesan()
    {
        $iduser = session()->get('id');
        $pesanterkirim = $this->PesanModel->where('id_pengirim', $iduser)->findAll();
        $pesanmasuk = $this->PesanModel->where('id_penerima', $iduser)->findAll();
        $data = [
            'title' => "Pesan",
            'pesanterkirim' => $pesanterkirim,
            'pesanmasuk' => $pesanmasuk
        ];
        return view('user/pesan', $data);
    }

    public function sendmessage(){
        $date = date("Y/m/d");
        $iduser = session()->get('id');
        $data = array(
            'tanggal' => $date,
            'nama_pengirim' => $this->request->getVar('nama_pengirim'),
            'pesan' => $this->request->getVar('pesan'),
            'id_penerima' => 2,
            'id_pengirim' => $iduser,
            'role' => 4
        );
        $this->PesanModel->save($data);
        session()->setFlashdata('berhasil', 'Berhasil mengirim pesan');
        return redirect()->to(base_url('user/pesan'));
    }
}