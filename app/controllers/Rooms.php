<?php 

class Rooms extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('admins/login');
            redirect('users/login');
        }
        $this->roomModel = $this->model('Room');
        $this->userModel = $this->model('User');

    }

    public function rooms(){
        // Get Rooms
        $rooms = $this->roomModel->getRooms();
        $data = [
            'rooms' => $rooms
        ];
        $this->view('rooms/rooms' ,$data);
    }
    public function index(){
        // Get Rooms
        $rooms = $this->roomModel->getRooms();
        $data = [
            'rooms' => $rooms
        ];
        $this->view('rooms/index' ,$data);
    }





    public function add(){
        // Get Rooms
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'genre' => trim($_POST['genre']),
                'image' => $this->uploadPhoto(),
                // 'user_id'=> $_SESSION['user_id'],

                'title_err' => '',
                'price_err' => '',
                'description_err' => '',
                'image_err' => '',
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['price'])){
                $data['price_err'] = 'Please enter price';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter description';
            }
            if(empty($data['image'])){
                $data['image_err'] = 'Please enter image';
            }

            if(empty($data['title_err']) && empty($data['price_err']) && empty($data['description_err'])  && empty($data['image_err']) ){

                //Validated 
                if($this->roomModel->addRoom($data)){
                    flash('room_message', 'Room Added');
                    redirect('rooms');

                }else{
                    die('something went wrong');
                }
            }else{
                $this->view('rooms/add', $data);
            }

        }else {

        $data = [

            'title' => '',
            'price' => '',
            'description' => '',
            'type' => '',
            'genre' => '',
            'image' => '',

        ];
        $this->view('rooms/add' ,$data);
    }
    }



    public function edit($id){
        // Get Rooms
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $_POST['id'],
                'title' => trim($_POST['title']),
                'price' => trim($_POST['price']),
                'description' => trim($_POST['description']),
                'type' => trim($_POST['type']),
                'genre' => trim($_POST['genre']),
                // 'image' => trim($_FILES['image']['tmp_name']),
                // 'user_id'=> $_SESSION['user_id'],

                'title_err' => '',
                'price_err' => '',
                'description_err' => '',
                // 'image_err' => '',
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Please enter title';
            }
            if(empty($data['price'])){
                $data['price_err'] = 'Please enter price';
            }
            if(empty($data['description'])){
                $data['description_err'] = 'Please enter description';
            }
            // if(empty($data['image'])){
            //     $data['image_err'] = 'Please enter image';
            // }

            if(empty($data['title_err']) && empty($data['price_err']) && empty($data['description_err']) && empty($data['image_err']) ){

                //Validated 

                if($this->roomModel->updateRoom($data)){
                    flash('room_message', 'Room Updated');
                    redirect('rooms');

                }else{
                    die('something went wrong');
                }
            }else{
                $this->view('rooms/edit', $data);
            }

        }else {
            // Get existing room from model 
            $room = $this->roomModel->getRoomById($id);

        $data = [
            
            'id'=> $id ,
            'title' => $room->title,
            'price' => $room->price,
            'description' => $room->description,
            'type' => $room->type,
            'genre' => $room->genre,
            'image' => $room->image,

        ];
        $this->view('rooms/edit', $data);
    }
    }


public function home(){
    
    $data = [
        'title' => '',
        'price' => '',
        'description' => ''
    ];
    $this->view('rooms/home' ,$data);
}



    public function reservation(){
        // Get Rooms

        $data = [
            'title' => '',
            'price' => '',
            'description' => ''
        ];
        $this->view('rooms/reservation' ,$data);
    }







    public function uploadPhoto($oldImage = null)
    {
        $dir = "../public/img";
        $time = time();
        $name = str_replace(' ', '-', strtolower($_FILES["image"]["name"]));
        $type = $_FILES["image"]["type"];
        $ext = substr($name, strpos($name, '.'));
        $ext = str_replace('.', '', $ext);
        $name = preg_replace("/\.[^.\s]{3,4}$/", "", $name);
        $imageName = $name . '-' . $time . '.' . $ext;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $dir . "/" . $imageName)) {
            return $imageName;
        }
        return $oldImage;
    }
}