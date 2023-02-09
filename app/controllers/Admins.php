<?php 

class Admins extends Controller {

    public function __construct(){

        $this->roomModel = $this->model('Room');
        $this->adminModel = $this->model('Admin');

    }

    public function dashboard(){

        if(!isLoggedInAdmin()){
            redirect('admins/login');
        }else{
            $rooms = $this->roomModel->getRooms();
            $data = [
                'rooms' => $rooms
            ];
            $this->view('admin/dashboard' ,$data);
        }

    }


            // login controller
            public function login(){
                // check for room
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    // Process form
                    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                    
    
                    // Init data
                    $data =[
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];
                    // Validate Email
                    if(empty($data['email'])){
                    $data['email_err'] = 'Please enter Email';

                    }elseif($this->adminModel->findAdminByEmail($data['email'])){
                        //user found
                    }else{
                        $data['email_err'] = "The email address you entered isn't connected to an account. Create a new account or enter another email correct.";
                    }
    
                    // Validate password
                    if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }
    
    
                // Make sure errors are empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Validated
                    //check and set logged in user 
                    $LoggedInAdmin = $this->adminModel->login($data['email'], $data['password']);
    
                    if($LoggedInAdmin){
                        //create session 
                        $this->createAdminSession($LoggedInAdmin);
    
                    }else {
                        $data['password_err'] = "The password that you've entered is incorrect";
                        $this->view('admin/login', $data);
                    }
    
                } else {
                    // Load view with errors
                    $this->view('admin/login', $data);
                    }
    
    
    
                }else{
                    
                    $data = [
    
                        'email' => '',
                        'password' => '',
                        'email_err' => '',
                        'password_err' => '',
    
                    ];
    
                    //load view
                    $this->view('admin/login',$data);
                }
    
            }


            public function createAdminSession($admin){

                $_SESSION['admin_id'] = $admin->id;
                $_SESSION['admin_email'] = $admin->email;
                $_SESSION['admin_name'] = $admin->name;
                redirect('admins/dashboard'); 
            }
    
    
            public function logout(){
                unset($_SESSION['admin_id']);
                unset($_SESSION['admin_email']);
                unset($_SESSION['admin_name']);
                session_destroy();
                redirect('admins/dashboard');
            }

}