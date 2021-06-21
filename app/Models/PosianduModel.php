<?php

namespace App\Models;

use CodeIgniter\Model;

class PosianduModel extends Model
{
    protected $table = 'posyandu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal_posiandu', 'waktu_mulai','waktu_selesai','hari'];

    public function saveData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function getDataPosyandu()
    {
        $this->join('pemeriksaan','pemeriksaan.id_posyandu = posyandu.id');
        $this->join('anak','pemeriksaan.id_anak = anak.id');
        $this->join('keluarga','anak.id_keluarga = keluarga.id');
        $this->join('user u','u.id_keluarga = keluarga.id AND u.is_parent = 1', 'left');
        $this->join('user u2','u2.id_keluarga = keluarga.id AND u2.is_parent = 2', 'left');
        $this->select('posyandu.tanggal_posiandu,
        pemeriksaan.berat,
        pemeriksaan.tinggi,
        pemeriksaan.lingkarbadan,
        pemeriksaan.lingkarkepala,
        pemeriksaan.umur,
        anak.nama_anak,
        anak.tanggal_lahir,
        u.user_name as ibu,
        u2.user_name as bapak');
        $this->orderBy('posyandu.tanggal_posiandu', 'DESC');
        return $this->findAll();
    }
}