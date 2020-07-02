<!-- CONTROLLER -->

<?php

class Home extends Controller{
    public function index(){
        $data['users'] = $this->model('UsersModel')->getAll();        
        return $this->view('home', $data);
    }    
}
?>