<?php
    require_once('database-connection.php');
    class User extends DB {
        public int $userId;
        public string $email;
        public string $firstName;
        public string $lastName;
        public string $address;

        function fetchUserInfo($email) {
            // Query
            $query = <<<SQL
                SELECT *
                FROM customer where Email = ?;
            SQL;

            //  Prepare the statement
            $stmt = $this->pdo->prepare($query);

            // execute the query which returns true on success and false on failure
            if ($stmt->execute([$email])) {
                
                // If no result return false
                if($stmt->rowCount() === 0) {
                    return false;
                } else {
                    $row = $stmt->fetch();
                    return $row;
                }
            // if the query to db was a failure
            } else {
                return false;
            }
        }

        // create a customer in db
        function create($firstName, $lastName, $password, $company, $address, 
                            $city, $state, $country, $postalCode, $phone, $fax, $email) {

            // check if user already exists
            $query = <<<SQL
                SELECT COUNT(*) AS total FROM customer WHERE email = ?;
            SQL;

            //  prepare the statement
            $stmt = $this->pdo->prepare($query);
            
            //if the query to db was a success check the result
            if ( $stmt->execute([$email]) ) {

                // if the email exist we fail
                if($stmt->fetch()['total'] > 0) {
                    return false;

                // if the email does not exist continue
                } else {

                    // hash the password
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    // create the query
                    $query = <<<SQL
                        INSERT INTO customer (FirstName, LastName, Password, Company, Address, City, 
                                State, Country, PostalCode, Phone, Fax, Email) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);
                        SQL;
                        
                    // Prepare the statement
                    $stmt = $this->pdo->prepare($query);
                }
            }

            // If the execution is a success
            if($stmt->execute([$firstName, $lastName, $password, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email])) {
                $this->disconnect();
                return true;
                
            // error in query execution
            } else {
                return false;
            }
        }

        //updates a user if the email does not exist use the session email as the old email
        function updateUser($firstName, $lastName, $oldPassword, $newPassword, $company, $address, 
                            $city, $state, $country, $postalCode, $phone, $fax, $oldEmail, $newEmail) {

            // check if user already exists
            $query = <<<SQL
                SELECT COUNT(*) AS total FROM customer WHERE email = ?;
            SQL;

            //  prepare and run statement
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$newEmail]);
            
            // if email exists return false
            if ($stmt->rowCount()>0) {
                return false;    
            
            // if email is not taken update the row
            } else {
                $updateQuery = <<<SQL
                    UPDATE customer 
                    SET FirstName = ?, LastName = ?, Password = ?, Company = ?, Address = ?, City = ?, State = ?, Country = ?, PostalCode = ?, Phone = ?, Fax = ?, Email = ?
                    WHERE Email = ?;
                SQL;

                // Prepare the statement
                $stmt = $this->pdo->prepare($query);

                // If the execution is a success
                if ($stmt->execute([$firstName, $lastName, $newPassword, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $newEmail])) {
                    $this->disconnect();
                    return true;

                // error in query execution
                } else {
                    $this->disconnect();
                    return false;
                }
            }
        }

        // validate login credentials
        function createSession($email, $password) {
            // get the customer with matching email
            $query = <<<SQL
                SELECT CustomerId, FirstName, LastName, Password 
                FROM customer WHERE Email = ?;
            SQL;
            
            // Create prepared statement
            $stmt = $this->pdo->prepare($query);
    
            //if the query was a success
            if ( $stmt->execute([$email]) ) {
                // check if the result was empty, if then stop
                if($stmt->rowCount() === 0) {
                    $this->disconnect();
                    return false;
                    
                // if result was not empty try to validate and create the session
                } else {
                    // get result & validate password
                    $row = $stmt->fetch();
                    $login = password_verify($password, $row['Password']);

                    // if valid password set session
                    if ($login) {
                        $_SESSION['userId'] = $row['CustomerId'];
                        $_SESSION['firstName'] = $row['FirstName'];
                        $_SESSION['lastName'] = $row['LastName'];
                        $_SESSION['email'] = $email;
                        return true;
                    } else {
                        return false;
                    }
                }    
            }                
        }
    }
?>