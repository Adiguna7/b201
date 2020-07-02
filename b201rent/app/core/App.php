<?php
class App{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();        
        
        unset($url[0]);        
        $url_controller = ucfirst($url[1]);

        // echo '../app/controllers/'.$url[1].'.php'
        //controller        
        if(file_exists('../app/controllers/'.$url_controller.'.php')){
            $this->controller = $url_controller;            
            unset($url[1]);
        }
        
        require_once '../app/controllers/'. $this->controller . '.php';
        $this->controller = new $this->controller;

        //method
        if(isset($url[2])){
            if(method_exists($this->controller, $url[2])){
                $this->method = $url[2];
                unset($url[2]);
            }
        }        
        
        //params
        if(!empty($url)){
            $this->params = array_values($url);
        }

        //call
        call_user_func_array([$this->controller, $this->method], $this->params);            

    }

    public function parseURL(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url); 
            return $url;
        }
    }
}

?>