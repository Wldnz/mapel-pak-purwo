<?php

namespace App\Controllers;

class Pages extends BaseController{
    public function index(){
        return view('templates/header',["title" => "Jangan Makan Bang ini lagi siang"])
        .view('welcome_message1.php')
        .view('templates/footer');
    }

    public function view(string $page = 'home'){
        
    }

}