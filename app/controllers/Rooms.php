<?php

class Rooms extends Controller
{
    public function __construct()
    {
        $this->roomModel = $this->model('Room');
        $this->userModel = $this->model('User');
    }

    public function rooms()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $rooms = $this->roomModel->getRooms();
        $data = [
            'rooms' => $rooms,
        ];
        $this->view('rooms/rooms', $data);
    }

    public function index()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $rooms = $this->roomModel->getRooms();
        $data = [
            'rooms' => $rooms,
        ];
        $this->view('rooms/index', $data);
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['genre'])) {
                $genre = trim($_POST['genre']);
            } else {
                $genre = 'NULL';
            }
            $data = [
                'Check-in' => trim($_POST['Check-in']),
                'Check-out' => trim($_POST['Check-out']),
                'type' => trim($_POST['type']),
                'genre' => $genre,
            ];

            if ($this->roomModel->getAvailableRooms($data)) {
                $rooms = $this->roomModel->getAvailableRooms($data);
                $data = [
                    'rooms' => $rooms,
                ];
                $this->view('rooms/rooms', $data);
            }else{
                flash('room_message', 'NO RESULT , There is no Room Available at this time , Please check with another time or another type or genre of room ' , 'alert alert-warning');
                return redirect('rooms/rooms');            }
        }
    }

    public function reservation($type = NULL, $id = NULL)
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'user_id' => $_SESSION['user_id'],
                'room_id' => $id,
                'date_from' => trim($_POST['from']),
                'date_to' => trim($_POST['to']),
            ];

                if($this->roomModel->checkReservation($data)){

                    if (($type == 'single')) {
                        if($this->roomModel->addReservation($data)){
                            flash('room_message', ' Room is Reserved');
                            return redirect('rooms/rooms');
                        }else{
                            die('something wrong');
                        }

                    }else{
                        $addReservation = $this->roomModel->addReservation($data);
                        if ($addReservation) {

                            if (isset($_POST['fullname'])) {

                                for ($i = 0; $i < count($_POST['fullname']); $i++) {
                                    $lastId = $this->roomModel->getlastId();
                                    
                                    $info = [

                                        'user_id' => $_SESSION['user_id'],
                                        'reservation_id' => $lastId[0]->id,
                                        'fullname' => trim($_POST['fullname'][$i]),
                                        'birthday' => trim($_POST['birthday'][$i]),
                                    ];

                                    $addGest = $this->roomModel->addGest($info);
                                }
                                if ($addGest) {
                                    flash('room_message', 'Room reserved');
                                    return redirect('rooms/rooms');
                                }else{
                                    die('something wrong');
                                }

                            }else{
                                flash('room_message', 'Room reserved');
                                return redirect('rooms/rooms');
                            }
                        }else{
                            die('somthing wrong');
                        }
                    }
                }else{
                    $param = $type;
                    $this->view('rooms/reservation', $param);
                    flash('room_message', 'Room already reserved at this time, use search by time to look rooms that not reserved yet or reserve in another time', 'alert alert-warning');
                    redirect('rooms/reservation');
                }

        } else {
            $data = [
                'date_from' => '',
                'date_to' => '',
            ];
            $info = [
                'fullname' => '',
                'birthday' => '',
            ];
            $this->view('rooms/reservation', $data);
            $this->view('rooms/reservation', $info);
        }
    }
}
