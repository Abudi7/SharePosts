<?php
/**
 * Base Controller 
 * Loads the models and views
 */
class Controller
{
    // i put a paramter to model method because if i want to loaded post controller and we could pass to post.
    public function model($model)
    {
        //Requier Models file from models
        require_once '../app/models/' . $model . '.php';

        //instatiate from model class 
        return new $model();
    }
    //load view method
    //
    public function view($view, $data = [])
    {
        // check for a view file 
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        }
        else {
            // view dose not exist
            die('view dose not exist');
        }
    }

}
?>