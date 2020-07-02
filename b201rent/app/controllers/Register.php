<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Register extends Controller{

    public function index(){
        $data['title'] = "Register";
        $this->view('layouts/head', $data);        
        $this->view('register');
        return $this->view('layouts/tail');        
    }
    public function add(){
        if (isset($_POST['password'])) {
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $data['title'] = "Register";
                $data['error'] = "Email Tidak Sesuai Format";
                $this->view('layouts/head', $data);        
                $this->view('register', $data);
                return $this->view('layouts/tail');                
            }
            else if($_POST['password'] != $_POST['passconfirm']){
                $data['title'] = "Register";
                $data['error'] = "Password yang Anda Masukkan Tidak Sama";
                $this->view('layouts/head', $data);        
                $this->view('register', $data);
                return $this->view('layouts/tail');                
            }
            else if($this->model('UsersModel')->checkUsername($_POST['name']) > 0){
                $data['title'] = "Register";
                $data['error'] = "Username Sudah Terdaftar";
                $this->view('layouts/head', $data);        
                $this->view('register', $data);
                return $this->view('layouts/tail');                
            }
            else{
                if($this->model('UsersModel')->addUser($_POST) > 0){
                    $this->sendemail($_POST['email']);            
                }
                else{
                    $data['error'] = "Terdapat Kesalahan Dalam Register, Silahkan Register Ulang";
                    $data['title'] = "Register";
                    $this->view('layouts/head', $data);
                    $this->view('register', $data);
                    return $this->view('layouts/tail');
                }
            }
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
            header("Location: " . BASEURL . "login/sendmailfailed/".$user_email);
            exit();             
        }
    }
}
?>