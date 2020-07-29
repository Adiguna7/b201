<?php

// use Carbon\Carbon;

// require '../vendor/autoload.php';
class Home extends Controller{
    public function __construct()
    {   ini_set( 'session.cookie_httponly', 1 );
        session_start();        
        $now = time();        
        if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {            
            session_unset();
            session_destroy();
            ini_set( 'session.cookie_httponly', 1 );
            session_start();            
        }
        $_SESSION['discard_after'] = $now + 600;        
    }    
    public function index(){                 
        if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
            $data['role'] = $_SESSION['role'];
            $data['user_name'] = $_SESSION['user_name'];
            $data['title'] = "Welcome";
            $this->view('user/homehead', $data);        
            $this->view('home', $data);
            return $this->view('user/hometail');
        }
        elseif(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){            
            header("Location: ". BASEURL . "dashboard");
        }
        else{
            $data['title'] = "Welcome";
            $this->view('user/homehead', $data);        
            $this->view('home', $data);
            return $this->view('user/hometail');
        }               
    }

    public function contact(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
            $data['role'] = $_SESSION['role'];
            $data['user_name'] = $_SESSION['user_name'];
            $data['title'] = "Contact";
            $this->view('user/homehead', $data);        
            $this->view('contact', $data);
            return $this->view('user/hometail');
        }
        else{
            $data['title'] = "Contact";
            $this->view('user/homehead', $data);        
            $this->view('contact', $data);
            return $this->view('user/hometail');
        }                
    }
    
    public function getdataitem($category = "all"){
        if($category == "all"){            
            $data = $this->model('ItemsModel')->getAll();                        
            echo json_encode($data);                     
        }
        else{
            $data = $data = $this->model('ItemsModel')->getFromCategory($category);
            echo json_encode($data);                                             
        }
    }

    public function category($category = null){        
        $data = $this->model('ItemsModel')->getCount($category);
        if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
            $data['role'] = $_SESSION['role'];
            $data['user_name'] = $_SESSION['user_name'];
        }
        if($category == null){
            $data['judul'] = "All Category";
            $data['items'] = $this->model('ItemsModel')->getAll();
            // var_dump($data['jumlah']);
            $data['title'] = "Category";
            $this->view('user/homehead', $data);        
            $this->view('category', $data);
            return $this->view('user/hometail');
        }
        else{        
            $data['title'] = "Category";
            $data['judul'] = $category;
            $data['items'] = $this->model('ItemsModel')->getFromCategory($category);            
            $this->view('user/homehead', $data);        
            $this->view('category', $data);
            return $this->view('user/hometail');
        }        
    }

    public function itemdetail($id = null){
        // $data = "";        
        if($id == null || $this->model('ItemsModel')->getById($id) == NULL){
            header("Location: " . BASEURL . "home/category");
            exit();
        }
        else{
            $data['itemsingle'] = $this->model('ItemsModel')->getById($id);
            $dataitemcategory = $data['itemsingle']['item_category'];
            $data['relateditems'] = $this->model('ItemsModel')->getFromCategoryLimit($dataitemcategory, $id);
            // var_dump($data['relateditem']);
            if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
                $data['role'] = $_SESSION['role'];
                $data['user_name'] = $_SESSION['user_name'];
            }
            $data['title'] = "Itemdetail";            
            $this->view('user/homehead', $data);
            $this->view('itemdetail', $data);
            return $this->view('user/hometail');
        }        
    }

    public function cart($itemid = null){                
        if($itemid == null){
            header("Location: " . BASEURL . "home/category");
            exit();
        }
        else{            
            if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
                $data['role'] = $_SESSION['role'];
                $data['user_name'] = $_SESSION['user_name'];
                $data['user'] = $this->model('UsersModel')->getbyUsername($_SESSION['user_name']);
                $data['userid'] = $data['user']['userId'];
                $data['item'] = $this->model('ItemsModel')->getById($itemid);
                $data['status'] = $this->model('TransaksiModel')->getStatus($data['userid']);
                // var_dump($data['status']);
                if(!$data['status']){
                    $_SESSION['status'] = "pass";                    
                }
                $data['sessionstatus'] = $_SESSION['status'];
                // var_dump($data['sessionstatus']);
                $data['title'] = "Cart";
                $this->view('user/homehead', $data);
                $this->view('cart', $data);
                return $this->view('user/hometail');
            }
            else{
                header("Location: " . BASEURL . "home/category");
                exit();                        
            }
        }
    }

    public function rentprocess(){
        if(isset($_POST['itemid']) && isset($_POST['userid']) && $_SESSION['status'] == "pass" && $_SESSION['role'] == "user" && isset($_SESSION['user_name'])){
            $data['item'] = $this->model('ItemsModel')->getById($_POST['itemid']);
            $maxrent = $data['item']['item_maxrent'];
            if($this->model('TransaksiModel')->addData($_POST['userid'], $_POST['itemid'], $maxrent)){
                $itemstock = $this->model('ItemsModel')->getStockById($_POST['itemid']);
                if($itemstock['item_stock'] == 1){
                    $newstock = $itemstock['item_stock']-1;
                    $this->model('ItemsModel')->updateStockbyId($_POST['itemid'], $newstock);
                    // $this->model('ItemsModel')->deleteOne($_POST['itemid']);
                }
                else{
                    $newstock = $itemstock['item_stock']-1;
                    $this->model('ItemsModel')->updateStockbyId($_POST['itemid'], $newstock);
                }                             
                unset($_SESSION['status']);
                header("Location: " . BASEURL . "Home/history");
                exit();
            }
            else{
                echo "gagal";                
            }                        
        }
        else{            
            echo "anda tidak seharusnya disini";
        }
    }

    public function history(){
        if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){            
            $data['role'] = $_SESSION['role'];
            $data['user_name'] = $_SESSION['user_name'];
            $data['user'] = $this->model('UsersModel')->getByUsername($data['user_name']);
            $data['history'] = $this->model('TransaksiModel')->getByUseridHistory($data['user']['userId']);            
            $data['endcharge'] = $this->model('TransaksiModel')->getTimeEndSingle($data['user']['userId']);
            $datenow = date('Y-m-d');
            $datenowtime = strtotime($datenow);            
            $dateendtime = strtotime($data['endcharge']['transaksi_end']);        
            // $datenowtanggal = date('d');
            // var_dump($data['endcharge']);
            $data['latecharge'] = '';
            if($data['endcharge']){
                if($datenowtime > $dateendtime){                                
                    $different_time = ($datenowtime - $dateendtime)/60/60/24;
                    // var_dump($different_time);
                    $charge = $different_time * $data['endcharge']['item_charge'];
                    $itemlatename = $data['endcharge']['item_name'];
                    // var_dump($data['endcharge']['item_charge']);                                        
                    if($itemlatename != NULL && $charge != NULL){                    
                        $data['latecharge'] = "Anda Sudah Melampaui Batas Peminjaman Dengan Nama '". $itemlatename ."' Denda Anda Sebesar " . $charge . " Rupiah.";
                    }
                }
            }                                
            // var_dump($data['history']);            
            $data['title'] = "History";
            $this->view('user/homehead', $data);
            $this->view('history', $data);
            return $this->view('user/hometail');
        }        
        else{
            header("Location: " . BASEURL . "home/category");
            exit();                        
        }
    }

    public function test(){        
        echo hex2bin("e306561559aa787d00bc6f70bbdfe3404cf03659e744f8534c00ffb659c4c8740cc942feb2da115a3f415dcbb8607497386656d7d1f34a42059d78f5a8dd1ef");     
    }    
}
?>