<?php

namespace App\Controllers;

use App\Models\Accounts;

class HalamanAkunAdmin extends BaseController
{

    private $account;
    public function __construct()
    {
        $this->account = new Accounts();
    }

    public function index()
    {
        if($this->request->getGet("id")) return $this->detailAccount();

        $name = $this->request->getGet("name");
        $status = $this->request->getGet("status");

        if ($status && $name) {
            $accounts = $this->account->getAccountsByNameAndStatus($name, $status);
        } elseif ($status) {
            $accounts = $this->account->getAccountsByStatus($status);
        } elseif ($name) {
            $accounts = $this->account->getAccountsByName($name);
        }else{
        $accounts = $this->account->getAll();
        }
        return view("templates/header.php", ["title" => "Management Akun", "nameFileStyleSheet" => "HalamanAkunAdmin"])
            . view('admin/Akun.php', [
                "accounts" => $accounts,
                "name" => $name,
                "status" => $status,
            ]);
    }

    public function detailAccount(){
        $id = $this->request->getGet("id");
        $account = $this->account->getAccountById($id);
        $personalAccount = $this->account->getPersonalDataById($id);
        return view("templates/header.php", ["title" => "Detail Akun", "nameFileStyleSheet" => "HalamanAkunAdmin"])
            . view('admin/DetailAkun.php', [
                "account" => count($account) > 0? $account[0] : [],
                "personalAccount" => count($personalAccount) > 0 ? $personalAccount[0] : []
            ]);
    }

    public function verifAccount(){
        $id = $this->request->getPost("id");
        $id_user = $this->request->getPost("id_user");
        if(!$id || !$id_user){
            echo "<script>
                alert('id tidak diberikan....');
                location.href='". base_url("admin/management-akun") ."';
            </script>";
            return;
        }

        $result = $this->account->verifAccount( $id, $id_user );
        if($result){
            echo "<script>
                alert('berhasil verifikasi akun');
                location.href='". base_url("admin/management-akun?id=$id_user") ."';
            </script>";
        }else{
             echo "<script>
                alert('telah terjadi kesalahan saat verifikasi verifikasi akun');
                location.href='". base_url("admin/management-akun?id=$id_user") ."';
            </script>";
        }

    }
    public function cancelVerification(){
        $id = $this->request->getPost("id");
        $id_user = $this->request->getPost("id_user");
        if(!$id || !$id_user){
            echo "<script>
                alert('id tidak diberikan....');
                location.href='". base_url("admin/management-akun") ."';
            </script>";
            return;
        }

        $result = $this->account->cancelVerificationAccount( $id, $id_user );
        if($result){
            echo "<script>
                alert('berhasil cancel verifikasi akun');
                location.href='". base_url("admin/management-akun?id=$id_user") ."';
            </script>";
        }else{
             echo "<script>
                alert('telah terjadi kesalahan saat mencancel verifikasi verifikasi akun');
                location.href='". base_url("admin/management-akun?id=$id_user") ."';
            </script>";
        }

    }
    public function updateAccount(){
        
        $id = $this->request->getPost("id");
        $name = $this->request->getPost("name");
        $fullname = $this->request->getPost("fullname");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $role = $this->request->getPost("role");
        $status = $this->request->getPost("status");

        if(!$id || !$name || !$fullname || !$email || !$phone || !$role || !$status){
            echo "<script>
                alert('data yang diberikan tidak lengkapp....');
                location.href='". base_url("admin/management-akun?id=$id") ."';
            </script>";
            return;
        }

        $result = $this->account->updateAccount(
            $id,
            $name,
            $fullname,
            $email,
            $phone,
            $role,
            $status
        );
        if($result){
            echo "<script>
                alert('berhasil update akun - $name');
                location.href='". base_url("admin/management-akun?id=$id") ."';
            </script>";
        }else{
             echo "<script>
                alert('telah terjadi kesalahan saat ingin merubah data akun - $name');
                location.href='". base_url("admin/management-akun?id=$id") ."';
            </script>";
        }
    }

    public function createAccount(){

        $name = $this->request->getPost("name");
        $fullname = $this->request->getPost("fullname");
        $email = $this->request->getPost("email");
        $phone = $this->request->getPost("phone");
        $password = $this->request->getPost("password");
        
        if(!$name || !$fullname || !$email || !$phone){
            echo "<script>
                alert('data yang diberikan tidak lengkapp....');
                location.href='". base_url("admin/management-akun") ."';
            </script>";
            return;
        }

        $result = $this->account->createAccount(
            $name,
            $fullname,
            $email,
            $phone
        );
        if($result){
            echo "<script>
                alert('berhasil membuat akun - $name');
                location.href='". base_url("admin/management-akun") ."';
            </script>";
        }else{
             echo "<script>
                alert('telah terjadi kesalahan saat ingin membuat akun - $name atau akun dengan nama - $name sudah ada..');
                location.href='". base_url("admin/management-akun?") ."';
            </script>";
        }
    }

    public function view(string $page) {}
}
