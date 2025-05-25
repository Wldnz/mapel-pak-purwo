<?php

namespace App\Controllers;

class HalamanAkunAdmin extends BaseController{

    public function index(){
        return view("templates/header.php",["title" => "Management Akun","nameFileStyleSheet" => "HalamanAkunAdmin"])
        .view('admin/Akun.php');
    }

    public function view(string $page){}

}