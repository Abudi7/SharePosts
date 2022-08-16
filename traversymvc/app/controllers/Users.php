<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // check for POST Which request method was used to access the page; e.g. 'GET', 'HEAD', 'POST', 'PUT'.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process Form

            // Sanitze POST data i add  a php filter/ filter_input_array()  Gets external variables and optionally filters them
            //FILTER_SANITIZE_STRING i can't use it because in php version 8.1 not supported more they are 2 ways to solve the situation
            // i can use htmlspcialchars(); or other FILTER_SANITIZE_FULL_SPECIAL_CHARS with the method filter_input_array 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //trim — Strip whitespace (or other characters) from the beginning and end of a string
            $data = ['name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            //validat the Email
            if (empty($data['email'])) {
                # if the filder email empty then i display a message email_error 
                $data['email_error'] = 'please enter Email';
            }else{
                //check Email 
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_error'] = 'Email is already taken';
                }
            }
            //validat the Name
            if (empty($data['name'])) {
                # if the filder name empty then i display a message name_error 
                $data['name_error'] = 'please enter Name';
            }
            //validat the Password
            if (empty($data['password'])) {
                # if the filder password empty then i display a message password_error 
                $data['password_error'] = 'please enter Password';
            }

            //validat the Confirm Password
            elseif (strlen($data['password']) < 6) {
                # if the filder confirm password empty then i display a message confirm_password_error 
                $data['password_error'] = ' Password must be at least 6 characters';
            }
            //validat the Confirm Password
            if (empty($data['confirm_password'])) {
                # if the filder confirm password empty then i display a message confirm_password_error 
                $data['confirm_password_error'] = 'please enter Password';
            }
            //check if the password and confirm paswword is the same  
            else {
                if ($data['password'] != $data['confirm_password']) {


                    $data['confirm_password_error'] = 'password do not match ';
                }
            }
            // When I don't get any error by register afterthat it show me message SUCCESS 
            //Make sure errors are empty 
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                # Validated
                //die('Success');

                //password Hash
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT );

                // Register in class User from Model file when the function return true if worked 
               if( $this->userModel->register($data)){
                // call method flash from the helper file sessionHelper.php 
                    flash('register_success','You are registered you can login');
                //function created in helpers file 
               redirect('users/login');

               }else {
                die('somthing went wrong');
               }


            }
            else {
                # load view with errors
                $this->view('users/register', $data);
            }
        }
        else {
            // init data
            $data = ['name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'password_error' => ' ',
                'confirm_password_error' => ''
            ];

            // load view
            $this->view('users/register', $data);
        }
    }
    public function Login()
    {
        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //process Form
            // Sanitze POST data i add  a php filter/ filter_input_array()  Gets external variables and optionally filters them
            //
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            //trim — Strip whitespace (or other characters) from the beginning and end of a string
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => ' ',
            ];
             //validat the Email
             if (empty($data['email'])) {
                # if the filder email empty then i display a message email_error 
                $data['email_error'] = 'please enter Email';
            }
            //validat the Password
            if (empty($data['password'])) {
                # if the filder password empty then i display a message password_error 
                $data['password_error'] = 'please enter Password';
            }
            //Make sure errors are empty 
            if (empty($data['email_error']) && empty($data['password_error'])) {
                # Validated
                die('Success');
            }
            else {
                # load view with errors
                $this->view('users/login', $data);
            }


        }
        else {
            // init data
            $data = ['email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => ' '

            ];

            // load view
            $this->view('users/login', $data);
        }
    }
}
?>