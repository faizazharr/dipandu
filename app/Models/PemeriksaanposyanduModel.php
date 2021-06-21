<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeriksaanposyanduModel extends Model
{
    protected $table = 'pemeriksaan';
    protected $allowedFields = ['id_anak','berat','tinggi','lingkarbadan','lingkarkepala','umur','id_posyandu'];

    public function getData($id){
        $data = $this->db->table($this->table)->getWhere(['id_anak' => $id])->getResultObject();
        return $data;
    }

    public function getPerkembangan($id)
    {
        $this->join('anak','pemeriksaan.id_anak = anak.id');
        $this->join('posyandu','pemeriksaan.id_posyandu = posyandu.id');
        $this->select('anak.nama_anak,
        pemeriksaan.berat,
        pemeriksaan.tinggi,
        pemeriksaan.lingkarbadan,
        pemeriksaan.lingkarkepala,
        pemeriksaan.id_posyandu,
        posyandu.tanggal_posiandu');
        $this->where('pemeriksaan.id_anak',$id);
        return $this->findall();
    }
}