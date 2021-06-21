<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_email', 'user_name','user_password','user_alamat','user_phone','user_nik','user_kk','level','is_parent'];

    public function get_data($email, $password)
    {
        return $this->db->table('user')
            ->where(array('user_email' => $email, 'user_password' => $password))
            ->get()->getRowArray();
    }

    //--------------------------------------------------------------------

}
