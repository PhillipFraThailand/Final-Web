<?php
    session_start();
    require_once('Database/user.php');
    require_once('sanitizer.php');

    switch ($_POST['action']) {
        case 'logout':
            session_destroy();
            header('Location: http://localhost:8080/final-web/?signout="signout"');
            exit;
            break;

        case 'login':
           loginUser();
            break;

        case 'register':
            registerUser();
            break;

        case 'updateUser':
            echo('updateUser');
            break;

        default:
            echo('default');
            break;
    }
    
    // SIGNUP
    function registerUser(){
        $user = new User();
        // Currently i assume the form is requiring everything which is debateable
        if (isset($_POST['firstName'])) {
            $firstName = sanitize_input($_POST['firstName']);
            $lastName = sanitize_input($_POST['lastName']);
            $password = sanitize_input($_POST['password']);
            $company = sanitize_input($_POST['company']);
            $address = sanitize_input($_POST['address']);
            $city = sanitize_input($_POST['city']);
            $state = sanitize_input($_POST['state']);
            $country = sanitize_input($_POST['country']);
            $postalCode = sanitize_input($_POST['postalCode']);
            $phone = sanitize_input($_POST['phone']);
            $fax = sanitize_input($_POST['fax']);
            $email = sanitize_input($_POST['email']);
        };
        
        // call create to insert into DB
        $user->create($firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);

        // if insert was succesfull
        if ($user) {
            echo('succes creating user! Go back to ');
            echo('<a href="./index.php">Home</a>');
        } else {
            echo('Error creating user');
        }
    }

    // LOGIN
    function loginUser(){
        $user = new User();
        // Sanitize inputs
       $email = sanitize_input($_POST['email']);
       $password = sanitize_input($_POST['password']);

       // if valid credentials create session
       $validUser = $user->createSession($email, $password);
       if ($validUser) {
           // return user to index
           header('Location: http://localhost:8080/final-web/');
           exit;
       } else {
            echo('<h1>Session not started</h1>');
            echo("<script>alert('login error')</script>");
            echo('<a href="./"> Click here to try agin</a>');
        }
    }

    // UPDATE USER (assumes the html requires all fields)
    function updateUser(){
        $user = new User();
        if (isset($_POST['firstName'])) {
            $firstName = sanitize_input($_POST['firstName']);
            $lastName = sanitize_input($_POST['lastName']);
            $oldPassword = sanitize_input($_POST['oldPassword']);
            $newPassword = sanitize_input($_POST['newPassword']);
            $company = sanitize_input($_POST['company']);
            $address = sanitize_input($_POST['address']);
            $city = sanitize_input($_POST['city']);
            $state = sanitize_input($_POST['state']);
            $country = sanitize_input($_POST['country']);
            $postalCode = sanitize_input($_POST['postalCode']);
            $phone = sanitize_input($_POST['phone']);
            $fax = sanitize_input($_POST['fax']);
            $newEmail = sanitize_input($_POST['newEmail']);

            $oldEmail = $_SESSION['email'];
        };

        $user->updateUser($firstName, $lastName, $oldPassword, $newPassword, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $oldEmail, $newEmail);

    }
?>

