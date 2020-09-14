<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $message = filter_input(INPUT_GET, 'msg', FILTER_SANITIZE_STRING);

    if (!empty($id)) {
        $user = User::find($id);
    }

    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);

    $sError = "";

    if (isset($action) && $action == 'insert') {

        if (empty($id)) {
            $user = new User();
        }

        $error = false;

        //check values from web
        if (empty($email) || empty($password) || empty($first_name) || empty($last_name)) {
            $error = true;
            $sError = 'All fields are mandatory';
        } elseif (!User::findByEmail($email) && empty($id)) {
            $error = true;
            $sError = 'Email duplication';
        }

        if (!$error) {

            $user->email = $email;
            $user->password = generatePassword($password);
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->group = 'user';
            $user->added = date("Y-m-d H:i:s");
            $user->edited = date("Y-m-d H:i:s");
            $user->last_login = date("Y-m-d H:i:s");
            $user->status = 1;

            $user->save();

            $message = 'User saved!';

            if (!empty($id)) :
                ?><meta http-equiv="refresh" content="0;URL='/?p=users/save&id=<?php echo $id; ?>&msg=<?php echo $message; ?>'" /><?php
            else :
                ?><meta http-equiv="refresh" content="0;URL='/?p=users/save&msg=<?php echo $message; ?>'" /><?php
            endif;
        }

    }
?>
<?php echo empty($message) ? "" : '<div class="alert alert-success">' . $message . '</div>'; ?>
<?php echo empty($sError) ? "" : '<div class="alert alert-danger">' . $sError . '</div>'; ?>

<form method="post" action="/?p=users/save<?php echo !empty($id) ? '&id=' . $id : "" ?>">
    <div class="form-group">
        <label for="email">Email</label>
        <input
            type="text"
            class="form-control"
            id="email"
            name="email"
            value="<?php echo isset($user) ? $user->email : ""; ?>"
        >
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                value="<?php echo isset($user) ? $user->password : ""; ?>"
        >
    </div>
    <div class="form-group">
        <label for="first_name">First name</label>
        <input
                type="text"
                class="form-control"
                id="first_name"
                name="first_name"
                value="<?php echo isset($user) ? $user->first_name : ""; ?>"
        >
    </div>
    <div class="form-group">
        <label for="last_name">Last name</label>
        <input
                type="text"
                class="form-control"
                id="last_name"
                name="last_name"
                value="<?php echo isset($user) ? $user->last_name : ""; ?>"
        >
    </div>

    <button type="submit" class="btn btn-primary" name="action" value="insert">Save</button>
</form>