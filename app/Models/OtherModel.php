<?php

namespace App\Models;

use CodeIgniter\Model;
    
class OtherModel extends Model
{
    protected $table="kategori_diary";
    protected $primaryKey = "id_kategori_diary";
    protected $allowedFields = ['id_diary', 'id_kategori'];

    public function setPivotTab($data)
    {
        $this->db->table('kategori_diary')->insert($data);
    }

    // public function insertSoftDel($data)
    // {
    //    $this->db->table('soft_delete')->insert($data);
    // }    
}