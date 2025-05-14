<?php



namespace App\Controllers;

use function PHPUnit\Framework\isEmpty;

class Login extends BaseController{

    private $db;
     
    private $data = [
        "failLogin" => false,
        "succesLogin" => false,
        "message_username" => "",
        "message_password" => "",
    ];

    public function index(){
        return view('login',$this->data);
    }

    public function view(){}
    public function login(){
        if(isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']){
            $username = $_POST['username'];
            $password = hash('md5',$_POST["password"]);
            $db = db_connect();
            $result = $db->query("SELECT * FROM users where name='$username' and password='$password'");
            if($result->getNumRows() > 0){
                $this->data["succesLogin"] = true;
                return redirect('/');
            }else{
                $this->data["failLogin"] = true;
            }
        }else {
            $this->data["failLogin"] = true;
            if (!isset($_POST['username'])){
                $this->data['message_username'] = 'masukkan username dan minimal karakter adalah 3';
            }else{
                $this->data['message_password'] = 'masukkan password dan minimal karakter adalah 8';
            }
        }
        return view('login',$this->data);
    //  return;
    }
}