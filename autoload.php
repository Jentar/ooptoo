<?php

try {
    $pdo = new PDO(
        'mysql:host=d82643.mysql.zonevs.eu;dbname=__DATABASE_NAME__',
        '__DATABASE_USERNAME__', '__PASSWORD__'
    );

} catch (PDOException $e) {
    die($e->getMessage());
}

require_once 'model/Task.php';
require_once 'model/User.php';
require_once 'include/pages.php';
require_once 'include/functions.php';