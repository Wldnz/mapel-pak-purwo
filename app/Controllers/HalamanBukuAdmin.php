<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HalamanBukuAdmin extends BaseController{
    public function index(){
        return view("templates/header",["title" => "Management Buku","nameFileStyleSheet" => "HalamanBukuAdmin"])
        .view("admin/buku");
    }

}