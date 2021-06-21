<?php

namespace App\Models;

use CodeIgniter\Model;

class KeluargaModel extends Model
{
    protected $table = 'keluarga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no_kk','bapak','ibu'];

    public function getKeluarga($slug){
        $data = $this->db->table($this->table)->join('user', 'user.id_keluarga = keluarga.id')->getWhere(['keluarga.id' => $slug])->getResult();
        return $data;
    }
}
