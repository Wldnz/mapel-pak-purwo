<?php

namespace App\Models;

class Activitys{
    private $db;

    public function __construct(){
        $this->db = db_connect();
        // $this->date = new Datetime();
    }

    public function getActivitys(){
        $query = $this->db->query("SELECT * FROM action_logs");
        return $query->getResultArray();
    }
    public function getActivitysByRole(string $role='user'){
        $query = $this->db->query("SELECT * FROM action_logs al
            INNER JOIN users  u
            ON al.id_user = u.id AND role='$role';
        ");
        return $query->getResultArray();
    }

}