<?php

class Dashboard extends Controller{
    public function __construct()
    {
        session_start();
    }

    public function index(){        
        // echo "pass";
        // $admin['name'] = $_SESSION['user_name'];                
        if($_SESSION['role'] != "admin"){
            header('Location: '.BASEURL.'login');
            exit;
        }
        else{
            // var_dump($admin['name']);
            return $this->view('dashboard', $_SESSION);
        }                
    }
    
    public function showitem($deletesuccess = NULL){
        if(isset($deletesuccess) && $deletesuccess != NULL){
            $data['success'] = "Berhasil Delete Data";
            $data['items'] = $this->model('ItemsModel')->getAll();
            return $this->view('dashboard', $data);    
        }
        $data['items'] = $this->model('ItemsModel')->getAll();
            return $this->view('dashboard', $data);                    
    }

    public function additem(){
        
    }

    public function deleteitem(){
        if($this->model('ItemsModel')->deleteOne($_POST['itemid']) > 0){
            header("Location: " . BASEURL . "dashboard/showitem/deletesuccess");
        }
        else{
            echo "salah";
        }
    }

    public function updateitem(){
        
    }

    public function deletesuccess(){
        $data['success'] = "Berhasil Delete Data";
        return $this->view('dashboard', $data);
    }



}
?>