<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Books;
use App\Models\ClassificationNumbers;

class HalamanBukuAdmin extends BaseController{
    
    private $data = [
        "title" => "Management Buku",
        "nameFileStyleSheet" => "HalamanBukuAdmin"
    ];


    public function __construct() {
        $books = new Books();
        $classification_numbers = new ClassificationNumbers();
        
       $this->data["books"] = $books->getBooks();  
       $this->data["classification_numbers"] = $classification_numbers->getAll();
       $this->data["authors"] = $books->getAllAuthor();
    }

    public function index(){

        $this->data["currentClassification_numbers"] = $this->request->getGet("classification-number") || 0;
       $this->data["currentAuthor"] = $this->request->getGet("author") || 0;

        return view("templates/header",$this->data)
        .view("admin/buku");
    }

    private function getParams(){
        
        $expectedParams = ["classificitation-number","author","judul"];
    }

}