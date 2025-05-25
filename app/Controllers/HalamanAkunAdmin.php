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

    public function view(string $page) {}
}
