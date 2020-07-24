<?php

use Eusonlito\Captcha\Captcha;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class Login extends Controller{    
    public function index($error = null){
        ini_set( 'session.cookie_httponly', 1 );
        session_start();
        if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
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
                case 'successchangepassword':
                    if($_SESSION['checking'] == "successchangepassword"){
                        $data['error'] = "Anda Berhasil Mengubah Password Anda, Silahkan Login";
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
                case 'lockaccount':
                    if($_SESSION['checking'] == "lockaccount"){
                        $data['error'] = "Akun Anda Sedang Dalam Lock Account, Tidak Bisa Diakses Dalam 30 Menit. Konfirmasi Email Untuk Menghapusnya.";
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
        session_start();
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
                                date_default_timezone_set("Asia/Jakarta");
                                $timenow = date("Y-m-d H:i:s");          
                                if($this->model('FailedModel')->getCheckOneUser($data_user['userId'], $timenow)){
                                    $_SESSION['checking'] = "lockaccount";
                                    return header('Location: '. BASEURL . 'login/index/lockaccount');
                                    
                                }
                                else{
                                    session_start();
                                    // var_dump($data_user['userId']);
                                    $this->model('FailedModel')->deletebyId($data_user['userId']);                      
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
                        }
                        else{
                            if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
                                session_destroy();
                            }                            
                            $_SESSION['token'] = bin2hex(random_bytes(32));
                            $_SESSION['checking'] = "wrongpassword";
                            $data['captcha'] = Captcha::source(5, 200, 50);
                            $data['captcha_name'] = Captcha::sessionName();
                            $data['csrf'] = $_SESSION['token'];
                            $data['error'] = "Username Atau Password Salah";

                            // Failed Jobs Control
                            if($this->model('FailedModel')->getOneUser($data_user['userId'])){
                                $data_failed = $this->model('FailedModel')->getOneUser($data_user['userId']);                                                            
                                $attemptnow = $data_failed['attempt']; //store attempt right now
                                // update data
                                if($attemptnow >= 7){
                                    date_default_timezone_set("Asia/Jakarta");
                                    $timenow = date("Y-m-d H:i:s");          
                                    if($this->model('FailedModel')->getCheckOneUser($data_user['userId'], $timenow)){
                                        $data['error'] = "Akun Anda Sedang Dalam Lock Account, Tidak Bisa Diakses Dalam 30 Menit. Konfirmasi Email Untuk Menghapusnya.";
                                    }
                                    else{
                                        $time = strtotime(date('Y-m-d H:i:s'));
                                        $startTime = date("Y-m-d H:i:s");
                                        $endTime = date("Y-m-d H:i:s", strtotime('+30 minutes', $time));
                                        $this->model('FailedModel')->updatebyTime($data_user['userId'], $startTime, $endTime);                                    
                                    }                                                                        
                                }
                                else{
                                    $this->model('FailedModel')->updatebyAttempt($data_user['userId'], $attemptnow + 1);                                                                
                                }                                                                
                            }
                            else{
                                $this->model('FailedModel')->insertbyUserid($data_user['userId']);
                            }                            

                            // var_dump($token);                                                           
                            $data['title'] = "Login";        
                            $this->view('layouts/head', $data);       
                            $this->view('login', $data);
                            return $this->view('layouts/tail');
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
        if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
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

    public function forgotpassword($error = null){
        session_start();
        if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
            session_destroy();
        }
        // if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['captcha'] = Captcha::source(5, 200, 50);
        $data['captcha_name'] = Captcha::sessionName();
        $data['csrf'] = $_SESSION['token'];
        $data['error'] = '';
        // data error control

        if($error != null){
            switch ($error) {
                case 'emailnotfound':
                    if($_SESSION['checking'] == "emailnotfound"){
                        $data['error'] = "Email Tidak Terdaftar";    
                        unset($_SESSION['checking']);
                    }                                                            
                    break;
                case 'failedresetpassword':
                    if($_SESSION['checking'] == "failedresetpassword"){
                        $data['error'] = "Password Gagal Direset Silahkan Mencoba Kembali";    
                        unset($_SESSION['checking']);
                    }                                                            
                    break;
                case 'successemailreset':
                    if($_SESSION['checking'] == "successemailreset"){
                        $data['error'] = "Email Berhasil Dikirim, Silahkan Reset Password Anda Melalui Link yang Kami Kirimkan";    
                        unset($_SESSION['checking']);
                    }                                                            
                    break;                
                default:
                    $data['error'] = '';
                    break;
            }
        }

        $data['title'] = "Forgot Password";
        $this->view('layouts/head', $data);        
        $this->view('forgotpassword', $data);
        return $this->view('layouts/tail');
    }

    public function sendemailforgot(){
        session_start();
        if(isset($_POST['email'])){
            if (!empty($_POST['csrf_token'])) {
                if (hash_equals($_SESSION['token'], $_POST['csrf_token'])) {
                    if($this->model('UsersModel')->getbyUseremail($_POST['email'])){                        
                        $data_user = $this->model('UsersModel')->getbyUseremail($_POST['email']);
                        $remembertoken = $this->generaterandomstring(13);
                        // insert data
                        if(!$this->model('ForgotModel')->selectbyId($data_user['userId'])){
                            $this->model('ForgotModel')->insert($data_user['userId'], $remembertoken);                        
                        }
                        else{
                            $this->model('ForgotModel')->update($data_user['userId'], $remembertoken);
                        }
                        $salt = "`/?;19as\]";
                        $hash = sha1($_POST['email'] . $salt);
                        
                        $mail = new PHPMailer(true);                        
                        $link = BASEURL . "login/resetpassword/" . $hash . "/" . $data_user['userId'] . "/" . $remembertoken;

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
                            $mail->addAddress($_POST['email']);     // Add a recipient                    
                            // $mail->addReplyTo('info@example.com', 'Information');
                            // $mail->addCC('cc@example.com');
                            // $mail->addBCC('bcc@example.com');

                            $mail->isHTML(true);                                  // Set email format to HTML
                            $mail->Subject = 'Reset Password Link';
                            $mail->Body    = "Silahkan akses link ini untuk reset password " . $link;
                            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                            $mail->send();
                                                         
                            $_SESSION['checking'] = "successemailreset";
                            $_SESSION['security'] = "`[/[-`=;/]";                           
                            return header('Location: '. BASEURL . 'login/forgotpassword/successemailreset');

                        } catch (Exception $e) {
                                session_start();
                                $_SESSION['checking'] = "failedresetpassword";
                                header("Location: " . BASEURL . "login/forgotpassword/failedresetpassword");
                                exit();             
                        }
                    }
                    else{
                        $_SESSION['checking'] = "emailnotfound";
                        return header('Location: '. BASEURL . 'login/forgotpassword/emailnotfound');                
                    }
                }
                else{
                    http_response_code(401);
                    die();
                }
            }
            else{
                http_response_code(401);
                die(); 
            }                        
        }
        else{
            http_response_code(401);
            die();        
        }        
    }

    public function resetpassword($hashemail, $id, $remembertoken){
        $data_user_forgot = $this->model('ForgotModel')->selectbyId($id);
        $data_user_users = $this->model('UsersModel')->getbyId($id);
        $salt = "`/?;19as\]";
        $hash = sha1($data_user_users['user_email'] . $salt);
        if(hash_equals($hash, $hashemail) && $data_user_forgot['remember_token'] === $remembertoken){
            session_start();
            if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
                session_destroy();
            }
            // if (empty($_SESSION['token'])) {
            $_SESSION['token'] = bin2hex(random_bytes(32));
            // }
            $data['captcha'] = Captcha::source(5, 200, 50);
            $data['captcha_name'] = Captcha::sessionName();
            $data['csrf'] = $_SESSION['token'];
            $data['error'] = '';
            $data['user_id'] = $data_user_users['userId'];            
                                    
            $data['title'] = "Reset Password";
            $this->view('layouts/head', $data);        
            $this->view('resetpassword', $data);
            return $this->view('layouts/tail');
        }
        else{
            http_response_code(404);
            die(); 
        }        
        
    }

    public function changepassword(){
        session_start();
        if(isset($_POST['newpassword']) && isset($_POST['retypepassword'])){
            if (!empty($_POST['csrf_token'])) {
                $data_user = $this->model('UsersModel')->getbyId($_POST['userid']);                    
                if (hash_equals($_SESSION['token'], $_POST['csrf_token']) && isset($_POST['userid'])) {                                                            
                    $uppercase = preg_match('@[A-Z]@', $_POST['newpassword']);
                    $lowercase = preg_match('@[a-z]@', $_POST['newpassword']);
                    $number    = preg_match('@[0-9]@', $_POST['newpassword']);
                    $specialChars = preg_match('@[^\w]@', $_POST['newpassword']);
                    if($uppercase && $lowercase && $number && $specialChars && strlen($_POST['newpassword']) > 8){
                        if($_POST['newpassword'] === $_POST['retypepassword']){
                            if($this->model('UsersModel')->updatePassword($_POST['userid'], $_POST['newpassword'])){
                                $this->model('ForgotModel')->deletebyId($_POST['userid']);
                                $_SESSION['checking'] = "successchangepassword";
                                return header('Location: '. BASEURL . 'login/index/successchangepassword');
                            }
                            else{
                                http_response_code(500);
                                die();         
                            }
                        }
                        else{
                            if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
                                session_destroy();
                            }
                            // if (empty($_SESSION['token'])) {
                            $_SESSION['token'] = bin2hex(random_bytes(32));
                            // }                            
                            $data['csrf'] = $_SESSION['token'];
                            $data['error'] = 'Retype Password Tidak Sama';
                            $data['user_id'] = $data_user['userId'];            
                                                    
                            $data['title'] = "Reset Password";
                            $this->view('layouts/head', $data);        
                            $this->view('resetpassword', $data);
                            return $this->view('layouts/tail');
                        }   
                    }
                    else{
                        $_SESSION['checking'] = "newpasswordnotstrength";
                        if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
                            session_destroy();
                        }
                        // if (empty($_SESSION['token'])) {
                        $_SESSION['token'] = bin2hex(random_bytes(32));
                        // }                            
                        $data['csrf'] = $_SESSION['token'];
                        if($_SESSION['checking'] == "newpasswordnotstrength"){
                            $data['error'] = "Password Harus Setidaknya 8 Karakter dan paling tidak mengandung 1 huruf kecil, 1 huruf besar, 1 angka dan 1 spesial karakter";
                            $data['user_id'] = $data_user['userId'];
                            unset($_SESSION['checking']);
                        }            
                                                
                        $data['title'] = "Reset Password";
                        $this->view('layouts/head', $data);        
                        $this->view('resetpassword', $data);
                        return $this->view('layouts/tail');
                    }                                                                                       
                }
                else{
                    if(isset($_SESSION['user_name']) && isset($_SESSION['role'])){            
                        session_destroy();
                    }
                    // if (empty($_SESSION['token'])) {
                    $_SESSION['token'] = bin2hex(random_bytes(32));
                    // }                            
                    $data['csrf'] = $_SESSION['token'];
                    $data['error'] = 'CSRF Token Expired, Silahkan Buka Lewat Email Lagi';
                    $data['user_id'] = $data_user['userId'];            
                                            
                    $data['title'] = "Reset Password";
                    $this->view('layouts/head', $data);        
                    $this->view('resetpassword', $data);
                    return $this->view('layouts/tail');         
                }
            }
            else{
                http_response_code(401);
                die(); 
            }
        }
        else{
            http_response_code(401);
            die(); 
        }
    }

    private function generaterandomstring($length) {
        if($length == null){
            http_response_code(401);
            die();
        }
        else{
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }           
    }
}
?>