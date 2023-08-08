<?php

namespace App\Models;

use CodeIgniter\Model;
    
class NoteModel extends Model
{
    protected $table="diary";
    protected $allowedFields = ['title', 'content', 'id_kategori', 'id_user'];

    public function getData($id)
    {
        return $this->db->table('diary')
        ->select('*')
        ->from('diary as d')
        ->join("kategori as k", "k.id_kategori = d.id_kategori", "inner")
        ->join("user as u", "u.id_user = d.id_user", "inner")
        ->where('d.id_user', $id)->get();
    }
}