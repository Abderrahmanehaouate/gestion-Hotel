<?php


class Controller {
    public function model($model){
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }


    public function view($views, $data= []){ 
        if(file_exists('../app/views/' . $views . '.php')){
            require_once '../app/views/' . $views . '.php';
        }else {
            die('Views does not exist');
        }
    }
}