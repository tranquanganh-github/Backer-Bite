<?php session_start();
include 'config/connect.php';
include 'config/function.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$action = !empty($_GET['action']) ? $_GET['action'] : 'add';
$id = !empty($_GET['id']) ? intval($_GET['id']) : 0;
$quantity = !empty($_POST['quantity']) ? intval($_POST['quantity']) : 1;
$subTotal = 0;

if($action == 'add'){
    
    try{
        $sql_select_product = "SELECT * FROM products WHERE id = :id";
        $statement_select_product = $conn->prepare($sql_select_product);
        $statement_select_product->bindParam(':id', $id, PDO::PARAM_INT);
        $statement_select_product->execute();
        $select_product = $statement_select_product->fetch(PDO::FETCH_ASSOC);
        if(!empty($select_product)){
            $subTotal = $select_product['price'] * $quantity;
            $cart = array(
                'id' => $select_product['id'],
                'name' => $select_product['name'],
                'url' => $select_product['url'],
                'price' => $select_product['price'],
                'quantity' => $quantity,
                'subTotal' => $subTotal
            );
            if(!empty($_SESSION['cart'][$id])){
                $update_cart = $_SESSION['cart'][$id];
                $update_cart['quantity'] += $quantity;
                $update_cart['subTotal'] += $subTotal;
                $_SESSION['cart'][$id] = $update_cart;
                header('location: index.php?f=cart');
            }else{
                $_SESSION['cart'][$id] = $cart;
                header('location: index.php?f=cart');
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

if($action == 'update'){
    try{
        $sql_select_product_update = "SELECT * FROM products WHERE id = :id";
        $statement_select_product_update = $conn->prepare($sql_select_product_update);
        $statement_select_product_update->bindParam(':id', $id, PDO::PARAM_INT);
        $statement_select_product_update->execute();
        $select_product_update = $statement_select_product_update->fetch(PDO::FETCH_ASSOC);
        if(!empty($select_product_update)){
            if(!empty($_SESSION['cart'][$id])){
                $update_cart = $_SESSION['cart'][$id];
                $update_cart['quantity'] = $quantity;
                $update_cart['subTotal'] = $select_product_update['price'] * $quantity;
                $_SESSION['cart'][$id] = $update_cart;
                header('location: index.php?f=cart');
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }

}

if($action == 'remove'){
    if(!empty($_SESSION['cart'][$id])){
        unset($_SESSION['cart'][$id]);
        header('location: index.php?f=cart');
    }else{
        header('location: index.php?f=cart');
    }
}

if($action == 'clear'){
    if(!empty($_SESSION['cart'])){
        unset($_SESSION['cart']);
        header('location: index.php?f=cart');
    }else{
        header('location: index.php?f=cart');
    }
}
// 

// header('location: index.php?f=main&file=404');