<?php
//Call file db-config.php who have the database config
require 'db-config.php';

//connect to the database
    try {
        $connection= new PDO($argDSN,$user,$passwd,$option);
        // echo "connection established";
        // header('Location: index.php');
        
    }catch (PDOException $error){
        //echo "<br>Connection failure ".$error->getMessage();

    }

?>