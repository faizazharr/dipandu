<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailImunisasiModel extends Model
{
    protected $table = 'detail_imunisasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_anak', 'id_imunisasi' , 'is_imunisasi','vitamin'];

    public function saveImunisasi($id,$anak){
        
        foreach ($anak as $q) {
            $data =[
                'id_anak' => $q['id'],
                'id_imunisasi' => $id,
                'is_imunisasi' => 0];
                $this->insert($data);
        }
    }
    public function saveAnak($id,$imunisasi){
        
        foreach ($imunisasi as $q) {
            $data =[
                'id_anak' => $id,
                'id_imunisasi' => $q['id'],
                'is_imunisasi' => 0];
                $this->insert($data);
        }
    }
    public function getAllImunisasiDetail($id)
    {
        $this->join('imunisasi','detail_imunisasi.id_imunisasi = imunisasi.id');
        $this->select('imunisasi.nama_imunisasi,
        imunisasi.tanggal_imunisasi,
        detail_imunisasi.id_anak,
        detail_imunisasi.id_imunisasi,
        detail_imunisasi.is_imunisasi,
        detail_imunisasi.vitamin');
        $this->where('detail_imunisasi.id_anak',$id);
        return $this->findAll();        
    }
}