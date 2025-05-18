<?php

namespace App\Models;

class Activitys{
    private $db;

    public function __construct(){
        $this->db = db_connect();
        // $this->date = new Datetime();
    }

    public function getActivitys(){
        $query = $this->db->query("SELECT * FROM activity_users");
        return $query->getResultArray();
    }
    public function getActivitysByRole(string $role='user'){
        $query = $this->db->query("SELECT * FROM activity_users
            INNER JOIN users 
            ON activity_users.id_user = users.id AND role='$role';
        ");
        return $query->getResultArray();
    }

}