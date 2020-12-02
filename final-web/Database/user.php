<?php
    require_once('database-connection.php');

    class User extends DB {

        public int $userId;
        public string $email;
        public string $firstName;
        public string $lastName;
        public string $address;

        // create a customer in db
        function create($firstName, $lastName, $password, $Company, $address, $city, 
                        $state, $country, $postalCode, $phone, $fax, $email) {

            // check if user already exists
            $query = <<<SQL
                SELECT COUNT(*) AS total FROM customer WHERE email = ?;
            SQL;
            
            //  prepare and run statement
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$email]);

            // if result return false
            if($stmt->fetch()['total'] > 0) {
                return false;
            }
            
            // hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);
            
            // insert user
            $query = <<<SQL
                INSERT INTO customer (FirstName, LastName, Password, Email, Company, Address, City, 
                        State, Country, PostalCode, Phone, Fax) VALUES(?,?,?,?,?,?,?,?,?,?,?,?;);
                SQL;

                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$firstName, $lastName, $password, $email, $Company, $address, $city, 
                               $state, $country, $postalCode, $phone, $fax]);

            // close connection
            $this->disconnect();
            return true;
        }

        // validate login credentials
        function validateUser($email, $password) {
            // get the customer with matching email
            $query = <<< SQL
                SELECT CustomerId, firstName, lastName, Password 
                FROM customer WHERE email = ?;
            SQL;
            
            // Create prepared statement
            $stmt = $this->pdo->prepare($query);
    
            // Execute the statement
            $stmt->execute([$email]);
    
            $this->disconnect();

            // If no results match return false
            if($stmt->rowCount() === 0) {
                echo('User not found');
                return false;
    
            // else return true
            } else {
                // Fetch the row from the statement
                $row = $stmt->fetch();
                $this->userId = $row['CustomerId'];
                $this->firstName = $row['FirstName'];
                $this->lastName = $row['LastName'];
                $this->email = $email;
    
                // validate password
                return (password_verify($password, $row['Password']));
            }
        }
    }


?>