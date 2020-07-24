<?php

class Dashboard extends Controller{
    public function __construct()
    {
        ini_set( 'session.cookie_httponly', 1 );
        session_start();
        if($_SESSION['role'] == NULL){
            header('Location: '.BASEURL.'login');
        }
    }

    public function index(){                
        // var_dump($_SESSION);
        // $admin['name'] = $_SESSION['user_name'];                
        if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){
            return $this->view('dashboard', $_SESSION);            
        }        
        else{
            // var_dump($admin['name']);
            return header('Location: '.BASEURL.'home');
                        
        }                
    }
    
    public function showitem($paramsuccess = NULL){
        session_start();
        $data = [];
        if(isset($paramsuccess) && $paramsuccess != NULL){
            if($paramsuccess == "deletesuccess" && $_SESSION['checking_admin'] == "deletesuccess"){            
                $data['success'] = "Berhasil Delete Data";                                        
            }
            elseif($paramsuccess == "updatesuccess" && $_SESSION['checking_admin'] == "updatesuccess"){
                $data['success'] = "Berhasil Update Data";                                 
            }
            elseif($paramsuccess == "addsuccess" && $_SESSION['checking_admin'] == "addsuccess"){
                $data['success'] = "Berhasil Tambah Data";                                 
            }            
        }
        $data['items'] = $this->model('ItemsModel')->getAll();
        unset($_SESSION['checking_admin']);
        return $this->view('dashboard', $data);
                            
    }

    public function showHistory(){
        $data['history'] = $this->model('TransaksiModel')->getAllHistory();
        return $this->view('dashboard', $data);
    }

    public function additem(){
        if($this->uploadimage($_FILES['itemimage'], $_POST['itemcategory'])){
            $imagename = $this->uploadimage($_FILES['itemimage'], $_POST['itemcategory']);
            if($this->model('ItemsModel')->addOne($_POST, $imagename)){
                session_start();
                $_SESSION['checking_admin'] = "addsuccess";
                header("Location: " . BASEURL . "dashboard/showitem/addsuccess");
            }
            else{
                echo "gagal insert";
            }
        }
        else{
            echo "error upload";
        }
    }

    public function deleteitem(){
        if($this->model('ItemsModel')->deleteOne($_POST['itemid']) > 0){
            $dir = $_SERVER['DOCUMENT_ROOT'] . "/img/items/" . $_POST['itemimage'];
            if(unlink($dir)){
                // echo "sukses hapus gambar";
                // var_dump($_POST['itemimage']);
                $_SESSION['checking_admin'] = "deletesuccess";                
                return header("Location: " . BASEURL . "dashboard/showitem/deletesuccess");
            }        
        }
        else{
            echo "tidak ada yang dihapus";
        }
    }

    public function updateitem(){
        if(isset($_FILES['itemimage']['name']) && $_FILES['itemimage']['name'] != NULL){
            echo ($_FILES['itemimage']);
            $targetdir = $_SERVER['DOCUMENT_ROOT'] . "/img/items/";
            $itemimage = $_FILES['itemimage'];
            $file_ext=strtolower(end(explode('.',$itemimage['name'])));
            $extensions= array("jpeg","jpg","png");
            if(in_array($file_ext, $extensions) && $itemimage['size'] < "200000"){
                $newfilename = $_POST['itemimagename'];
                if(unlink($targetdir . $newfilename)){
                    move_uploaded_file($itemimage["tmp_name"], $targetdir . $newfilename);
                    echo "pass2";                    
                }
                // var_dump($newfilename);                            
                echo "pass";                
            }
            else{
                echo "gagal update upload";
            }
        }
        if($this->model('ItemsModel')->updateOne($_POST)){
            $_SESSION['checking_admin'] = "updatesuccess";
            header("Location: " . BASEURL . "dashboard/showitem/updatesuccess");
            // echo "update sukses";
        }
    }

    public function deletesuccess(){
        $data['success'] = "Berhasil Delete Data";
        return $this->view('dashboard', $data);
    }

    public function uploadimage($imageupload, $itemcategory){
        $targetdir = $_SERVER['DOCUMENT_ROOT'] . "/img/items/";
        $itemimage = $imageupload;
        $endid = $this->model("ItemsModel")->getEndId();
        $idfile = ((int)$endid['item_id']) + 1;
        $file_ext=strtolower(end(explode('.',$itemimage['name'])));
        $extensions= array("jpeg","jpg","png");
        $itemtempname = $_SERVER['DOCUMENT_ROOT'] . "/php" . $itemimage['tmp_name'];

        if(in_array($file_ext, $extensions) && $itemimage['size'] < "200000"){
            $newfilename = $itemcategory . $idfile . '.' . $file_ext;
            move_uploaded_file($itemimage["tmp_name"], $targetdir . $newfilename);
            return $newfilename;
        }
        else{   
            // echo $itemimage["tmp_name"];         
            return NULL;
        }

    }

    public function templocation(){
        echo sys_get_temp_dir();
    }

    public function cekendid(){
        $endid = $this->model("ItemsModel")->getEndId();
        var_dump($endid);
        echo "</br>";
        echo ( $endid["item_id"]);
    }

    public function verifrent(){
        if(isset($_POST['transaksiid'])){            
            if($this->model('TransaksiModel')->updateStatus($_POST['transaksiid'], "rent")){
                header("Location: " . BASEURL . "dashboard/showhistory");
                exit();
            }
            else{
                echo "Gagal Verif Rent";
            }
        }
        else{
            echo "Anda Tidak Seharusnya Disini";
        }

    }

    public function verifdone(){
        if(isset($_POST['transaksiid'])){
            if($this->model('TransaksiModel')->updateStatus($_POST['transaksiid'], "done")){                
                $datatransaksi = $this->model('TransaksiModel')->getbyId($_POST['transaksiid']); 
                $dataitems = $this->model('ItemsModel')->getStockById($datatransaksi['item_id']);
                $newstock = $dataitems['item_stock']+1;
                $this->model('ItemsModel')->updateStockbyId($datatransaksi['item_id'], $newstock);               
                header("Location: " . BASEURL . "dashboard/showhistory");
                exit();
            }
        }
        else{
            echo "Anda Tidak Seharusnya Disini";
        }

    }
}
?>