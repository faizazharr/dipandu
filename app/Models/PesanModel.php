<?php

namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model
{
    protected $table = 'pesan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'pesan' , 'id_pengirim' ,'id_penerima','nama_pengirim' ,'role'];

    public function totalMessage($id)
    {
        $this->selectSum('id_penerima');
        $this->where('id_penerima', $id);
        return $this->findall();
    }
}
