<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use DateTime;

class Books
{

  private $db;

  // private currentTimest;

  public function __construct()
  {
    $this->db = db_connect();
    // $this->date = new Datetime();
  }

  public function getBooks(): array
  {
    $buku = [];
    $query = $this->db->query("SELECT * FROM books");


    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }

    return $buku;
  }
  public function getRecentlyBooks(): array
  {
    $buku = [];
    $_14daysAgoTime = time() * 1000 - 60 * 60 * 24 * 14 * 1000;
    $query = $this->db->query("SELECT * FROM books WHERE receiver_date > $_14daysAgoTime");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }

    return $buku;
  }

  public function getBookByTitle(string $title): array
  {
    if (empty($title)) return [];
    $buku = [];
    $query = $this->db->query("SELECT * FROM books WHERE title='$title' OR LIKE '%$title%'");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }

    return $buku;
  }
  public function getBookById(string $id): array
  {
    if (empty($id)) return [];
    $buku = [];
    $query = $this->db->query("SELECT * FROM books WHERE id='$id'");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }

    return $buku;
  }

  public function getBorrowedBooks(): array
  {
    $buku = [];
    $query = $this->db->query("SELECT
    u.name, u.fullname,
    b.title,
    bc.id as id_book_copy, bc.call_number,
    bw.id as id_borrowed, bw.book_condition, bw.borrowed_at, bw.return_condition, bw.return_at,bw.status
 FROM users u
        INNER JOIN borrowed_books bw ON  bw.id_user = u.id 
            INNER JOIN book_copys bc ON bw.id_book_copy = bc.id 
                INNER JOIN books b ON b.id = bc.id_book");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }
    return $buku;
  }
  public function getReadyBooks(): array
  {
    $buku = [];
    $query = $this->db->query("SELECT 
    b.id as id_book, b.title,
    bc.*
    FROM books b INNER JOIN book_copys bc ON bc.id_book = b.id WHERE bc.status = 'available'");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }
    return $buku;
  }

  public function getBorrowedBookById(int $id)
  {
    if (empty($id)) return [];
    $buku = [];
    $query = $this->db->query("SELECT 
          b.*, bw.*, bc.*, u.name, u.fullname, u.email, u.phone, u.role, u.status as user_status,
          bw.status as borrow_status
          FROM borrowed_books as bw 
              INNER JOIN book_copys as bc 
                ON bw.id_book_copy = bc.id
                  INNER JOIN users as u 
                    ON bw.id_user = u.id
                      INNER JOIN books as b 
                        ON bc.id_book = b.id
                          WHERE bw.id='$id';
      ");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray()[0];
    }
    return $buku;
  }
  public function getBookCopysByIdBook(int $id)
  {
    if (empty($id)) return [];
    $result = $this->db->table("book_copys");
    $result->where("id_book", value: $id);
    return $result->get()->getResultArray();
  }
  public function getBookCopyById($id)
  {
    if (empty($id)) return [];
    $result = $this->db->table("book_copys");
    $result->where("id", value: $id);
    return $result->get()->getResultArray()[0];
  }

  public function getBorrowedBookDueToday(): array
  {
    $buku = [];
    $query = $this->db->query("SELECT * from book_copys WHERE due_date < " . time() * 1000);

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }
    return $buku;
  }

  public function getBorrowedBooksByStatus(string $status): array
  {
    $buku = [];
    $query = $this->db->query("SELECT 
          b.*, bw.*, bc.*, u.name, u.fullname, u.email, u.phone, u.role, u.status as user_status,
          bw.id as id_borrowed
          FROM borrowed_books as bw 
              INNER JOIN book_copys as bc 
                ON bw.id_book_copy = bc.id
                  INNER JOIN users as u 
                    ON bw.id_user = u.id
                      INNER JOIN books as b 
                        ON bc.id_book = b.id
                          WHERE bw.status = '$status';
        ");

    if ($query->getNumRows() > 0) {
      $buku = $query->getResultArray();
    }
    return $buku;
  }

  public function getBooksByFilter(array $arrs): array
  {
    $sql = "SELECT * FROM books ";
    if (count($arrs) > 0) {
      $i = 0;
      $count = count($arrs);
      foreach ($arrs as $key => $value) {
        if ($i == 0 && $i === $count - 1) {
          $sql .= "WHERE $key='$value' OR $key LIKE '%$value%'";
        } else if ($i == 0 && $i < $count - 1) {
          $sql .= "WHERE $key='$value' OR $key LIKE '%$value%' AND ";
        } else {
          if ($i > 0 && $i < $count - 1) {
            $sql .= "$key='$value' OR $key LIKE '%$value%' AND ";
          } else {
            $sql .= "$key='$value' OR $key LIKE '%$value%'";
          }
        }
        $i++;
      };
      $sql .= ";";
    }
    $query = $this->db->query($sql);
    return $query->getResultArray();
  }

  public function getAllAuthor()
  {
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
  ) {
    $data = [
      "isbn_10" =>  $isbn_10,
      "isbn_13" =>  $isbn_13,
      "title" =>  $title,
      "description" =>  $description,
      "author" =>  $author,
      "publisher" =>  $publisher,
      "publication_year" =>  $publication_year,
      "edition_number" =>  $edition_number,
      "total_pages" =>  $total_pages,
      "category" =>  $category,
      "language" =>  $language,
      "clsn_id" =>  $classification_number,
      "image_url" =>  $image_url,
      "status" =>  $status,
    ];
    $result = $this->db->table("books");
    $result->insert($data);
    if ($result) {
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
  ) {
    $data = [
      "isbn_10" =>  $isbn_10,
      "isbn_13" =>  $isbn_13,
      "title" =>  $title,
      "description" =>  $description,
      "author" =>  $author,
      "publisher" =>  $publisher,
      "publication_year" =>  $publication_year,
      "edition_number" =>  $edition_number,
      "total_pages" =>  $total_pages,
      "category" =>  $category,
      "language" =>  $language,
      "clsn_id" =>  $classification_number,
      "image_url" =>  $image_url,
      "status" =>  $status,
    ];
    $result = $this->db->table("books");
    $result->where("id", $id);
    $result->update($data);
    if ($result) {
      return true;
    }
    return false;
  }

  public function createBookCopy(
    string  $id_book,
    string  $id_book_copy,
    string  $call_number,
    string  $status,
    string  $physical_condition
  ): bool {

    $data = [
      "id" => $id_book_copy,
      "id_book" => $id_book,
      "loan_date" => null,
      "due_date" => "",
      "call_number" => $call_number,
      "status" => $status,
      "physical_condition" => $physical_condition
    ];

    $result = $this->db->table("book_copys")->insert($data);
    if ($result) {
      return true;
    }
    return false;
  }
  public function updateBookCopy(
    string  $id_book,
    string  $id_book_copy,
    string  $call_number,
    string  $loan_date,
    string  $due_date,
    string  $status,
    string  $physical_condition
  ): bool {
    $data = [
      "id" => $id_book_copy,
      "id_book" => $id_book,
      "loan_date" => (int) strtotime($loan_date) * 1000,
      "due_date" => (int) strtotime($due_date) * 1000,
      "call_number" => $call_number,
      "status" => $status,
      "physical_condition" => $physical_condition
    ];
    $result = $this->db->table("book_copys");
    $result->where("id", $id_book_copy);
    $result->update($data);
    if ($result) {
      return true;
    }
    return false;
  }

  public function createRequestBorrowBook(
    string  $id_user,
    string  $id_book_copy,
    string  $book_condition,
    string  $return_at,
  ): bool {

    $borrowed_at = time() * 1000;
    $return_at = strtotime($return_at) * 1000;
    $data = [
      "id_user" => $id_user,
      "id_book_copy" => $id_book_copy,
      "book_condition" => $book_condition,
      "borrowed_at" => $borrowed_at ,
      "status" => 'wait',
      "return_at" => $return_at,
    ];

    $dataUpdate = [
      "loan_date" => $borrowed_at,
      "due_date" => $return_at,
      "status" => 'borrowed',
    ];

    $result = $this->db->table("borrowed_books")->insert($data);
    if ($result) {
      $this->db->table("book_copys")->where("id",$id_book_copy)->update($dataUpdate);
      return true;
    }
    return false;
  }

  public function acceptRequestBorrowed(string $id){
    if($id){
      $result = $this->db->table("borrowed_books");
      $result->where("id_book_copy",$id);
      $result->update([
        "status" => "borrowed"
      ]);
      if($result){
        $borrowBook = $result->where("id_book_copy",$id)->get()->getResultArray()[0];
         $result2 = $this->db->table("book_copys");
        $result2->where("id",$borrowBook["id_book_copy"]);
        $result2->update([
          "status" => "borrowed",
          "loan_date" => $borrowBook["borrowed_at"],
          "due_date" => $borrowBook["return_at"],
        ]);
        return true;
      }
    } 
    return false;
  }
  public function cancelRequestBorrowed(string $id){
    if($id){
      $result = $this->db->table("borrowed_books");
      $result->where("id_book_copy",$id);
      $result->update([
        "status" => "fail"
      ]);
      if($result){
        $borrowBook = $result->where("id_book_copy",$id)->get()->getResultArray()[0];
        $result2 = $this->db->table("book_copys");
        $result2->where("id",$borrowBook["id_book_copy"]);
        $result2->update([
          "status" => "available",
          "loan_date" => $borrowBook["borrowed_at"],
          "due_date" => $borrowBook["return_at"],
        ]);
        return true;
      }
    } 
    return false;
  }
  public function returnBorrowedBook(string $id){
    if($id){
      $result = $this->db->table("borrowed_books");
      $result->where("id_book_copy",$id);
      $result->update([
        "status" => "returned"
      ]);
      if($result){
        $borrowBook = $result->where("id_book_copy",$id)->get()->getResultArray()[0];
        $result2 = $this->db->table("book_copys");
        $result2->where("id",$borrowBook["id_book_copy"]);
        $result2->update([
          "status" => "available",
          "loan_date" => $borrowBook["borrowed_at"],
          "due_date" => $borrowBook["return_at"],
        ]);
        return true;
      }
    } 
    return false;
  }

}
