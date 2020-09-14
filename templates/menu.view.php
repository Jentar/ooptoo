<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a class="
            nav-link
            <?php echo in_array($page, ['home', '404']) ? 'active' : '';  ?>
        " href="/">Home</a>
    </li>
    <li class="nav-item">
        <a class="
            nav-link
            <?php echo in_array($page, ['tasks/list', 'tasks/save']) ? 'active' : '';  ?>
        " href="?p=tasks/list">Tasks</a>
    </li>
    <li class="nav-item">
        <a class="
            nav-link
            <?php echo in_array($page, ['users/list', 'users/save']) ? 'active' : '';  ?>
        " href="?p=users/list">Users</a>
    </li>
</ul>