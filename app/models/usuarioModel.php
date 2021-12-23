<?php

class usuarioModel extends Model {
    
    public $id;
    public $name;
    public $username;
    public $email;
    public $create_at;
    public $update_at;

    public function add() {
        $sql = 'INSERT INTO users (name, username, email, create_at) VALUES (:name, :username, :email, :create_at)';
        $registro =
        [
            'name'      => $this->name,
            'username'  => $this->username,
            'email'     => $this->email,
            'create_at' => $this->create_at
        ];
        
        try {
            return ($this->id = parent::query($sql, $registro)) ? $this->id : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    /**
     * Método para actualizar un usuario
     * @return boolean
     */
    public function update() {
        $sql = 'UPDATE users SET name=:name, username=:username, email=:email WHERE id=:id';
        $registro =
        [
            'id'        => $this->id,
            'name'      => $this->name,
            'username'  => $this->username,
            'email'     => $this->email
        ];
        
        try {
            return (parent::query($sql, $registro)) ? true : false;
        } catch (Exception $e) {
            throw $e;
        }
    }
}