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
        $Reservation = $this->roomModel->getReservationUser($_SESSION['user_id']);
        $rooms = $this->roomModel->getRooms();
        $data = [
            'rooms' => $rooms,
            'reservation'=> $Reservation
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

    public function searchRooms()
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

                'Check-in-err' => '',
                'Check-out-err' => '',
            ];

            if ($this->roomModel->getAvailableRooms($data)) {
                $rooms = $this->roomModel->getAvailableRooms($data);
                $Reservation = $this->roomModel->getReservationUser($_SESSION['user_id']);
                $data = [
                    'rooms' => $rooms,
                    'reservation' => $Reservation,
                ];
                $this->view('rooms/rooms', $data);
            } else {
                flash(
                    'room_message',
                    'NO RESULT , There is no Room Available at this time , Please check with another time or another type or genre of room ',
                    'alert alert-danger'
                );
                return redirect('rooms/search');
            }
        }
    }

    public function search()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
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

            if (empty($data['Check-in'])) {
                $data['Check-in-err'] = 'Please enter Check-In date';
            }
            if (empty($data['Check-out'])) {
                $data['Check-out-err'] = 'Please enter Check-OutdDate';
            }
            if (empty($data['Check-out-err']) && empty($data['Check-in-err'])) {
                if ($this->roomModel->getAvailableRooms($data)) {
                    $rooms = $this->roomModel->getAvailableRooms($data);
                    $data = [
                        'Check-in' => trim($_POST['Check-in']),
                        'Check-out' => trim($_POST['Check-out']),
                        'rooms' => $rooms,
                    ];
                    $this->view('rooms/search', $data);
                } else {
                    flash(
                        'room_message',
                        'No result , There is no Room Available at this time , Please check with another time or another type or genre of room ',
                        'alert alert-denger'
                    );
                    return redirect('rooms/search');
                }
            } else {
                $this->view('rooms/search', $data);
            }
        } else {
            $data = [
                'Check-in' => '',
                'Check-out' => '',
            ];
            $this->view('rooms/search', $data);
        }
    }




    public function reservation($type = null, $id = null)
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

                'date_from_err' => '',
                'date_to_err' => '',
            ];

            if (empty($data['date_from'])) {
                $data['date_from_err'] = 'Please enter Check-In date';
            }
            if (empty($data['date_to'])) {
                $data['date_to_err'] = 'Please enter Check-Out date';
            }
            if (empty($data['date_from_err']) && empty($data['date_to_err'])) {
                if ($this->roomModel->checkReservation($data)) {
                    if ($type == 'single') {
                        if ($this->roomModel->addReservation($data)) {
                            flash('room_message', ' Room is Reserved');
                            return redirect('rooms/rooms');
                        } else {
                            die('something wrong');
                        }
                    } else {
                            if (isset($_POST['fullname'])) {
                                for (
                                    $i = 0;
                                    $i < count($_POST['fullname']);
                                    $i++
                                ) {
                                    $lastId = $this->roomModel->getlastId();
                                    $info = [
                                        'user_id' => $_SESSION['user_id'],
                                        'reservation_id' => $lastId[0]->id,
                                        'fullname' => trim(
                                            $_POST['fullname'][$i]
                                        ),
                                        'birthday' => trim(
                                            $_POST['birthday'][$i]
                                        ),

                                        'fullname_err' => '',
                                        'birthday_err' => '',
                                    ];
                                    if (empty($info['fullname'])) {
                                        $info['fullname_err'] =
                                            'Please enter FullName of gest';
                                    }
                                    if (empty($info['birthday'])) {
                                        $data['birthday_err'] =
                                            'Please enter birthday of gest';
                                    }
                                    if (
                                        empty($info['birthday_err']) &&
                                        empty($info['fullname_err'])
                                    ) {
                                        $addReservation = $this->roomModel->addReservation($data);
                                        $addGest = $this->roomModel->addGest($info);
                                    } else {
                                        $this->view('rooms/reservation', $info);
                                    }
                                }
                                if (isset($addGest)) {
                                    flash('room_message', 'Room reserved');
                                    return redirect('rooms/rooms');
                                } else {
                                    die('something wrong');
                                }
                            } else {
                                $addReservation = $this->roomModel->addReservation($data);
                                flash('room_message', 'Room reserved');
                                return redirect('rooms/rooms');
                            }

                    }
                } else {
                    flash(
                        'room_message',
                        'Room already reserved at this time, use search by time to look rooms that not reserved yet or reserve in another time',
                        'alert alert-warning'
                    );
                    redirect('rooms/search');
                }
            } else {
                $this->view('rooms/reservation', $data);
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

    public function deleteReservation($id){
            if (!$this->roomModel->deleteReservation($id)) {
                flash('room_message', 'Your Reservation annuler , Get another reservation' , 'alert alert-danger');
                redirect('rooms/rooms');
            }
    }



    public function contact(){

        $data = [
            'data' => 'hellowrold'
        ];

        $this->view('rooms/contact', $data);
    }


    
    public function about(){
        
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

        $this->view('rooms/about', $data);
    }
}
