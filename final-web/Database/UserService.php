<?php
    require_once('DbConnection.php');

    // Service which handles retrieving data for artists
    class UserService extends DB {

        public int $userId;
        public string $email;
        public string $firstName;
        public string $lastName;
        public string $address;

    
        // Fetch users for debugging
        function fetchUsers() {
            // Create a PDO object to connect with
            $db = new DB();
            $con = $db->connect();          
            $results = array();

            // If connection and limit because we just need to fetch some users to debug
            if($con) {
                $limit = 25;

            // Query
                $query = <<<QUERY
                SELECT * FROM customer
                LIMIT $limit;
                QUERY;

                // Run the Query and save result in $stmt
                $stmt = $con->query($query);

                // Add the rows from statement to results
                while($row = $stmt->fetch())
                    $results[] = [$row['email']];
                
                // Close connection
                $stmt = null;
                $db->disconnect($con);

                return($results);

            } else {
                // Add logging failed to db connect
                return false; 
            };
        }

    }

?>