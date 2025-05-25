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
    public function getPersonalDataByStatus(string $status = 'wait'){
        $query = $this->db->query("SELECT 
            pa.*, u.name, u.fullname, u.email, u.phone, u.status as user_status, u.role
            FROM personal_account pa
                INNER JOIN users u
                    ON pa.id_user = u.id
                        WHERE pa.status='$status' AND u.role ='user'
        ");
        return $query->getResultArray();
    }

}