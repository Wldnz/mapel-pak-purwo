<?php

namespace App\Controllers;

use App\Models\Accounts;

class HalamanProfile extends BaseController
{

    private $account;
    public function __construct()
    {
        $this->account = new Accounts();
    }

    public function index(){
        $id = session()->get("account")["id"];
        $account = $this->account->getAccountById($id);
        $personalAccount = $this->account->getPersonalDataById($id);
        return view("templates/header", ["title" => "Detail Akun", "nameFileStyleSheet" => "HalamanAkunAdmin"])
            . view('admin/Profile', [
                "account" => count($account) > 0? $account[0] : [],
                "personalAccount" => count($personalAccount) > 0 ? $personalAccount[0] : []
            ]);
    }
    public function view(string $page) {}
}
