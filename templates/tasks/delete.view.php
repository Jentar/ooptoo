<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!empty($id)) {
        $task = Task::find($id);

        if (is_object($task)) {
            $task->delete();
        }
    }
?>

<meta http-equiv="refresh" content="0;URL='/?p=tasks/list'" />