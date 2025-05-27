<?php

namespace App\Models;
class Accounts{
    private $db;

    public function __construct(){
        $this->db = db_connect();
    }

    public function getAll(){
        $query = $this->db->query("SELECT id, name, fullname, email, phone, role, status FROM users");
        return $query->getResultArray();
    }
    public function getAccountById(string $id){
        $query = $this->db->query("SELECT id, name, fullname, email, phone, role, status FROM users WHERE id='$id'");
        return $query->getResultArray();
    }
    public function getAccountsByName(string $name){
        $query = $this->db->query("SELECT id, name, fullname, email, phone, role, status FROM users WHERE name LIKE '%$name%' OR fullname LIKE '%$name%'");
        return $query->getResultArray();
    }
    public function getAccounts(string $role="user"){
        $query = $this->db->query("SELECT id, name, fullname, email, phone, role, status FROM users WHERE role='$role'");
        return $query->getResultArray();
    }
    public function getAccountsByStatus(string $status = 'verified'){
        $query = $this->db->query("SELECT id, name, fullname, email, phone, role, status FROM users WHERE status='$status'");
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
    public function getPersonalDataById(string $id){
        $query = $this->db->query("SELECT 
            pa.*, u.name, u.fullname, u.email, u.phone, u.status as user_status, u.role
            FROM personal_account pa
                INNER JOIN users u
                    ON pa.id_user = u.id
                        WHERE pa.id_user='$id';
        ");
        return $query->getResultArray();
    }

    public function getAccountsByNameAndStatus(
        string $name,
        string $status
    ){
        $query = $this->db->query("SELECT id, name, fullname, email, phone, role, status FROM users 
            WHERE name LIKE '%$name%' OR fullname LIKE '%$name%' AND status='$status'");
        return $query->getResultArray();
    }

      public function verifAccount(string $id, string $id_user){
        $query = $this->db->query("UPDATE personal_account SET updated_at='". time() * 1000 ."', status='success' WHERE id='$id'");
        if($query){
              $query = $this->db->query("UPDATE users SET status='verified' WHERE id='$id_user'");
            if( $query ){
                return true;
            }
        }
        return false;
       ;
    }
      public function cancelVerificationAccount(string $id, string $id_user){
        $query = $this->db->query("UPDATE personal_account SET updated_at='". time() * 1000 ."', status='fail' WHERE id='$id'");
        if($query){
              $query = $this->db->query("UPDATE users SET status='unverified' WHERE id='$id_user'");
            if( $query ){
                return true;
            }
        }
        return false;
       ;
    }
      public function updateAccount(
        string $id,
        string $name,
        string $fullname,
        string $email,
        string $phone,
        string $role,
        string $status
      ){
        $query = $this->db->query(" UPDATE users
            SET name='$name', fullname='$fullname', email='$email', phone='$phone', role='$role', status ='$status'
                WHERE id='$id';;
        ");
        if($query){
             return true;
        }
        return false;
       ;
    }
      public function createAccount(
        string $name,
        string $fullname,
        string $email,
        string $phone,
      ){
        $query = $this->db->query("SELECT * FROM users WHERE name='$name'");
        if($query->getNumRows() == 0){
            $query = $this->db->query("INSERT INTO users(name, fullname, email, phone, role, status) VALUES('$name','$fullname','$email','$phone','user','unverified')");
            if($query){
                return true;
            }
        }
        return false;
    }

}