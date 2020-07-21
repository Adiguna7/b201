<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Eusonlito\Captcha\Captcha;

require '../vendor/autoload.php';

class Register extends Controller{

    public function index($error = null){        
        session_start();
        if(isset($_SESSION['user']) && isset($_SESSION['role'])){            
            session_destroy();
        }
        // if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        // }
        $data['error'] = '';

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
                case 'emptycolumn':
                    if($_SESSION['checking'] == "emptycolumn"){
                        $data['error'] = "Isi Semua Kolom Yang Tersedia";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'unknownregister':
                    if($_SESSION['checking'] == "unknownregister"){
                        $data['error'] = "Terdapat Kesalahan Dalam Register, Silahkan Register Ulang";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'usernametaken':
                    if($_SESSION['checking'] == "usernametaken"){
                        $data['error'] = "Username Sudah Digunakan, Silahkan Masukkan Ulang";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'passnotsame':
                    if($_SESSION['checking'] == "passnotsame"){
                        $data['error'] = "Password Tidak Sama";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'wrongemail':
                    if($_SESSION['checking'] == "wrongemail"){
                        $data['error'] = "Email Tidak Sesuai";
                        unset($_SESSION['checking']);
                    }
                    break;
                case 'wrongusername':
                    if($_SESSION['checking'] == "wrongusername"){
                        $data['error'] = "Username Hanya Boleh Terdiri Dari Huruf";
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
        $data['csrf']  = $_SESSION['token'];           
        // var_dump($data['csrf']);                     
        $data['title'] = "Register";
        $this->view('layouts/head', $data);        
        $this->view('register', $data);
        return $this->view('layouts/tail');        
    }
    public function add(){
        session_start();
        // var_dump($_SESSION['token']);        
        if (!empty($_POST['csrf_token'])) {
            if(Captcha::check()){
                if (hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
                    htmlspecialchars($_POST['name']);
                    htmlspecialchars($_POST['email']);
                    htmlspecialchars($_POST['nrp']);
                    htmlspecialchars($_POST['phone']);
                    $name = trim($_POST['name']);         
                    $name = stripslashes($name);
                    $email = trim($_POST['email']);       
                    $email = stripslashes($email); 
                    if (isset($_POST['password']) && isset($_POST['name']) && isset($_POST['nrp']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['passconfirm'])) {            
                        if(!filter_var($name, FILTER_SANITIZE_STRING)){
                            $_SESSION['checking'] = "wrongusername";
                            return header('Location: '. BASEURL . 'register/index/wrongusername');
                        }
                        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                            $_SESSION['checking'] = "wrongemail";
                            return header('Location: '. BASEURL . 'register/index/wrongemail');                
                        }            
                        else if($_POST['password'] != $_POST['passconfirm']){
                            $_SESSION['checking'] = "passnotsame";
                            return header('Location: '. BASEURL . 'register/index/passnotsame');                
                        }
                        else if($this->model('UsersModel')->checkUsername($_POST['name']) > 0){
                            $_SESSION['checking'] = "usernametaken";
                            return header('Location: '. BASEURL . 'register/index/usernametaken');                                                                            
                        }
                        else if(filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($name, FILTER_SANITIZE_STRING)){
                            if($this->model('UsersModel')->addUser($_POST) > 0){
                                $this->sendemail($_POST['email']);                                            
                            }
                            else{
                                $_SESSION['checking'] = "unknownregister";
                                return header('Location: '. BASEURL . 'register/index/unknownregister');                                
                            }
                        }
                    }
                    else{
                        $_SESSION['checking'] = "emptycolumn";
                        return header('Location: '. BASEURL . 'register/index/emptycolumn');
                    }
                }
                else{
                    $_SESSION['checking'] = "wrongcsrf";
                    return header('Location: '. BASEURL . 'register/index/wrongcsrf');
                }
            }
            else{
                $_SESSION['checking'] = "wrongcaptcha";
                return header('Location: '. BASEURL . 'register/index/wrongcaptcha');
            }               
        }
        else{
            $_SESSION['checking'] = "expiredcsrf";
            return header('Location: '. BASEURL . 'register/index/expiredcsrf');
        }        
    }
    
    public function sendemail($user_email){
        $mail = new PHPMailer(true);
        $secret = "35onoi2=-7#%g03kl";
        $email = urlencode($user_email);
        $hash = MD5($user_email.$secret);
        $link = BASEURL . "login/verify/" . $email . "/" . $hash;

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.googlemail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'emailtestuntukbasdat123@gmail.com';                     // SMTP username
            $mail->Password   = '123@gmail';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;

            $mail->setFrom('b201@its.ac.id', 'B201Rent');
            $mail->addAddress($user_email);     // Add a recipient                    
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Verification Link';
            $mail->Body    = "Silahkan akses link ini untuk verifikasi email " . $link;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
                        
            header("Location: " . BASEURL . "login/sendmailsuccess");
            exit();             

        } catch (Exception $e) {
            session_start();
            $_SESSION['checking'] = "failedregister";
            header("Location: " . BASEURL . "login/sendmailfailed/".$user_email);
            exit();             
        }
    }
}
?>