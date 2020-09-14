<?php $users = User::all(); ?>
<table class="table">
    <tr>
        <th>Description</th>
        <th>Completed</th>
        <th>Added</th>
        <th>Edited</th>
        <th></th>
        <th></th>
    </tr>
    <?php if(!empty($users)) : foreach ($users as $user) { ?>
        <tr>
            <td><?php echo $user->email; ?></td>
            <td><?php echo $user->first_name; ?></td>
            <td><?php echo $user->last_name; ?></td>
            <td><?php echo $user->group; ?></td>
            <td><a href="/?p=users/save&id=<?php echo $user->id; ?>">Muuda</a></td>
            <td><a href="/?p=users/delete&id=<?php echo $user->id; ?>">Delete</a></td>
        </tr>
    <?php } endif; ?>
</table>