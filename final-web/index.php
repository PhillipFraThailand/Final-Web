<?php
    require_once('header.php');

    if (isset($_SESSION['userId'])) {
        echo('Session succesfully started');
    } elseif (isset($_GET['signout'])) {
        echo('Sign out succesfull');
    } else {
        echo('Welcome to Index');
    }
?>



<!-- 
when i echo something back to the user i should do it with htmlentities so the user cant change his username to a script and then run it:
echo htmlentities($string, ENT_QUOTES, 'UTF-8'); 
-->