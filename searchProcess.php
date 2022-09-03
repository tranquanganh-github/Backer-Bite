<?php
session_start();
include 'config/connect.php';
include 'config/function.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
unset($_SESSION['search']);
$key = !empty($_GET['key']) ? $_GET['key'] : '';

if($key != ''){
    $sql = "SELECT * FROM products WHERE name LIKE :keyword OR price LIKE :keyword ORDER BY name";
    $statement = $conn->prepare($sql);
    $statement->bindValue(':keyword', '%' . $key . '%', PDO::PARAM_STR);
    $statement->execute();
    $row = $statement->fetchAll();
    $count = 0;
    foreach($row as $results) {
        $search = array(
            'id' => $results['id'],
            'name' => $results['name'],
            'url' => $results['url'],
            'price' => $results['price'],
            'count' => $results['count'],
            'description' => $results['description'],
        );
        $_SESSION['search'][$count] = $search;
        $count++;
    }
}else{
    unset($_SESSION['search']);
}
header('location: index.php?f=main&file=search');
?>