<?php 
    $conn = NULL;
    $connection_string = "mysql:host=127.0.0.1;dbname=quan_db_baker_bite;charset=UTF8";
    try {
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $conn = new PDO(
            $connection_string, 
            "quan_baker_bite", 
            "N1r4d@6Hp64PeEE^", 
            $options);
        // echo "Connected successfully";
    } catch (PDOException $e) {         
        echo "Cannot connect DB: ".$e->getMessage();
    } finally {
        //do nothing
    } 
?>