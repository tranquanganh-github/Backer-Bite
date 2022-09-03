<?php
session_start();
include 'config/connect.php';
include 'config/function.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
unset($_SESSION['order_list']);

$user = !empty($_SESSION['user_login']) ? $_SESSION['user_login'] : [];
$userId = !empty($user['id']) ? $user['id'] : '';

$sql = "SELECT * FROM orders WHERE userId = :userId";
$statement = $conn->prepare($sql);
$statement->bindParam(':userId', $userId);
$statement->execute();
$row = $statement->fetchAll();

foreach($row as $item){
    $count = 0;
    $sql_orderDetail = "SELECT * FROM orderDetail WHERE ordersId = :ordersId";
    $statement = $conn->prepare($sql_orderDetail);
    $statement->bindParam(':ordersId', $item['id']);
    $statement->execute();
    $orderDetail = $statement->fetch(PDO::FETCH_ASSOC);
    $productId = $orderDetail['productId'];
    $quantity = $orderDetail['quantity'];
    $sql_product = "SELECT * FROM products WHERE id = :productId";
    $statement = $conn->prepare($sql_product);
    $statement->bindParam('productId', $productId);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);
    $array = array(
        'productId' => $product['id'],
        'productName' => $product['name'],
        'url' => $product['url'],
        'price' => $product['price'],
        'subTotal' => $product['price'] * $quantity,
        'quantity' => $quantity
    );
    $_SESSION['order_list'][$count] = $array;
    $count++;
}

header('location: index.php?f=cart&file=orderList');
?>