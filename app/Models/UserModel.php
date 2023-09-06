<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table="user";
    protected $primaryKey = "id_user";
    protected $allowedFields = ['email', 'nama', 'password', 'image', 'created_at', 'password_updated_at'];
}