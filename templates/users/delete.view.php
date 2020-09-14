<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!empty($id)) {
        $user = User::find($id);

        if (is_object($user)) {
            $user->delete();
        }
    }
?>

<meta http-equiv="refresh" content="0;URL='/?p=users/list'" />