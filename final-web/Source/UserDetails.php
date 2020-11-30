<?php
//Details page for user
    session_start();
    require_once('Database/UserService.php');
    $dp = new UserService();
    $results = $dp->fetchUsers();

    if (isset($_SESSION)) {
        echo('Session is set');
    } else {
        echo('No Session');
    };

?>


