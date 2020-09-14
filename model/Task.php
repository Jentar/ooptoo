<?php

class Task {

    protected $table = 'todos';

    public $id;
    public $description;
    public $is_completed;
    public $added;
    public $edited;

    public static function find ($id = 0) {

        global $pdo;

        $statement = $pdo->prepare('SELECT * FROM todos where id=? LIMIT 1');

        $statement->setFetchMode(PDO::FETCH_CLASS, 'Task');
        $statement->execute([$id]);

        return $statement->fetch();

    }

    public static function all () {

        global $pdo;

        $statement = $pdo->prepare('SELECT * FROM todos');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS, 'Task');
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

        $sql = "INSERT INTO " . $this->table . " (description, is_completed, added) VALUES (?, ?, ?)";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->description, $this->is_completed, $this->added]);

        return true;
    }

    public function update () {
        global $pdo;

        $sql = "UPDATE " . $this->table . " SET description=?, is_completed=? WHERE id=?";
        $statement = $pdo->prepare($sql);
        $statement->execute([$this->description, $this->is_completed, $this->id]);

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