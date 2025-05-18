<?php

namespace App\Models;

class Books{

    private $db;

    // private currentTimest;

    public function __construct(){
        $this->db = db_connect();
        // $this->date = new Datetime();
    }

    public function getBooks(): array{
        $buku = [];
        $query = $this->db->query("SELECT * FROM books");


       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }

       return $buku; 
    }
    public function getRecentlyBooks(): array{
        $buku = [];
        $_14daysAgoTime = time() * 1000 - 60 * 60 * 24 * 14 * 1000;
        $query = $this->db->query("SELECT * FROM books WHERE receiver_date > $_14daysAgoTime");

       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }

       return $buku; 
    }

     public function getBookByTitle(string $title): array{
      if(empty($title)) return [];
        $buku = [];
        $query = $this->db->query("SELECT * FROM books WHERE title='$title' OR LIKE '%$title%'");

       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }

       return $buku; 
    }

    public function getBorrowedBooks(): array{
        $buku = [];
        $query = $this->db->query("SELECT bw.*, bc.* FROM borrowed_books as bw 
          INNER JOIN book_copys as bc 
            ON bw.id_book_copy = bc.id;
        ");

       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }
       return $buku;
    }

    public function getBorrowedBookById(int $id){
      if(empty($id)) return [];
      $buku = [];
      $query = $this->db->query("SELECT bw.*, bc.* FROM borrowed_books as bw 
        INNER JOIN book_copys as bc 
         ON bw.id_book_copy = bc.id AND bw.id=$id;
      ");

      if($query->getNumRows() > 0){
        $buku = $query->getResultArray();
      }
      return $buku;
    }

    public function getBorrowedBookDueToday(): array{
        $buku = [];
        $query = $this->db->query("SELECT * from book_copys WHERE due_date < ". time() * 1000);

       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }
       return $buku;
    }
    
}