<?php
    session_start();
    require_once('Database/user.php');
    require_once('Database/database-connection.php');
    echo('start loginhandler');
    echo('<br>');

class login extends DB {

    function login() {
        // If logout
        if (isset($_POST['logout'])) { 
            echo('logout');
            session_destroy();

        // If logged in redirect to index
        } else if (isset($_SESSION['email'])) {  
            echo('session email is set');
            header('Location: http://localhost:8080/final-web/?category=artists');

        // If login information has been posted
        } else if (isset($_POST['email'])) {  
            echo('email is posted');
            $user = new User();

            // Get the posted data
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate the information
            $validUser = validateUser($email, $password);
            
            // Create session if user is valid
            if ($validUser) {
                echo('valid user sat');
                session_start();

                $_SESSION['userId'] = $user->userID;
                $_SESSION['firstName'] = $user->firstName;
                $_SESSION['lastName'] = $user->lastName;
                $_SESSION['email'] = $email;

                // return user to index
                // header('Location: http://localhost:8080/final-web/?category=artists"');
                echo('<h1>Session started</h1>');
            } else {
                // consider doing something else
                echo('<h1>Session not started</h1>');
            }        
        }
        
        // Validate that the email and password is in the db and return a boolean
        function validateUser($email, $password) {
            $user = new User();
            $pdo = new DB();

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
                echo('User not found');
                return false;

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
    }
}
?>
loginhandler