<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    if (!empty($id)) {
        $task = Task::find($id);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $isComplete = filter_input(INPUT_POST, 'is_complete', FILTER_SANITIZE_STRING);

    if (isset($action) && $action == 'insert') {

        if (empty($id)) {
            $task = new Task();
        }

        $task->description = $description;
        $task->is_completed = empty($isComplete) ? 0 : 1;
        $task->added = date("Y-m-d H:i:s");
        $task->edited = date("Y-m-d H:i:s");

        $task->save();

        if (!empty($id)) :
            ?><meta http-equiv="refresh" content="0;URL='/?p=tasks/save&id=<?php echo $id; ?>'" /><?php
        else :
            ?><meta http-equiv="refresh" content="0;URL='/?p=tasks/save'" /><?php
        endif;
    }
?>
<form method="post" action="/?p=tasks/save<?php echo !empty($id) ? '&id=' . $id : "" ?>">
    <div class="form-group">
        <label for="description">Description</label>
        <input
            type="text"
            class="form-control"
            id="description"
            name="description"
            value="<?php echo isset($task) ? $task->description : ""; ?>"
        >
    </div>
    <div class="form-group form-check">
        <input
            type="checkbox"
            class="form-check-input"
            id="is_complete"
            name="is_complete"
            <?php echo isset($task) ? $task->is_completed == 1 ? 'checked' : "" : ""; ?>
        >
        <label class="form-check-label" for="is_complete">Is Complete</label>
    </div>
    <button type="submit" class="btn btn-primary" name="action" value="insert">Save</button>
</form>