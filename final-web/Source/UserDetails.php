<?php
//Details page for user
    require_once('Database/UserService.php');
    $dp = new UserService();
    $results = $dp->fetchUsers();

    if (isset($_SESSION)) {
        echo('UserDetails if session is set.');
    } else {
        echo('UserDetails if session is NOT set');
    };
    
    print_r($results[0]);
?>


