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
            $reservation = $this->roomModel->getReservation();
            $users = $this->roomModel->getUsers();
            $usersReservation = $this->roomModel->usersReservation();
            $data = [
                'rooms' => $rooms,
                'reservation' => $reservation,
                'users' => $users,
                'usersReservation' => $usersReservation
            ];
            $this->view('admin/dashboard' ,$data);
        }
    }

    public function reservation(){
        
        if(!isLoggedInAdmin()){
            redirect('admins/login');
        }else{
            $this->view('admin/dashboard' ,$info);
        }
    }

    public function delete($id){
        
        if ($this->roomModel->deleteRoom($id)) {
            
            flash('room_message', 'Room deleted');
            redirect('admins/dashboard');
        }else{
            flash('room_message', 'Room deleted' , 'alert alert-danger');
            redirect('admins/dashboard');   
        }
    }
    
    public function add()
    {
        if(!isLoggedInAdmin()){
            redirect('admins/login');
        }
        if(isset($_POST['genre'])){
            $genre = trim($_POST['genre']) ;
        }else{
            $genre = "NULL";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'genre' => $genre,
                'image' => $this->uploadPhoto(),

                'title_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => '',
            ];

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            if (empty($data['image'])) {
                $data['image_err'] = 'Please enter image';
            }

            if (
                empty($data['title_err']) &&
                empty($data['price_err']) &&
                empty($data['description_err']) &&
                empty($data['image_err'])
            ) {
                if ($this->roomModel->addRoom($data)) {
                    flash('room_message', 'Room Added');
                    redirect('admins/dashboard');    
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('admin/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'price' => '',
                'description' => '',
                'type' => '',
                'genre' => '',
                'image' => '',
            ];
            $this->view('admin/add', $data);
        }
    }


    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(isset($_POST['genre'])){
                $genre = trim($_POST['genre']) ;
            }else{
                $genre = "null";
            }
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'genre' => $genre,
                'image' => $this->uploadPhoto(),

                'title_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => '',
            ];

            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter price';
            }
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter description';
            }
            if (empty($data['image'])) {
                $data['image_err'] = 'Please enter image';
            }

            if (
                empty($data['title_err']) &&
                empty($data['price_err']) &&
                empty($data['description_err']) &&
                empty($data['image_err'])
            ) {

                if ($this->roomModel->updateRoom($data)) {
                    flash('room_message', 'Room Updated' , 'alert alert-primary');
                    redirect('admins/dashboard');    
                } else {
                    die('something went wrong');
                }
            } else {
                $this->view('admin/edit', $data);
            }
        } else {
            $room = $this->roomModel->getRoomById($id);

            $data = [
                'id' => $id,
                'title' => $room->title,
                'price' => $room->price,
                'description' => $room->description,
                'type' => $room->type,
                'genre' => $room->genre,
                'image' => $room->image,
            ];
            $this->view('admin/edit', $data);
        }
    }


    public function uploadPhoto($oldImage = null)
    {
        $dir = '../public/img';
        $time = time();
        $name = str_replace(' ', '-', strtolower($_FILES['image']['name']));
        $type = $_FILES['image']['type'];
        $ext = substr($name, strpos($name, '.'));
        $ext = str_replace('.', '', $ext);
        $name = preg_replace('/\.[^.\s]{3,4}$/', '', $name);
        $imageName = $name . '-' . $time . '.' . $ext;
        if (
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $dir . '/' . $imageName
            )
        ) {
            return $imageName;
        }
        return $oldImage;
    }


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
                    if(empty($data['email'])){
                    $data['email_err'] = 'Please enter Email';

                    }elseif($this->adminModel->findAdminByEmail($data['email'])){
                    }else{
                        $data['email_err'] = "The email address you entered isn't connected to an account. Create a new account or enter another email correct.";
                    }
    
                    if(empty($data['password'])){
                    $data['password_err'] = 'Please enter password';
                }
                if(empty($data['email_err']) && empty($data['password_err'])){
                    $LoggedInAdmin = $this->adminModel->login($data['email'], $data['password']);
    
                    if($LoggedInAdmin){
                        $this->createAdminSession($LoggedInAdmin);
    
                    }else {
                        $data['password_err'] = "The password that you've entered is incorrect";
                        $this->view('admin/login', $data);
                    }
                } else {
                    $this->view('admin/login', $data);
                    }
    
                }else{
                    
                    $data = [
    
                        'email' => '',
                        'password' => '',
                        'email_err' => '',
                        'password_err' => '',
    
                    ];
    
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