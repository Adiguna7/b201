<?php
class Login extends Controller{
    public function index(){
        session_start();        
        if(isset($_SESSION)){            
            session_destroy();
        }                       
        $data['title'] = "Login";
        $this->view('layouts/head', $data);       
        $this->view('login');
        return $this->view('layouts/tail');       
    }
    
    public function verify($email, $hash){
        // echo "pass";
        $secret = "35onoi2=-7#%g03kl";
        $emaildecode = urldecode($email);
        if(md5($emaildecode.$secret) == $hash){
            if($this->model('UsersModel')->updateVerify($emaildecode) > 0){
                $data['title'] = "Login";
                $data['error'] = "Berhasil Verify, Silahkan Login";
                $this->view('layouts/head', $data);        
                $this->view('login', $data);
                return $this->view('layouts/tail');             
            }
            else{
                $data['title'] = "Login";
                $data['error'] = "Anda Telah Terverifikasi, Silahkan Login";
                $this->view('layouts/head', $data);        
                $this->view('login', $data);
                return $this->view('layouts/tail');             
            }
        }
    }

    public function loginaccount(){                             
        $name = $_POST['name'];
        $password = $_POST['password'];        
        if($this->model('UsersModel')->getbyUsername($name)){
            $data_user = $this->model('UsersModel')->getbyUsername($name);             
            if(password_verify($password, $data_user['user_password'])){
                if(!$data_user['is_verify']){
                    $data['title'] = "Login";
                    $data['error'] = "Anda Belum Verifikasi, Silahkan Buka Email";
                    $this->view('layouts/head', $data);        
                    $this->view('login', $data);
                    return $this->view('layouts/tail');              
                }
                else{
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
                $data['title'] = "Login";
                $data['error'] = "Password Salah";
                $this->view('layouts/head', $data);        
                $this->view('login', $data);
                return $this->view('layouts/tail');
            }
        }
        else{
            echo "user tidak terdaftar";
        }                        
    }

    public function sendmailsuccess(){
        $data['title'] = "Login";
        $data['error'] = "Berhasil Register Silahkan Verify Account Lewat Email Kemudian Login";
        $this->view('layouts/head', $data);        
        $this->view('login', $data);
        return $this->view('layouts/tail');
    }

    public function sendmailfailed($user_email){
        $linkresend = "http://localhost:90/register/sendemail/" . $user_email;
        $data['title'] = "Login";
        $data['error'] = "Gagal Verify Akun Silahkan Tekan Disini " . "<a href='" . $linkresend ."'>Resend</a>";
        $this->view('layouts/head', $data);        
        $this->view('login', $data);
        return $this->view('layouts/tail'); 
    }
}
?>