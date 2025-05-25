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

    public function getBorrowedBooksByStatus(string $status): array{
        $buku = [];
        $query = $this->db->query("SELECT 
          b.*, bw.*, bc.*, u.name, u.fullname, u.email, u.phone, u.role, u.status as user_status
          FROM borrowed_books as bw 
              INNER JOIN book_copys as bc 
                ON bw.id_book_copy = bc.id
                  INNER JOIN users as u 
                    ON bw.id_user = u.id
                      INNER JOIN books as b 
                        ON bc.id_book = b.id
                          WHERE bw.status = '$status';
        ");

       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }
       return $buku;
    }

     public function getBooksByFilter(array $arrs): array{
        $sql = "SELECT * FROM books ";
        if(count($arrs ) > 0){
          $i = 0;
          $count = count($arrs);
          foreach($arrs as $key=>$value){
            if($i == 0 && $i === $count - 1){
               $sql .= "WHERE $key='$value' OR $key LIKE '%$value%'";
            }else if($i == 0 && $i < $count - 1){
               $sql .= "WHERE $key='$value' OR $key LIKE '%$value%' AND ";
            }else{
              if($i > 0 && $i < $count - 1){
                $sql .= "$key='$value' OR $key LIKE '%$value%' AND ";
              }else{
                $sql .= "$key='$value' OR $key LIKE '%$value%'";
              }
            }
            $i ++;
          };
          $sql .= ";";
        }
        $query = $this->db->query($sql);
       return $query->getResultArray(); 
    }

    public function getAllAuthor(){
      $query = $this->db->query("SELECT author FROM books GROUP BY author;");
      return $query->getResultArray();
    }
    
}