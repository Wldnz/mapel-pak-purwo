<?php

namespace App\Controllers;


use App\Models\Books;
use App\Models\Accounts;
use App\Models\Activitys;

class DashboardAdmin extends BaseController{

    private $db;

    private $data;

    public function __construct() {
        $this->db = db_connect();
    }
    public function index(){
        
        $books = new Books();
        $accounts = new Accounts();
        $acitivitys = new Activitys();

        $this->data = [
        "data" => [
            "Buku" => [
                "Total Buku" => count( $books->getBooks()),
                "Buku Baru" => count($books->getRecentlyBooks()),
                "Buku Dipinjam" => count($books->getBorrowedBooks()),
                "Buku Jatuh Tempo" => count($books->getBorrowedBookDueToday()),
            ],
            "Pegawai & Anggota" => [
                "Total Pegawai" => count($accounts->getAccount('staff')),
            ],
            "Anggota" => [
                "Total Anggota" => count( $accounts->getAccount()),
                "Anggota Terverifikasi" => count( $accounts->getAccountByVerified()),
                "Anggota Belum Terverifikasi" => count($accounts->getAccountByVerified('unverified')),
            ],
            "Aktifitas" => [
                "Total Aktifitas" => count($acitivitys->getActivitys()),
                "Aktifitas Anggota" => count($acitivitys->getActivitysByRole()),
                "Aktifitas Pegawai" => count($acitivitys->getActivitysByRole('staff')),
                "Aktifitas Admin" => count($acitivitys->getActivitysByRole('admin')),
            ],
            "permintaan-peminjaman" => $books->getBorrowedBooksByStatus("wait"),
            "permintaan-verifikasi" => $accounts->getPersonalDataByStatus()
        ]
    ];


        return view('templates/header',["title" => "Dashboard | Admin", "nameFileStyleSheet" => "dashboardAdmin"])
        .view('admin/index.php',$this->data);
    }

    public function view(){

    }


}