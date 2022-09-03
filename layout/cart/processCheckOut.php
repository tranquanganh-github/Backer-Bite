<?php
$totalPrice = intval($_GET['totalPrice']);
$carts = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
$sql = "SELECT * FROM users ";
$statement = $conn->prepare($sql);
$statement->execute();
$id_user = $conn->lastInsertId();

$id = !empty($_POST['input-id']) ? $_POST['input-id'] : ($id_user + 1);
$name = $_POST['input-name'];
$phoneNumber = $_POST['input-phonenumber'];
$address = $_POST['input-address'];

try {
    if (!empty($carts)) {
        $sql_insert_orders = "INSERT INTO orders (username, phoneNumber, address, totalPrice, userId)
                                    VALUE(:username, :phoneNumber, :address, :totalPrice, :userId)";
        $statement = $conn->prepare($sql_insert_orders);
        $statement->bindParam(':username', $name);
        $statement->bindParam(':phoneNumber', $phoneNumber);
        $statement->bindParam(':address', $address);
        $statement->bindParam(':totalPrice', $totalPrice);
        $statement->bindParam(':userId', $id);
        if ($statement->execute()) {
            $orderId = $conn->lastInsertId();
            $sql_insert_orders_detail = "INSERT INTO orderDetail (productId, ordersId, quantity)
                                                VALUE(:productId, :ordersId, :quantity)";
            $statement_detail = $conn->prepare($sql_insert_orders_detail);
            foreach ($carts as $item) {
                $productId = $item['id'];
                $quantity = $item['quantity'];
                $statement_detail->bindParam(':productId', $productId);
                $statement_detail->bindParam(':ordersId', $orderId);
                $statement_detail->bindParam(':quantity', $quantity);
                $statement_detail->execute();
            }
            unset($_SESSION['cart']);
            header('location: index.php?f=cart&file=getMessage');
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<!-- breadcrumb -->
<!-- shopping-cart  -->