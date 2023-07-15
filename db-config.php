<?php
    //Variable useful for database connection 
        $dbms="mysql";
        $host="localhost";
        $dbname="biblioBd";
        $user='root';
        $passwd='';
        $argDSN=$dbms.":host=".$host.";dbname=".$dbname;
        $option=[
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false

        ];
?>