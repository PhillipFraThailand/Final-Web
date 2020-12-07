<?php
    session_start();
    require_once('Database/user.php');
    require_once('sanitizer.php');
    echo('<pre>');
    print_r($GLOBALS);
    echo('</pre>');

    // If logout
    if (isset($_POST['signout'])) {
        session_destroy();
        header('Location: http://localhost:8080/final-web/?signout="signout"');
        exit;
    // If logged in
    } else if (isset($_SESSION['email'])) {
        header('Location: http://localhost:8080/final-web/?');
        exit;

    // If logging in
    } else if (isset($_POST['email'])) {
        $user = new User();
    
        // Sanitize inputs
        $email = sanitize_input($_POST['email']);
        $password = sanitize_input($_POST['password']);

        // if valid credentials create session
        $validUser = $user->createSession($email, $password);

        // Create session if valid
        if ($validUser) {
            // return user to index
            header('Location: http://localhost:8080/final-web/');
            exit;
            
        } else {
            // consider doing something else
            echo('<h1>Session not started</h1>');
            echo("<script>alert('login error')</script>");
            echo('<a href="./"> Click here to try agin</a>');
            // Reopening the modal requires a JS script to trigger the buttonclick
            // header('Location: http://localhost:8080/final-web/');
            // exit;
        }
    }
?>
