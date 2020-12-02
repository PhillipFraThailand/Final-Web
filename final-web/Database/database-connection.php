<?php

class DB {

    public $pdo;

    public function connect() {
        $cServer = 'localhost';     // Server
        $cDB = 'chinook_abridged';  // Database name
        $cUser = 'root';            // UserName
        $cPwd = '';                 // Password

        $cDSN = 'mysql:host=' . $cServer . ';dbname=' . $cDB . ';charset=utf8'; // Variables and options for PDO
        $cOptions = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,             // Throw PDO exeptions near the cause of the error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,                   // Making PDO fetch associative arrays pr. default
            PDO::ATTR_EMULATE_PREPARES   => false,                              // Disables automatic formatting of returned data from database
        ];

        try {
            $cnDB = @new PDO($cDSN, $cUser, $cPwd, $cOptions); 
        } catch (\PDOException $oException) {
            echo 'Connection unsuccesful '. $oException . '<br>';
            die('Connection unsuccessful: ' . $cnDB->connect_error());
            exit();
        }
        return ($cnDB);
    }

    // Closes connection to DB
    public function disconnect($pcDB) {
        $pcDB = null;
    }
}
?>