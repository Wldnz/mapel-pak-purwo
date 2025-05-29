<?php



namespace App\Controllers;

use App\Models\Accounts;
use App\Models\Books;

use function PHPUnit\Framework\isEmpty;

class Login extends BaseController
{

    private $accounts;
    private $books;
    private $data = [
        "failLogin" => false,
        "succesLogin" => false,
        "error_message" => "Data yang diberikan tidak valid, silahkan coba lagi",
        "message_username" => "",
        "message_password" => "",
        "agree" => false,
        "books" => []
    ];

    public function __construct()
    {
        $this->accounts = new Accounts();
        $this->books = new Books();
        $this->data["books"] = $this->books->getBooks(8);
    }


    public function index()
    {
        $this->isLogin();
        return view('login', $this->data);
    }

    public function register()
    {
        return view('register', $this->data);
    }

    public function view() {}
    public function login()
    {
        if (isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']) {
            $username = $_POST['username'];
            $password =  $_POST['password'];
            $result = $this->accounts->login($username, $password);
            if (count($result) > 0) {
                $this->setSession($result[0]);
                header("Location: " . base_url("admin/dashboard"));
                exit;
            } else {
                $this->data["failLogin"] = true;
            }
        } else {
            $this->data["failLogin"] = true;
            if (!isset($_POST['username'])) {
                $this->data['message_username'] = 'masukkan username dan minimal karakter adalah 3';
            } else {
                $this->data['message_password'] = 'masukkan password dan minimal karakter adalah 8';
            }
        }
        return view('login', $this->data);
        //  return;
    }
    private function setSession(array $data)
    {
        $session = session();
        $session->set("account", $data);
    }
    public function clearSession()
    {
        $session = session();
        $session->destroy();
        header("Location: " . base_url("login"));
        exit();
    }

    private function isLogin()
    {
        $account = session()->get("account");
        if (isset($account)) {
            if ($account["role"] == "user") {
                header("Location: " . base_url("/"));
                exit();
            } else {
                header("Location: " . base_url("admin/dashboard"));
                exit();
            }
        }
    }
}
