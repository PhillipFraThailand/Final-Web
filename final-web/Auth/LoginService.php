<?php
    session_start();
    require_once('../Database/UserService.php');
    require_once('../Database/DbConnection.php');

    // If logout
    if (isset($_POST['logout'])) { 
        session_destroy();
    // If logged in redirect to index
    } else if (isset($_SESSION['email'])) {  
        header('Location: http://localhost:8080/final-web/?category=artists"');
    // If login information has been posted
    } else if (isset($_POST['email'])) {  
        $user = new UserService();

        // Get the posted data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate the information
        $validUser = validateUser($email, $password);
        
        // Create session 
        if ($validUser) {
            session_start();

            $_SESSION['userId'] = $user->userID;
            $_SESSION['firstName'] = $user->firstName;
            $_SESSION['lastName'] = $user->lastName;
            $_SESSION['email'] = $email;

            // return user to index
            header('Location: http://localhost:8080/final-web/?category=artists"');
        } else {
            // consider doing something else
            echo('Alert("User does not exist")');
        }        
    }
    
    // Validate that the email and password is in the db and return a boolean
    function validateUser($email, $password) {
        $user = new UserService();

        // get the customer with matching email
        $query = <<< SQL
            SELECT CustomerId, firstName, lastName, Password 
            FROM user WHERE email = ?;
            SQL;
        
        // Returns a prepared statement
        $stmt = $user->pdo->prepare($query);

        // Execute the statement
        $stmt->execute([$email]);

        // If no results match return false
        if($stmt->rowCount() === 0) {
            return false;

            echo('Alert("User not found")');
        // else return true
        } else {
            // Fetch the row from the statement
            $row = $stmt->fetch();
            $user->userId = $row['CustomerId'];
            $user->firstName = $row['FirstName'];
            $user->lastName = $row['LastName'];
            $user->email = $email;

            return (password_verify($password, $row['Password']));
        }
    }
?>