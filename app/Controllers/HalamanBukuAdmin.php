<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Books;

class HalamanBukuAdmin extends BaseController{
    
    private $data = [
        "title" => "Management Buku",
        "nameFileStyleSheet" => "HalamanBukuAdmin"
    ];

    private $books;
    public function __construct() {
        $this->books = new Books();
        
    }

    public function index(){

        $title = $this->request->getGet("judul");
        $author = $this->request->getGet("author");
        $status = $this->request->getGet("status");

       

        $this->data["authors"] = $this->books->getAllAuthor();
        $this->data["books"] = $this->books->getBooksByFilter($this->_checkData(["title" => $title, "author" => $author, "status" => $status]));

        $this->data["judul"] = $title;
        $this->data["currentAuthor"] = $author;
        $this->data["status"] = $status;

        return view("templates/header",$this->data)
        .view("admin/buku");
    }

    private function _checkData(array $data){
            $result = [];
            foreach ($data as $key => $value) {
                if(!empty($value)){
                    $result[$key] = $value;
                }
            }
            return $result;
        }

}