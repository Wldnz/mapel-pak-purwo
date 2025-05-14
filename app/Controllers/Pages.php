<?php

namespace App\Controllers;

class Pages extends BaseController{
    
    private $db;
    
    public function index(){
        $db = \Config\Database::connect();
        $result = $db->query('select * from books');
        $result = $result->getResult();
        echo var_dump($result[0]->author);
        return view('templates/header',["title" => "Jangan Makan Bang ini lagi siang"])
        .view('welcome_message1.php')
        .view('templates/footer');
    }

    public function view(string $page = 'home'){
        
    }

    


}