<?php

namespace App\Models;

use CodeIgniter\Model;

class AnakModel extends Model
{
    protected $table = 'anak';
    protected $allowedFields = ['nama_anak', 'tanggal_lahir', 'umur','no_kk','nik','id_keluarga'];

    public function getDetail($no_kk)
    {
        $data = $this->db->table($this->table)->getWhere(['no_kk' => $no_kk])->getResultObject();
        return $data;
    }

    public function getAnak(){
        $kk = session()->get('user_kk');
        $data = $this->db->table($this->table)->getWhere(['no_kk' => $kk])->getResultObject();
        return $data;
    }

    public function getAllAnak()
    {
        $this->join('keluarga', 'anak.id_keluarga = keluarga.id');
        $this->select('anak.id as id');
        $this->select('anak.nama_anak as nama_anak');
        $this->select('anak.umur as umur');
        $this->select('anak.nik as nik');
        $this->select('anak.tanggal_lahir as tanggal_lahir');
        $this->select('anak.id_keluarga as id_keluarga');
        $this->select('keluarga.no_kk as no_kk');
        return $this->findall();
    }
    public function saveData($data)
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function getAllImunisasiAnak($id)
    {
        $this->join('detail_imunisasi', 'detail_imunisasi.id_anak = anak.id');
        $this->join('keluarga', 'anak.id_keluarga = keluarga.id');
        $this->select('anak.nama_anak as nama_anak');
        $this->select('anak.tanggal_lahir as tanggal_lahir');
        $this->select('anak.umur as umur');
        $this->select('anak.nik as nik');
        $this->select('keluarga.no_kk as no_kk');
        $this->select('detail_imunisasi.is_imunisasi as is_imunisasi');
        $this->select('detail_imunisasi.id as id');
        $this->where('detail_imunisasi.id_imunisasi',$id);
       return $this->findAll();
    }
    public function getImunisasiAnak($id)
    {
        $this->join('detail_imunisasi', 'detail_imunisasi.id_anak = anak.id');
        $this->join('imunisasi', 'detail_imunisasi.id_imunisasi = imunisasi.id');
        $this->select('anak.nama_anak,
        anak.tanggal_lahir,
        detail_imunisasi.id_anak,
        imunisasi.nama_imunisasi,
        imunisasi.tanggal_imunisasi,
        detail_imunisasi.id_imunisasi,
        detail_imunisasi.is_imunisasi,
        detail_imunisasi.vitamin');
        $this->where('anak.id_keluarga',$id);
       return $this->findAll();
    }
    
    public function getImunisasiAnakId($id)
    {
        $this->join('detail_imunisasi', 'detail_imunisasi.id_anak = anak.id');
        $this->join('imunisasi', 'detail_imunisasi.id_imunisasi = imunisasi.id');
        $this->select('anak.id as id_anak');
        $this->select('anak.nama_anak as nama_anak');
        $this->select('anak.tanggal_lahir as tanggal_lahir');
        $this->select('anak.umur as umur');
        $this->select('anak.nik as nik');
        $this->select('anak.no_kk as no_kk');
        $this->select('detail_imunisasi.is_imunisasi as is_imunisasi');
        $this->select('detail_imunisasi.vitamin as vitamin');
        $this->select('detail_imunisasi.id as id_imunisasi');
        $this->select('imunisasi.nama_imunisasi as nama_imunisasi');
        $this->select('imunisasi.tanggal_imunisasi as tanggal_imunisasi');
        $this->where('anak.id',$id);
       return $this->findAll();
    }
}