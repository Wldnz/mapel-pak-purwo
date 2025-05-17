<?php

namespace App\Controllers;

class DashboardAdmin extends BaseController{

    public function index(){
        return view('templates/header',["title" => "Dashboard | Admin", "nameFileStyleSheet" => "dashboardAdmin"])
        .view('admin/index.php');
    }

    public function view(){

    }


}