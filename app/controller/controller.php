<?php 
namespace controller;

use model\Authentication;
use model\Docter;

class Pengguna {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new Authentication($konfig);
    }

    public function buat(){
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $nama = htmlspecialchars($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $jabatan = htmlentities($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : strip_tags($_POST['jabatan']);
        $data = $this->konfig->create($email, $username, $password, $repassword, $nama, $jabatan);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_user']) ? htmlspecialchars($_GET['id_user']) : strip_tags($_GET['id_user']);
        $data = $this->konfig->delete($id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['password']), false);
        $nama = htmlspecialchars($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $jabatan = htmlentities($_POST['jabatan']) ? htmlspecialchars($_POST['jabatan']) : strip_tags($_POST['jabatan']);
        $id = htmlentities($_POST['id_user']) ? htmlspecialchars($_POST['id_user']) : strip_tags($_POST['id_user']);
        $data = $this->konfig->update($email, $username, $password, $repassword, $nama, $jabatan, $id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function SignIn(){
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $data = $this->konfig->Login($userInput,$password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

?>