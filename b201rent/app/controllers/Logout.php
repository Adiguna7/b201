<?php

class Logout extends Controller{    
    public function index()
    {   
        header("Location: ".BASEURL."login");        
        session_destroy();
        exit;   
    }
}

?>