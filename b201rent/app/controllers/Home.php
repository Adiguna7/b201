<?php
class Home extends Controller{
    public function __construct()
    {   
        session_start();        
        $now = time();        
        if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {            
            session_unset();
            session_destroy();
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
        if($id == null){
            header("Location: " . BASEURL . "home/category");
            exit();
        }
        else{
            $data['itemsingle'] = $this->model('ItemsModel')->getById($id);
            $dataitemcategory = $data['itemsingle']['item_category'];
            $data['relateditems'] = $this->model('ItemsModel')->getFromCategoryLimit($dataitemcategory, 4);
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
                if($data['status']['transaksi_status'] == "done" || $data['status']['transaksi_status'] == null){
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
            $data['endtime'] = $this->model('TransaksiModel')->getTimeEndSingle($data['user']['userId']);
            $datenow = date('Y-m-d');
            $datenowtime = strtotime($datenow);            
            $dateendtime = strtotime($data['endtime']['transaksi_end']);        
            // $datenowtanggal = date('d');                    
            if($datenowtime > $dateendtime){                                
                $different_time = ($datenowtime - $dateendtime)/60/60/24;
                // var_dump($dateendtime);
                $charge = $different_time * $data['history']['item_charge'];
                $data['latecharge'] = "Anda Sudah Melampaui Batas Pengembalian Barang Denda Anda Sebesar " . $charge . " Rupiah.";
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
        // $datenow = date('d');
        $date = strtotime('2020-07-07');
        $tanggal =  strtotime(date('Y-m-d'));
    
        // $datenowtanggal = date('d');
        $differentday = ($tanggal - $date)/60/60/24;
        echo $differentday;     
    }    
}
?>