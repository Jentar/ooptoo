<?php $tasks = Task::all(); ?>
<table class="table">
    <tr>
        <th>Description</th>
        <th>Completed</th>
        <th>Added</th>
        <th>Edited</th>
        <th></th>
        <th></th>
    </tr>
    <?php if(!empty($tasks)) : foreach ($tasks as $task) { ?>
        <tr>
            <td><?php echo $task->description; ?></td>
            <td><?php echo $task->is_completed; ?></td>
            <td><?php echo $task->added; ?></td>
            <td><?php echo $task->edited; ?></td>
            <td><a href="/?p=save&id=<?php echo $task->id; ?>">Muuda</a></td>
            <td><a href="/?p=delete&id=<?php echo $task->id; ?>">Delete</a></td>
        </tr>
    <?php } endif; ?>
</table>