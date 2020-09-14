<?php

function route ($page) {

    global $pages;

    if (empty($page)) {
        $page = 'home';
    } else if (!in_array($page, array_keys($pages))) {
        $page = '404';
    }

    return $page;
}

function generatePassword ($password) {
    /**
     * In this case, we want to increase the default cost for BCRYPT to 12.
     * Note that we also switched to BCRYPT, which will always be 60 characters.
     */
    $options = [
        'cost' => 12,
    ];

    return password_hash($password, PASSWORD_BCRYPT, $options);
}