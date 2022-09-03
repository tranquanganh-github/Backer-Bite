<?php
$totalPrice = intval($_GET['totalPrice']);
$carts = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
$user = !empty($_SESSION['user_login']) ? $_SESSION['user_login'] : [];

$id = !empty($user['id']) ? $user['id'] : '';
$username = !empty($user['username']) ? $user['username'] : '';
$phoneNumber = !empty($user['phoneNumber']) ? $user['phoneNumber'] : '';
$address = !empty($user['address']) ? $user['address'] : '';

?>

<div class="area">
    <div class="banner-products overlay-bg">
        <div class="container">
            <div class="breadcrumb-content text-center breadcrumbs-inner">
                <nav>
                    <ul class="breadcrumb-list">
                        <li>
                            <a href="index.php" title="Back to home page">Home</a>
                        </li>
                        <li>
                            <a href="index.php?f=cart&file=main" title="Back to cart page">Cart</a>
                        </li>
                        <li>
                            <p>Checkout</p>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<main>
    <div class="container-checkout">
        <div class="container-checkout__col-left">
            <h4>
                <span class="text-logo">
                    BAKER BITE</span>
                <span>SHOP</span>
            </h4>
            <nav>
                <ol>
                    <li><a href="">Cart</a></li>
                    <li>Information</li>
                </ol>
            </nav>
            <p>Contact Information</p>
            <form action="index.php?f=cart&file=processCheckOut&totalPrice=<?php echo $totalPrice; ?>" method="POST">
                <span>Shipping address</span>
                <input name="input-id" type="text" hidden value="<?php echo $id; ?>">
                <input name="input-name" type="text" placeholder="Name" value="<?php echo $username ?>">
                <input name="input-phonenumber" type="text" placeholder="Phonenumber" value="<?php echo $phoneNumber ?>">
                <input name="input-address" type="text" placeholder="Address" value="<?php echo $address ?>">
                <div class="container-checkout__col-left--buy-btn">
                    <a href="index.php?f=cart&file=main">Return to cart</a>
                    <button type="submit">Buy</button>
                </div>
            </form>
        </div>
        <div class="container-checkout__col-right">
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php foreach ($carts as $row) { ?>
                    <tr>
                        <th>
                            <img src="./Admin/images/products/<?php echo $row['url']; ?>" alt="<?php echo $row['url']; ?>">
                        </th>
                        <th>
                            <p><?php echo $row['name'] ?></p>
                        </th>
                        <th>
                            <p><?php echo $row['quantity'] ?></p>
                        </th>
                        <th>
                            <p>$ <?php echo $row['subTotal'] ?></p>
                        </th>
                    <?php }; ?>
            </table>
            <div class="container-checkout__col-right--total">
                <p>Total : </p>
                <p>$ <?php echo $totalPrice; ?></p>
            </div>
        </div>
    </div>
</div>