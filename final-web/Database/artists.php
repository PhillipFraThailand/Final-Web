<?php
    require_once('header.php');
    require_once('database-connection.php');

    //Service which handles retrieving data for artists
    class ArtistService {

        // Fetch artists
        function fetchArtists() {
            // Create a PDO object to connect with
            $db = new DB();
            $con = $db->connect();          
            $results = array();

            // If connection
            if($con) {
                $limit = 25;

                // Pagination if cookie and check if 0 or negative.
                if (isset($_GET['page']) && ($_GET['page'] > 0)) {
                    $page = (int)$_GET['page'];
                    $offset = ($page * $limit -1);
                } else {
                    $offset = 0;
                };

                // Query
                $cQuery = <<<QUERY
                    SELECT * FROM artist
                    LIMIT $limit OFFSET $offset;
                QUERY;

                // Run the Query and save result in $stmt
                $stmt = $con->query($cQuery);

                // Add the rows from statement to results
                while($row = $stmt->fetch())
                    $results[] = [$row['Name']];
                
                // Close connection
                $stmt = null;
                $db->disconnect($con);

                return($results);

            } else {
                // add logging failed to db connect
                return false; 
            };
        }
    }
?>