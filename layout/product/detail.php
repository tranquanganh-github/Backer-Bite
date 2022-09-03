<?php
$productId = !empty($_GET['id']) ? intval($_GET['id']) : 1;
$sql = "SELECT * FROM products WHERE id = $productId";
$row = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
$categories_id = $row['categoriesId'];
$sql_categories = "SELECT * FROM categories WHERE categoriesID = $categories_id";
$categories = $conn->query($sql_categories)->fetch(PDO::FETCH_ASSOC);
$categories_name = $categories['categoriesName'];
?>
<input id="id" type="text" value="<?php echo $row['id']; ?>" hidden>

<!-- Breadcumb -->
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
                            <a href="index.php?f=product&file=menu">Menu</a>
                        </li>
                        <li>
                            <a href="index.php?f=product&file=main&id=<?php echo $categories_id?>"><?php echo $categories_name;?></a>
                        </li>
                        <li>
                            <p><?php echo $row['name'];?></p>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- main-details-products  -->
<main>
    <form action="process.php?id=<?php echo $row['id']; ?>&action=add" method="post">
        <div class="area-products">
            <div class="area-products__image">
                <img src="./Admin/images/products/<?php echo $row['url']; ?>" alt="<?php echo $row['url']; ?>">
            </div>
            <div class="area-products__info">
                <h2><?php echo $row['name']; ?></h2>
                <div class="area-products__info--card">
                    <div class="area-products__info--money">
                        <span class="new">$ <?php echo $row['price']; ?></span>
                    </div>
                    <div class="area-products__info--available d-flex flex-wrap align-content-center">
                        <div class="name">Category :</div>
                        <span><?php echo $categories_name;?></span>
                    </div>
                    <div class="area-products__info--available d-flex flex-wrap align-content-center">
                        <div class="name">Availability :</div>
                        <span><?php echo $row['count']; ?> left in stock</span>
                    </div>
                    <!-- <div class="area-products__info--size d-flex flex-wrap align-content-center" id="option">
                        <div class="size">Size:</div>
                        <div class="s">
                            <input type="radio" name="size" id="" value="s" checked>
                            <label for="">S</label>
                        </div>
                        <div class="m">
                            <input type="radio" name="size" id="" value="m">
                            <label for="">M</label>
                        </div>
                        <div class="l">
                            <input type="radio" name="size" id="" value="l">
                            <label for="">L</label>
                        </div>
                    </div> -->
                    <div class="area-products__info--cart-btn">
                        <div class="number-count">
                            <input id="quantity" name="quantity" class="text-center" type="number" value="1" min="1" max="10">
                        </div>
                        <div>
                            <button type="submit" class="">ADD TO CART</button>
                        </div>
                    </div>
                    <!-- <div class="area-products__info--buy-btn">
                        <input type="text" value="">
                        <button onclick="buyBtn()">Buy it now</button>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="area-description">
            <div class="area-description__text">
                <span>Description</span>
                <p><?php echo $row['description']; ?></p>
            </div>
        </div>

    </form>
</main>

<script>
    $(document).ready(function(){
        $('#option label').on('click', function(){
            $('input').removeClass('checked').addClass('checked');
        });
    });
</script>