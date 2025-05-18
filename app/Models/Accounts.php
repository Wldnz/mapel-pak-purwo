<?php

namespace App\Models;
class Accounts{
    private $db;

    public function __construct(){
        $this->db = db_connect();
    }

    public function getAccount(string $role="user"){
        $query = $this->db->query("SELECT * FROM users WHERE role='$role'");
        return $query->getResultArray();
    }
    public function getAccountByVerified(string $verified = 'verified'){
        $query = $this->db->query("SELECT * FROM users WHERE role='user' AND status='$verified'");
        return $query->getResultArray();
    }

}