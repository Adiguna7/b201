<?php

use Eusonlito\Captcha\Captcha;
require '../vendor/autoload.php';

class Login extends Controller{    
    public function index($error = null){
        ini_set( 'session.cookie_httponly', 1 );
        session_start();
        if(isset($_SESSION['user']) && isset($_SESSION['role'])){            
            session_destroy();
        }
        // if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        // }    

        // error controlling
        if(isset($error)){
            switch ($error) {
                case 'wrongcaptcha':
                    if($_SESSION['checking'] == "wrongcaptcha"){
                        $data['error'] = "Captcha yang Anda Masukkan Salah";
                        unset($_SESSION['checking']);
                    }                    
                    break;
                case 'wrongcsrf':
                    if($_SESSION['checking'] == "wrongcsrf"){
                        $data['error'] = "CSRF Terdeteksi Tidak Benar Silahkan Login Kembali";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'expiredcsrf':
                    if($_SESSION['checking'] == "expiredcsrf"){
                        $data['error'] = "CSRF Terdeteksi Expired Silahkan Login Kembali";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'wrongrecord':
                    if($_SESSION['checking'] == "wrongrecord"){
                        $data['error'] = "User Tidak Terdaftar Dalam Record";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'wrongpassword':
                    if($_SESSION['checking'] == "wrongpassword"){
                        $data['error'] = "Username Atau Password Salah";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'needverify':
                    if($_SESSION['checking'] == "needverify"){
                        $data['error'] = "Email Anda Belum Terverifikasi Silahkan Verifikasi Email Terlebih Dahulu";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'successverify':
                    if($_SESSION['checking'] == "successverify"){
                        $data['error'] = "Berhasil Verify Account, Silahkan Login";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'doneverify':
                    if($_SESSION['checking'] == "doneverify"){
                        $data['error'] = "Anda Telah Terverifikasi, Silahkan Login";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'successregister':
                    if($_SESSION['checking'] == "successregister"){
                        $data['error'] = "Berhasil Register, Silahkan Verifikasi Account Via Email";
                        unset($_SESSION['checking']);
                    }
                    break;                                                    
                default:                                
                    $data['error'] = '';
                break;
            }   
        }
        // end error controlling

        $data['captcha'] = Captcha::source(5, 200, 50);
        $data['captcha_name'] = Captcha::sessionName();
        $data['csrf'] = $_SESSION['token'];        
        // var_dump($token);                               
        $data['title'] = "Login";        
        $this->view('layouts/head', $data);       
        $this->view('login', $data);
        return $this->view('layouts/tail');       
    }
    // Method For Verify Account
    public function verify($email, $hash){
        // echo "pass";
        $secret = "35onoi2=-7#%g03kl";
        $emaildecode = urldecode($email);
        if(md5($emaildecode.$secret) == $hash){
            if($this->model('UsersModel')->updateVerify($emaildecode) > 0){
                $_SESSION['checking'] = "successverify";
                return header('Location: '. BASEURL . 'login/index/successverify');             
            }
            else{
                $_SESSION['checking'] = "doneverify";
                return header('Location: '. BASEURL . 'login/index/doneverify');             
            }
        }
        else{
            http_response_code(404);
            die();
        }
    }

    public function loginaccount(){
        session_start();
        if (!empty($_POST['csrf_token'])) {
            if(Captcha::check()){
                if (hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
                    htmlspecialchars($_POST['name']);                 
                    $name = $_POST['name'];
                    $password = $_POST['password'];                
                    if($this->model('UsersModel')->getbyUsername($name)){
                        $data_user = $this->model('UsersModel')->getbyUsername($name);             
                        if(password_verify($password, $data_user['user_password'])){
                            if(!$data_user['is_verify']){
                                $_SESSION['checking'] = "needverify";
                                return header('Location: '. BASEURL . 'login/index/needverify');              
                            }
                            else{
                                // ini_set( 'session.cookie_httponly', 1 );
                                session_start();                      
                                if($data_user['is_admin']){                                                
                                    $_SESSION['role'] = "admin";
                                    $_SESSION['user_name'] = $data_user['user_name'];                                                                                                                 
                                    header("Location: ".BASEURL."dashboard");
                                    exit;                        
                                }
                                else{
                                    $_SESSION['role'] = "user"; 
                                    $_SESSION['user_name'] = $data_user['user_name'];
                                    header("Location: ".BASEURL."home");
                                    exit;
                                }
                            }
                        }
                        else{
                            $_SESSION['checking'] = "wrongpassword";
                            return header('Location: '. BASEURL . 'login/index/wrongpassword');
                        }
                    }
                    else{
                        $_SESSION['checking'] = "wrongrecord";
                        return header('Location: '. BASEURL . 'login/index/wrongrecord');
                    }                        
                } else {
                    $_SESSION['checking'] = "wrongcsrf";
                    return header('Location: '. BASEURL . 'login/index/expiredcsrf');
                }
            }
            else{
                $_SESSION['checking'] = "wrongcaptcha";
                return header('Location: '. BASEURL . 'login/index/wrongcaptcha');
            }            
        }
        else{
            $_SESSION['checking'] = "expiredcsrf";
            return header('Location: '. BASEURL . 'login/index/expiredcsrf');
        }                            
    }

    public function sendmailsuccess(){                
        session_start();
        $_SESSION['checking'] = "successregister";
        return header('Location: '. BASEURL . 'login/index/successregister');        
    }

    public function sendmailfailed($user_email){
        session_start();
        if(isset($_SESSION['user']) && isset($_SESSION['role'])){            
            session_destroy();
        }
        // if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['captcha'] = Captcha::source(5, 200, 50);
        $data['captcha_name'] = Captcha::sessionName();
        $data['csrf'] = $_SESSION['token'];
        $data['error'] = '';

        $linkresend = "http://localhost:90/register/sendemail/" . $user_email;
        $data['title'] = "Login";
        if($_SESSION['checking'] == "failedregister"){
            $data['error'] = "Gagal Register Akun Silahkan Tekan Disini " . "<a href='" . $linkresend ."'>Resend</a>";
            unset($_SESSION['checking']);
        }        
        $this->view('layouts/head', $data);        
        $this->view('login', $data);
        return $this->view('layouts/tail'); 
    }
}
?>