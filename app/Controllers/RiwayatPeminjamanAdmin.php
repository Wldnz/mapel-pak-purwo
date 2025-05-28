<?php

namespace App\Controllers;

use App\Models\Accounts;
use App\Models\Books;

class RiwayatPeminjamanAdmin extends BaseController
{

    private $data = [
        "title" => "Management Buku",
        "nameFileStyleSheet" => "HalamanBukuAdmin"
    ];

    private $books;
    private $account;
    public function __construct()
    {
        $this->books = new Books();
        $this->account = new Accounts();
    }

    public function index()
    {
        if ($this->request->getGet("id")) return $this->detail();
        $this->data["bws"] = $this->books->getBorrowedBooks();
        $this->data["books"] = $this->books->getReadyBooks();
        $this->data["userv"] = $this->account->getMembersVerified();
        return view("templates/header", $this->data)
            . view("admin/RiwayatPeminjamanAdmin");
    }
    public function detail()
    {
        $id = $this->request->getGet("id");
        $this->data["peminjaman"] = $this->books->getBorrowedBookById($id);
        $this->data["personal_data"] = $this->account->getPersonalDataById($this->data["peminjaman"]["id_user"])[0];
        return view("templates/header", $this->data)
            . view("admin/DetailPeminjaman");
    }

    public function acceptRequest()
    {
        $id = $this->request->getPost("id_borrowed");
        if(!$id){
             echo "<script>
                alert('pastikan semua kolom sudah terisi');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }

        $result = $this->books->acceptRequestBorrowed(
            $id
        );

        if($result){
             echo "<script>
                alert('berhasil menerima request peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }else{
              echo "<script>
                alert('gagal dalam menerima request peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }
    }
    public function cancelRequest()
    {
        $id = $this->request->getPost("id_borrowed");
        if(!$id){
             echo "<script>
                alert('pastikan semua kolom sudah terisi');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }

        $result = $this->books->cancelRequestBorrowed(
            $id
        );

        if($result){
             echo "<script>
                alert('berhasil dalam menolak request peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }else{
              echo "<script>
                alert('gagal dalam menolak request peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }
    }
    public function returnBook()
    {
        $id = $this->request->getPost("id_borrowed");
        if(!$id){
             echo "<script>
                alert('pastikan semua kolom sudah terisi');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }

        $result = $this->books->returnBorrowedBook(
            $id
        );

        if($result){
             echo "<script>
                alert('berhasil dalam membalikan peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }else{
              echo "<script>
                alert('gagal dalam membalikan peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }
    }

    public function createPeminjaman(){
        $id_user = $this->request->getPost("id_user");
        $id_book_copy = $this->request->getPost("id_book_copy");
        $book_condition = $this->request->getPost("book_condition");
        $return_at = $this->request->getPost("return_at");

        if(!$id_user || !$id_book_copy || !$book_condition || !$return_at){
             echo "<script>
                alert('pastikan semua kolom sudah terisi');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }

        $result = $this->books->createRequestBorrowBook(
            $id_user,
            $id_book_copy,
            $book_condition,
            $return_at
        );

        if($result){
             echo "<script>
                alert('berhasil membuat request peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }else{
              echo "<script>
                alert('gagal dalam membuat request peminjaman buku...');
                location.href='". base_url("admin/management-riwayat-peminjaman") ."';
            </script>";
            return;
        }

    }
    public function view(){}
}
