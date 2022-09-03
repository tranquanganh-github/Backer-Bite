<?php
include './config/connect.php';
include './config/function.php';
ob_start();
session_start();

$carts = !empty($_SESSION['cart']) ? $_SESSION['cart'] : [];
$user = !empty($_SESSION['user_login']) ? $_SESSION['user_login'] : [];
$username = !empty($user['username']) ? $user['username'] : '';
$total_products_carts = 0;
$total = 0;

foreach ($carts as $all_items) {
    $total_products_carts += $all_items['quantity'];
    $total += $all_items['subTotal'];
}

$statement = $conn->prepare('SELECT * FROM categories');
$statement->execute();
$all_items = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Baker Bite</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png" />
    <!--===============================================================================================-->
    <link href="//cdn.shopify.com/s/files/1/1274/9187/t/10/assets/bootstrap.min.css?v=19868337340211324411641634525" rel="stylesheet" type="text/css" media="all">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/font.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <!--===============================================================================================-->
    <script src="https://kit.fontawesome.com/72c4ac30ee.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wapper">
        <header id="header-area" class="header-area sticky-bar ">
            <div class="main-header-wapper">
                <div class="container-fluid section-padding-1">
                    <div class="row header-custom-row">
                        <div class="col-xl-2 col-lg-2">
                            <div>
                                <a href="index.php?f=main&file=main">
                                    <img src="images/icons/logo-bakerbite.png" alt="Baker Bite">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <!-- Home -->
                                        <li class="">
                                            <a href="index.php?f=main&file=main">
                                                Home
                                            </a>
                                        </li>

                                        <!-- Menu -->
                                        <li class="">
                                            <a href="index.php?f=product&file=menu">
                                                Menu
                                            </a>
                                            <ul class="sub-menu">
                                                <?php foreach ($all_items as $row) { ?>
                                                    <li>
                                                        <a href="index.php?f=product&file=main&id=<?php echo $row['categoriesID'] ?>">
                                                            <?php echo $row['categoriesName'] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>

                                        <!-- Page -->
                                        <li class="">
                                            <a href="">
                                                Pages
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="">Contact</a></li>
                                                <li><a href="index.php?f=main&file=aboutUs">About Us</a></li>
                                                <li><a href="index.php?f=main&file=search">Search</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3">
                            <div class="header-right-wrap">
                                <div class="header-search">
                                    <a href="#" id="search-active" class="search-active"><i class="fa-solid fa-magnifying-glass"></i></a>
                                </div>
                                <div id="main-search-active" class="main-search-active">
                                    <div class="sider-search-icon">
                                        <button class="search-close" onclick="search_Close()">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </button>
                                    </div>
                                    <div class="sider-search-input">
                                        <form action="searchProcess.php" method="GET" style="position:relative;">
                                            <div class="form-search">
                                                <input type="search" placeholder="Search our store" autocomplete="off" name="key">
                                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="header-cart">
                                    <span class="icon-cart">
                                        <a href="index.php?f=cart&file=main">
                                            <i class="fa-solid fa-cart-arrow-down"></i>
                                            <span class="count-cart"><?php echo $total_products_carts; ?></span>
                                        </a>
                                    </span>
                                    <span class="total-price-cart">
                                        <span>$ <?php echo $total; ?></span>
                                    </span>
                                </div>
                                <div class="header-user">
                                    <a href=""><i class="fas fa-user"></i></a>
                                    <ul class="sub-menu">
                                        <br>
                                        <li <?= !empty($user) ? 'hidden' : ''; ?>>
                                            <a href="login.php">Login</a>
                                        </li>
                                        <li <?= !empty($user) ? '' : 'hidden'; ?>>
                                            <p><?php echo $username; ?></p>
                                        </li>
                                        <li <?= !empty($user) ? '' : 'hidden'; ?>>
                                            <a href="orderListProcess.php">Order History</a>
                                        </li>
                                        <li <?= !empty($user) ? '' : 'hidden'; ?>>
                                            <a href="logout.php">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>