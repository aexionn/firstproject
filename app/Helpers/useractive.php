<?php

function userData()
{
    $this->db = \Config\Database::connect();
    return $db->table('user')->where('id_user', session('id'))->get()->getRow();

}
?>