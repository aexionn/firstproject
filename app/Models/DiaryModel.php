<?php

namespace App\Models;

use CodeIgniter\Model;
    
class DiaryModel extends Model
{
    protected $table="diary";
    protected $primaryKey = "id_diary";
    protected $allowedFields = ['title', 'content', 'id_user', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes = true;

    public function getKategori($id_diary)
    {
        $builder = $this->db->table('kategori_diary');
        $builder->where('id_diary', $id_diary);
        $builder->join('kategori', 'kategori.id_kategori = kategori_diary.id_kategori');
        return $builder->get()->getResultArray();
    }
}