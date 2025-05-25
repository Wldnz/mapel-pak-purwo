<?php

namespace App\Models;

class ClassificationNumbers{
    private $db;


    public function __construct(){
        $this->db = db_connect();
    }

    public function getAll(){
        $query = $this->db->query("SELECT * FROM classification_numbers");
        return $query->getResultArray();
    }

}