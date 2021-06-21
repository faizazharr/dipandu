<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ImunisasiModel;
use App\Models\PosianduModel;
use App\Models\DetailImunisasiModel;
use App\Models\AnakModel;
use App\Models\KeluargaModel;
use App\Models\PemeriksaanposyanduModel;
use App\Models\DetailPosianduModel;
use App\Models\LaporanModel;

class Kader extends BaseController
{
    protected $anakModel;
    protected $userModel;
    protected $detailImunisasiModel;
    protected $imunisasiModel;
    protected $KeluargaModel;
    protected $PosianduModel;
    protected $PemeriksaanposyanduModel;
    protected $DetailPosianduModel;
    protected $LaporanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->imunisasiModel = new ImunisasiModel();
        $this->detailImunisasiModel = new DetailImunisasiModel();
        $this->anakModel = new AnakModel();
        $this->KeluargaModel = new KeluargaModel();
        $this->PosianduModel = new PosianduModel();
        $this->PemeriksaanposyanduModel = new PemeriksaanposyanduModel();
        $this->DetailPosianduModel = new DetailPosianduModel();
        $this->LaporanModel = new LaporanModel();
    }

    public function index()
    {
        if (session()->get('level') != 3) {
            session()->setFlashdata('warning', 'Anda Belum Login !');
            return redirect()->to(base_url('/home/index'));
        }

        $user = $this->userModel->getKader();

        $data = [
            'title' => "Data Kader",
            'user' => $user
        ];

        return view('kader/index', $data);
    }

    public function detailkeluarga($slug)
    {
        $detail = $this->anakModel->where('id_keluarga', $slug)->findAll();
        $orangtua = $this->KeluargaModel->getKeluarga($slug);

        $data = [
            'title' => "Data Anak",
            'detail' => $detail,
            'orangtua' => $orangtua
        ];
        // dd($detail);
        return view('kader/datakeluarga', $data);
    }

    public function datakeluarga()
    {
        $user = $this->userModel->getOrangtua();
        $data = [
            'title' => "Data Orangtua",
            'user' => $user
        ];
        // dd($user);
        return view('kader/keluarga', $data);
    }

    public function imunisasiKeluarga()
    {
        $id = $this->request->getPost('id');

        $anak = $this->anakModel->find($id);
        $detail = $this->detailImunisasiModel->getAllImunisasiDetail($id);
        $data = [
            'title' => "Imunisasi Anak",
            'anak' => $anak,
            'imunisasi' => $detail
        ];
        // dd($data);
        return view('kader/imunisasianak', $data);
    }

    public function jadwalimunisasi()
    {
        $imunisasi = $this->imunisasiModel->orderBy('tanggal_imunisasi', 'DESC')->findAll();

        $data = [
            'title' => "Daftar Imunisasi",
            'imunisasi' => $imunisasi
        ];

        return view('kader/jadwalimunisasi', $data);
    }

    public function addimunisasi()
    {

        $data = array(
            'nama_imunisasi' => $this->request->getVar('imunisasi'),
            'tanggal_imunisasi' => $this->request->getVar('date'),
        );

        $imunisasi = $this->imunisasiModel->saveData($data);
        $anak = $this->anakModel->findAll();
        $this->detailImunisasiModel->saveImunisasi($imunisasi, $anak);


        session()->setFlashdata('tambah', 'berhasil tambah imunisasi');
        return redirect()->to('jadwalimunisasi');
    }

    public function editimunisasi($id)
    {
        $data = array(
            'id' => $id,
            'nama_imunisasi' => $this->request->getVar('imunisasi'),
            'tanggal_imunisasi' => $this->request->getVar('date'),
        );

        $this->imunisasiModel->save($data);
        session()->setFlashdata('update', 'berhasil update imunisasi');
        return redirect()->to('/kader/jadwalimunisasi');
    }

    public function deleteImunisasi($id)
    {
        $this->imunisasiModel->delete($id);
        session()->setFlashdata('delete', 'Data Berhasil Dihapus');

        return redirect()->to(base_url('kader/jadwalimunisasi'));
    }


    public function jadwalposyandu()
    {
        $posiandu = $this->PosianduModel->orderBy('tanggal_posiandu', 'DESC')->findAll();
        $data = [
            'title' => "Jadwal Posiandu",
            'posiandu' => $posiandu
        ];

        return view('kader/jadwalposyandu', $data);
    }

    public function addposiandu()
    {
        // Get Day data from date
        $oridate = $this->request->getVar('date');
        $timestamp = strtotime($oridate);
        $day = date('D', $timestamp);

        if ($day == "Sun") {
            $day = "Minggu";
        } else if ($day == "Mon") {
            $day = "Senin";
        } else if ($day == "Tue") {
            $day = "Selasa";
        } else if ($day == "Wed") {
            $day = "Rabu";
        } else if ($day == "Thu") {
            $day = "Kamis";
        } else if ($day == "Fri") {
            $day = "Jumat";
        } else if ($day == "Sat") {
            $day = "Sabtu";
        }

        $data = array(
            'tanggal_posiandu' => $this->request->getVar('date'),
            'waktu_mulai' => $this->request->getVar('w_mulai'),
            'waktu_selesai' => $this->request->getVar('w_selesai'),
            'hari' => $day
        );

        $this->PosianduModel->save($data);

        session()->setFlashdata('tambah', 'Berhasil membuat jadwal posiandu');

        return redirect()->to(base_url('kader/jadwalposyandu'));
    }

    public function editposiandu($id)
    {
        // Get Day data from date
        $oridate = $this->request->getVar('date');
        $timestamp = strtotime($oridate);
        $day = date('D', $timestamp);

        if ($day == "Sun") {
            $day = "Minggu";
        } else if ($day == "Mon") {
            $day = "Senin";
        } else if ($day == "Tue") {
            $day = "Selasa";
        } else if ($day == "Wed") {
            $day = "Rabu";
        } else if ($day == "Thu") {
            $day = "Kamis";
        } else if ($day == "Fri") {
            $day = "Jumat";
        } else if ($day == "Sat") {
            $day = "Sabtu";
        }

        $data = array(
            'id' => $id,
            'tanggal_posiandu' => $this->request->getVar('date'),
            'waktu_mulai' => $this->request->getVar('w_mulai'),
            'waktu_selesai' => $this->request->getVar('w_selesai'),
            'hari' => $day
        );

        $this->PosianduModel->save($data);
        return redirect()->to(base_url('kader/jadwalposyandu'));
    }

    public function deleteposiandu($id)
    {
        $this->PosianduModel->delete($id);
        session()->setFlashdata('delete', 'Data Berhasil Dihapus');

        return redirect()->to(base_url('kader/jadwalposyandu'));
    }

    public function pemeriksaan()
    {
        $detail = $this->anakModel->getAllAnak();
        $jadwal = $this->PosianduModel->findAll();
        $data = [
            'title' => "Pemeriksaan",
            'detail' => $detail,
            'jadwal' => $jadwal
        ];
        // dd($data);
        return view('kader/pemeriksaan', $data);
    }

    public function laporan()
    {
        $laporan = $this->PosianduModel->getDataPosyandu();
        $data = [
            'title' => "Laporan",
            'laporan' => $laporan
        ];
        return view('kader/laporan', $data);
    }

    public function detailImunisasi($slug, $imunisasi)
    {
        $detail = $this->anakModel->getAllImunisasiAnak($this->request->getPost('idimunisasi'));
        $data = [
            'id' => $this->request->getPost('idimunisasi'),
            'title' => "Detail imunisasi",
            'imunisasi' => $imunisasi,
            'tanggal' => $slug,
            'detail' => $detail
        ];

        return view('kader/detailimunisasi', $data);
    }

    public function profile()
    {
        $data = [
            'title' => "Profile",
            'data' => $this->userModel->find(session()->get('id')),
        ];
        return view('kader/profile', $data);
    }

    public function edit_profile()
    {
        $data = [
            'title' => "Edit Profile",
            'data' => $this->userModel->find(session()->get('id')),
        ];
        return view('kader/editprofile', $data);
    }

    public function periksaimunisasi()
    {
        $data = array(
            'id' => $this->request->getVar('idpemeriksaan'),
            'is_imunisasi' => 1,
            'vitamin' => $this->request->getVar('vitamin'),
        );
        $this->detailImunisasiModel->save($data);

        session()->setFlashdata('tambah', 'berhasil update pemeriksaan');
        return redirect()->to(base_url('/kader/jadwalimunisasi'));
    }

    public function periksaposiandu()
    {
        $id = $this->request->getPost('id_anak');
        $dataanak = $this->anakModel->find($id);
        $lahir = $dataanak['tanggal_lahir'];
        $interval = date_diff(date_create(), date_create($lahir));
        $umur = "";
        if($interval->y > 0){
            $umur .= $interval->y." Tahun ";
        }
        if($interval->m > 0){
            $umur .= $interval->m." Bulan ";
        }
        $data = array(
            'id_anak' => $id,
            'berat' => $this->request->getPost('berat'),
            'tinggi' => $this->request->getPost('tinggi'),
            'lingkarbadan' => $this->request->getPost('lingkarbadan'),
            'lingkarkepala' => $this->request->getPost('lingkarkepala'),
            'id_posyandu' => $this->request->getPost('tanggal_posiandu'),
            'umur' => $umur
            // 'catatan' => $this->request->getPost('catatan')
        );

        $this->PemeriksaanposyanduModel->save($data);
        
        $data = array(
            'id' => $id,
            'umur' => $umur
            );
        
        $this->anakModel->save($data);
        session()->setFlashdata('tambah', 'berhasil update pemeriksaan');
        return redirect()->to(base_url('/kader/pemeriksaan'));
    }

    public function addanak()
    {
        $data = array(
            'nama_anak' => $this->request->getPost('nama'),
            'tanggal_lahir' => $this->request->getPost('date'),
            'umur' => $this->request->getPost('umur'),
            'id_keluarga' => $this->request->getPost('id_k'),
            'nik' => $this->request->getPost('nik')
        );
        $idanak = $this->anakModel->saveData($data);
        $imunisasi = $this->imunisasiModel->findAll();
        $this->detailImunisasiModel->saveAnak($idanak, $imunisasi);
        session()->setFlashdata('tambah', 'berhasil tambah data anak');

        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function deleteanak($id)
    {
        $this->anakModel->delete($id);
        session()->setFlashdata('hapus', 'Data Berhasil Dihapus');

        return redirect()->to($_SERVER['HTTP_REFERER']);
    }

    public function editanak($id)
    {
        $data = array(
            'id' => $id,
            'nama_anak' => $this->request->getVar('nama'),
            'tanggal_lahir' => $this->request->getVar('date'),
            'umur' => $this->request->getVar('umur'),
            'nik' => $this->request->getVar('nik')
        );
        $this->anakModel->save($data);
        session()->setFlashdata('edit', 'berhasil edit data anak');

        return redirect()->to($_SERVER['HTTP_REFERER']);
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
                'user_phone' => $this->request->getVar('phone'),
                'user_nik' => $this->request->getVar('nik')
            );
        } else {
            $data = array(
                'id' => $id,
                'user_email' => $this->request->getVar('email'),
                'user_name' => $this->request->getVar('username'),
                'user_alamat' => $this->request->getVar('alamat'),
                'user_phone' => $this->request->getVar('phone'),
                'user_nik' => $this->request->getVar('nik')
            );
        }
        $this->userModel->save($data);
        session()->setFlashdata('berhasil', 'Berhasil mengubah profile , untuk melihat perubahan harap logout terlebih dahulu. ');
        return redirect()->to(base_url('kader/edit_Profile'));
    }

    //--------------------------------------------------------------------

}
