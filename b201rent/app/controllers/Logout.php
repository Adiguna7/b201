<?php

class Logout extends Controller{    
    public function index()    
    {   
        session_start();
        if (!empty($_POST['csrf_token'])) {
            if (hash_equals($_SESSION['token'], $_POST['csrf_token'])){
                return header("Location: ".BASEURL."login/index/");        
            }
            else{
                if($_SESSION['role'] === "user"){
                    return header("Location: ".BASEURL."home");        
                }
                else if($_SESSION['role'] === "admin"){
                    return header("Location: ".BASEURL."dashboard");        
                }                
            }
        }
        else{            
            if($_SESSION['role'] === "user"){
                return header("Location: ".BASEURL."home");        
            }
            else if($_SESSION['role'] === "admin"){
                return header("Location: ".BASEURL."dashboard");        
            }                
        }        
    }
}

?>