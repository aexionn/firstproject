<?php

namespace App\Models;

use CodeIgniter\Model;
    
class UserModel extends Model
{
    protected $table="user";
    protected $primaryKey = "id_user";
    protected $allowedFields = ['email', 'nama', 'password'];

    public function getDataUser($id)
    {
        $session = session();

        return $this->db->table($this->table)
        ->select('*')->from('user as u')->where('u.id_user', $id)->get();
    }
}