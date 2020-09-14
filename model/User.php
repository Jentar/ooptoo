<?php

class User {

    protected $table = 'users';

    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $group;
    public $last_login;
    public $status;
    public $added;
    public $edited;

    public static function find ($id = 0) {

        global $pdo;

        $statement = $pdo->prepare('SELECT * FROM users where id=? LIMIT 1');

        $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        $statement->execute([$id]);

        return $statement->fetch();

    }

    public static function findByEmail ($email = "") {

        if (empty($email)) {
            return false;
        }

        global $pdo;

        $statement = $pdo->prepare('SELECT * FROM users where email=? LIMIT 1');

        $statement->setFetchMode(PDO::FETCH_CLASS, 'User');
        $statement->execute([$email]);

        $result = $statement->fetch();

        return empty($result);

    }

    public static function all () {

        global $pdo;

        $statement = $pdo->prepare('SELECT * FROM users');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public function save () {

       if (empty($this->id)) {
           $this->insert();
       } else {
           $this->update();
       }

       return true;
    }

    public function insert () {
        global $pdo;

        //$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
        $sql = "INSERT INTO " . $this->table . " (`email`, `password`, `first_name`, `last_name`, `group`, `last_login`, `status`, `added`, `edited`) VALUES (?, ?, ? , ?, ?, ?, ?, ?, ?)";
        //$sql = "INSERT INTO " . $this->table . " (email, password, first_name, last_name, group, last_login, status, added, edited) VALUES (?, ?, ? , ?, ?, ?, ?, ?, ?)";

        //echo $sql;
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->email, $this->password, $this->first_name, $this->last_name, $this->group, $this->last_login, $this->status, $this->added, $this->edited]);

        /*if (!$statement) {
            echo "\nPDO::errorInfo():\n";
            print_r($pdo->errorInfo());
        }


        print_r($pdo->errorInfo());*/

        return true;
    }

    public function update () {
        global $pdo;

        $sql = "UPDATE " . $this->table . " SET first_name=?, last_name=?, `group`=?, last_login=?, status=?, edited=? WHERE id=?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->first_name, $this->last_name, $this->group, $this->last_login, $this->status, $this->edited, $this->id]);

        return true;
    }

    public function delete () {
        global $pdo;

        $sql = "DELETE FROM " . $this->table . " WHERE id=?";

        $statement = $pdo->prepare($sql);
        $statement->execute([$this->id]);

        return true;
    }
}