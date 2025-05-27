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
     public function getBookById(string $id): array{
      if(empty($id)) return [];
        $buku = [];
        $query = $this->db->query("SELECT * FROM books WHERE id='$id'");

       if($query->getNumRows() > 0){
         $buku = $query->getResultArray();
       }

       return $buku; 
    }

    public function getBorrowedBooks(): array{
        $buku = [];
        $query = $this->db->query("SELECT bw.*, bc.* FROM borrowed_books as bw 
          INNER JOIN book_copys as bc 
            ON bw.id_book_copy = bc.id 
            WHERE bw.status = 'borrowed' OR bc.status='borrowed';
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
  
  public function insertBook(
    string $isbn_10,
    string $isbn_13,
    string $title,
    string $description,
    string $author,
    string $publisher,
    string $publication_year,
    string $edition_number,
    string $total_pages,
    string $category,
    string $language,
    string $classification_number,
    string $image_url,
    string $status,
  ){
    $result = $this->db->query("INSERT INTO books VALUES(NULL, '$isbn_10', '$isbn_13', '$title', '$description', '$author', '$publisher', '$publication_year', '$edition_number', '$total_pages', '$category', '$language', '". time() ."', '$classification_number', '$image_url', '$status')");
    if($result){
      return true;
    }
    return false;
  }
  public function updateBook(
    string $id,
    string $isbn_10,
    string $isbn_13,
    string $title,
    string $description,
    string $author,
    string $publisher,
    string $publication_year,
    string $edition_number,
    string $total_pages,
    string $category,
    string $language,
    string $classification_number,
    string $image_url,
    string $status,
  ){
    $result = $this->db->query("UPDATE books 
    SET isbn_10='$isbn_10', isbn_13='$isbn_13', 
      title='$title', description='$description', author='$author', 
        publisher='$publisher', publication_year='$publication_year', edition_number='$edition_number',
          total_pages='$total_pages', category='$category', language='$language', clsn_id='$classification_number',
            image_url='$image_url', status='$status'
              WHERE id='$id';
    ");
    if($result){
      return true;
    }
    return false;
  }

}