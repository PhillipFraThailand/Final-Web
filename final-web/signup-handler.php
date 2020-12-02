<?php
    require_once('Database/user.php');
    require_once('sanitizer.php');
    echo('start signup-handler');

    // Validates input in the create function with prepare
    $user = new User();

    // Currently i assume the form is requering everything which is debatable
    if (isset($_POST['firstName'])) {
        $firstname = sanitize_input($_POST['firstName']);
        $lastName = sanitize_input($_POST['lastName']);
        $password = sanitize_input($_POST['password']);
        $email = sanitize_input($_POST['email']);
        $company = sanitize_input($_POST['company']);
        $address = sanitize_input($_POST['address']);
        $city = sanitize_input($_POST['city']);
        $state = sanitize_input($_POST['state']);
        $country = sanitize_input($_POST['country']);
        $postalCode = sanitize_input($_POST['postalCode']);
        $phone = sanitize_input($_POST['phone']);
        $fax = sanitize_input($_POST['fax']);
    };

    $user->create($firstname, $lastName, $password, $email, $company, $address, $city, $state, $country, 
                    $postalCode, $phone, $fax);


    if ($user) {
        echo('succes creating user, go back to login');
        echo('<a href="localhost:8080/final-web"></a>');
    }

?>