<?php

namespace Source\App;
use League\Plates\Engine;
use Source\Models\User;



class App
{
    private $view;

    public function __construct()
    {

        if(empty($_SESSION["user"]) || empty($_COOKIE["user"])){
            header("location:http://localhost/LoginSimples/entrar");
        }

        setcookie("user", $_SESSION["user"]["email"], time()+60*60, "/");

        $this->view = new Engine(CONF_VIEW_APP,'php');
    }

    public function home () : void
    {
        $user = new User($_SESSION["user"]["id"]);
        echo $this->view->render("home", ["user" => $user]);
        
      
        
    }

    public function logout()
    {
        session_destroy();
        header("location:http://localhost/LoginSimples/entrar");
         
    }

}