<?php

class Room{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getRooms(){

        $this->db->query("SELECT * FROM rooms");
        
        return $this->db->resultSet();
    }


    public function addRoom($data){
        $this->db->query('INSERT INTO rooms (title, type, genre, description, price, image) VALUES (:title, :type, :genre, :description, :price, :image)');
        //bind values
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':type',$data['type']);
        $this->db->bind(':genre',$data['genre']);
        $this->db->bind(':description',$data['description']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':image',$data['image']);
        // Execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function updateRoom($data){
        $this->db->query('UPDATE rooms SET title = :title , type = :type, genre = :genre, description = :description, price = :price , image=:image WHERE id=:id');
        //bind values
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
}