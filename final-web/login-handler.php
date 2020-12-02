<?php
    session_start();
    require_once('Database/user.php');
    require_once('sanitizer.php');

    // If logout
    if (isset($_POST['logout'])) {
        session_destroy();
    // If logged
    } else if (isset($_SESSION['email'])) {
        header('Location: http://localhost:8080/final-web/?category=artists');
        exit;
    // If posted login
    } else if (isset($_POST['email'])) {
        $user = new User();
    
        // Sanitize inputs
        $email = sanitize_input($_POST['email']);
        $password = sanitize_input($_POST['password']);

        // Validate the information
        $validUser = $user->validateUser($email, $password);

        // Create session if valid
        if ($validUser) {

            $_SESSION['userId'] = $user->userID;
            $_SESSION['firstName'] = $user->firstName;
            $_SESSION['lastName'] = $user->lastName;
            $_SESSION['email'] = $email;

            // return user to index
            // header('Location: http://localhost:8080/final-web/?category=artists"');
            // exit;
            echo('<h1>Session started</h1>');
        } else {
            // consider doing something else
            echo('<h1>Session not started</h1>');
            // header('Location: http://localhost:8080/final-web/?category=artists');
            // exit;
        }
    }
?>

loginhandler test