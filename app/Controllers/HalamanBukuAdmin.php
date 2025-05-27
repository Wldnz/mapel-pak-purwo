<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Books;
use App\Models\ClassificationNumbers;
use App\Models\UploudImage;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Cloudinary;

class HalamanBukuAdmin extends BaseController
{

    private $data = [
        "title" => "Management Buku",
        "nameFileStyleSheet" => "HalamanBukuAdmin"
    ];

    private $books;
    private $uploudImage;
    private $clsns;
    public function __construct()
    {
        $this->books = new Books();
        $this->uploudImage = new UploudImage();
        $this->clsns = new ClassificationNumbers();
    }

    public function index()
    {
        if ($this->request->getGet("id")) return $this->detailBookPage();

        $title = $this->request->getGet("judul");
        $author = $this->request->getGet("author");
        $status = $this->request->getGet("status");



        $this->data["authors"] = $this->books->getAllAuthor();
        $this->data["books"] = $this->books->getBooksByFilter($this->_checkData(["title" => $title, "author" => $author, "status" => $status]));

        $this->data["judul"] = $title;
        $this->data["currentAuthor"] = $author;
        $this->data["status"] = $status;

        return view("templates/header", $this->data)
            . view("admin/buku");
    }
    public function addBookPage()
    {
        if ($this->request->getMethod() === "GET") {

            $isbn_10 = $this->request->getGet("isbn_10");
            $isbn_13 = $this->request->getGet("isbn_13");
            $judul = $this->request->getGet("title");
            $author = $this->request->getGet("author");
            $description = $this->request->getGet("description");
            $publisher = $this->request->getGet("publisher");
            $publication_year = $this->request->getGet("publication_year");
            $edition_number = $this->request->getGet("edition_number");
            $category = $this->request->getGet("category");
            $total_pages = $this->request->getGet("total_pages");
            $language = $this->request->getGet("language");
            $classification_number = $this->request->getGet("classification_number");
            $status = $this->request->getGet("status");


            return view("templates/header", $this->data)
                . view("admin/Addbuku", [
                    "judul" => $judul,
                    "isbn_10" => $isbn_10,
                    "isbn_13" => $isbn_13,
                    "description" => $description,
                    "author" => $author,
                    "publisher" => $publisher,
                    "publication_year" => $publication_year,
                    "edition_number" => $edition_number,
                    "category" => $category,
                    "total_pages" => $total_pages,
                    "language" => $language,
                    "classification_number" => $classification_number,
                    "status" => $status,
                    "clsns" => $this->clsns->getAll(),
                ]);
        } else {
            $response = [
                "message" => "Gagal dalam menambahkan data buku",
                "isSuccess" => false,
            ];
            $isbn_10 = $this->request->getPost("isbn_10");
            $isbn_13 = $this->request->getPost("isbn_13");
            $judul = $this->request->getPost("title");
            $author = $this->request->getPost("author");
            $description = $this->request->getPost("description");
            $publisher = $this->request->getPost("publisher");
            $publication_year = $this->request->getPost("publication_year");
            $edition_number = $this->request->getPost("edition_number");
            $category = $this->request->getPost("category");
            $total_pages = $this->request->getPost("total_pages");
            $language = $this->request->getPost("language");
            $classification_number = $this->request->getPost("classification_number");
            $status = $this->request->getPost("status");
            $image = $this->request->getFile("image");

            if ($image->isValid() && !$image->hasMoved()) {
                $result = $this->uploudImage->uploud($image);

                $url = isset($result["secure_url"]) && $result["secure_url"] ? $result["secure_url"] : null;
                if ($url) {
                    $rslt = $this->books->insertBook(
                        $isbn_10,
                        $isbn_13,
                        $judul,
                        $description,
                        $author,
                        $publisher,
                        $publication_year,
                        $edition_number,
                        $total_pages,
                        $category,
                        $language,
                        $classification_number,
                        $url,
                        $status
                    );
                    if ($rslt) {
                        $response = [
                            "message" => "berhasil menambahkan data buku...",
                            "isSuccess" => true,
                        ];
                    }
                }
            }
            return $this->response->setJSON($response);
        }
    }

    public function detailBookPage()
    {
        $id = $this->request->getGet("id");
        return view("templates/header", $this->data)
            . view("admin/DetailBuku", ["data" => $this->data["data"] = $this->books->getBookById($id)[0], "clsns" => $this->clsns->getAll()]);
    }

    public function updateBook()
    {
        $response = [
            "message" => "Gagal dalam menambahkan data buku",
            "isSuccess" => false,
        ];
        $id = $this->request->getGet("id");
        $isbn_10 = $this->request->getPost("isbn_10");
        $isbn_13 = $this->request->getPost("isbn_13");
        $judul = $this->request->getPost("title");
        $author = $this->request->getPost("author");
        $description = $this->request->getPost("description");
        $publisher = $this->request->getPost("publisher");
        $publication_year = $this->request->getPost("publication_year");
        $edition_number = $this->request->getPost("edition_number");
        $category = $this->request->getPost("category");
        $total_pages = $this->request->getPost("total_pages");
        $language = $this->request->getPost("language");
        $classification_number = $this->request->getPost("classification_number");
        $status = $this->request->getPost("status");
        $image_url = $this->request->getPost("image_url");
        if ($image_url) {
            $result = $this->books->updateBook(
                $id,
                $isbn_10,
                $isbn_13,
                $judul,
                $description,
                $author,
                $publisher,
                $publication_year,
                $edition_number,
                $total_pages,
                $category,
                $language,
                $classification_number,
                $image_url,
                $status
            );
            if ($result) {
                echo "<script>
                alert('berhasil update buku - $judul');
                location.href='" . base_url("admin/management-buku?id=$id") . "';
            </script>";
            } else {
                echo "<script>
                alert('telah terjadi kesalahan saat ingin merubah data buku - $judul');
                location.href='" . base_url("admin/management-buku?id=$id") . "';
            </script>";
            }
        } else {
            $image = $this->request->getFile("image");
            if ($image->isValid() && !$image->hasMoved()) {
                $result = $this->uploudImage->uploud($image);

                $url = isset($result["secure_url"]) && $result["secure_url"] ? $result["secure_url"] : null;
                if ($url) {
                    $rslt = $this->books->updateBook(
                        $id,
                        $isbn_10,
                        $isbn_13,
                        $judul,
                        $description,
                        $author,
                        $publisher,
                        $publication_year,
                        $edition_number,
                        $total_pages,
                        $category,
                        $language,
                        $classification_number,
                        $url,
                        $status
                    );
                    if ($rslt) {
                        $response = [
                            "message" => "berhasil merubah data buku...",
                            "isSuccess" => true,
                        ];
                    }
                }
                return $this->response->setJSON($response);
            }
        }
    }

    private function _checkData(array $data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            if (!empty($value)) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}
