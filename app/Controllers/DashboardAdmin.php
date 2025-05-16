<?php

namespace App\Controllers;

class DashboardAdmin extends BaseController{

    public function index(){
        return view('templates/header',["title" => "Jangan Makan Bang ini lagi siang"])
        .view('admin/index.php')
        .view('templates/footer');
    }

    public function view(){

    }


}