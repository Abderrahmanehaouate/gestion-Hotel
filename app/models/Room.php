<?php

class Room{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getRooms(){

        $this->db->query("SELECT * FROM rooms ORDER BY id DESC");
        
        return $this->db->resultSet();
    }


    public function getReservation(){

        $this->db->query("SELECT * FROM reservation ORDER BY id DESC");
        
        return $this->db->resultSet();
    }

    public function getUsers(){
        
        $this->db->query("SELECT * FROM users ORDER BY id DESC");
        
        return $this->db->resultSet();
    }

    public function usersReservation(){
        
        $this->db->query("SELECT users.name , users.email , reservation.date_from , reservation.date_to , rooms.type, rooms.genre
        from users
        inner join reservation
        ON users.id = reservation.user_id
        INNER JOIN rooms
        ON rooms.id = reservation.room_id");
        return $this->db->resultSet();
    }

    public function addRoom($data){
        $this->db->query('INSERT INTO rooms (title, type, genre, description, price, image) VALUES (:title, :type, :genre, :description, :price, :image)');

        $this->db->bind(':title',$data['title']);
        $this->db->bind(':type',$data['type']);
        $this->db->bind(':genre',$data['genre']);
        $this->db->bind(':description',$data['description']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':image',$data['image']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateRoom($data){
        $this->db->query('UPDATE rooms SET title = :title , type = :type, genre = :genre, description = :description, price = :price , image=:image WHERE id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':type',$data['type']);
        $this->db->bind(':genre',$data['genre']);
        $this->db->bind(':description',$data['description']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':image',$data['image']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getRoomById($id){
        $this->db->query('SELECT * FROM rooms WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function deleteRoom($id){
        $this->db->query('DELETE FROM rooms WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getAvailableRooms($data){
        $this->db->query("SELECT * FROM rooms
        WHERE type = :type
        AND genre = :genre
        AND id NOT IN (
            SELECT room_id FROM reservation
            WHERE (date_from <= :date_from AND date_to >= :date_from)
            OR (date_from <= :date_to AND date_to >= :date_to)
            OR (date_from >= :date_from AND date_to <= :date_to)
        )");
        $this->db->bind(':date_from',$data['Check-in']);
        $this->db->bind(':date_to',$data['Check-out']);
        $this->db->bind(':type',$data['type']);
        $this->db->bind(':genre',$data['genre']);
        return $this->db->resultSet();
    }

    public function checkReservation($data) {
        $this->db->query('SELECT *
        FROM reservation
        WHERE room_id = :room_id AND (
            (date_from <= :date_from AND date_to >= :date_from)
            OR (date_from <= :date_to AND date_to >= :date_to)
            OR (date_from >= :date_from AND date_to <= :date_to)
        )');
        $this->db->bind(':room_id', $data['room_id']);
        $this->db->bind(':date_from', $data['date_from']);
        $this->db->bind(':date_to', $data['date_to']);
        $this->db->execute();
        return ($this->db->rowCount() > 0) ? false : true;
    }
    

    public function addReservation($data){
        $this->db->query('INSERT INTO reservation (user_id, room_id, date_from, date_to) VALUES (:user_id, :room_id, :date_from, :date_to)');
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':room_id',$data['room_id']);
        $this->db->bind(':date_from',$data['date_from']);
        $this->db->bind(':date_to',$data['date_to']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getLastId(){
        $this->db->query("SELECT id FROM reservation ORDER BY id DESC LIMIT 1");
        return $this->db->resultSet();
    }

    public function addGest($info){
        $this->db->query('INSERT INTO gest (user_id, reservation_id, fullname, birthday) VALUES (:user_id, :reservation_id, :fullname, :birthday)');
        $this->db->bind(':user_id',$info['user_id']);
        $this->db->bind(':reservation_id',$info['reservation_id']);
        $this->db->bind(':fullname',$info['fullname']);
        $this->db->bind(':birthday',$info['birthday']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getReservationUser($id){
        $this->db->query("SELECT *
        FROM reservation
        WHERE user_id = :user_id ");
        $this->db->bind(':user_id' , $_SESSION['user_id']);
        return $this->db->resultSet();
    }

    public function deleteReservation($id){
        $this->db->query('DELETE FROM reservation WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

}