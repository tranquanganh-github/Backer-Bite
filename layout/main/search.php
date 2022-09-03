<?php
$results = !empty($_SESSION['search']) ? $_SESSION['search'] : [];
$row = count($results);
?>

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
                            <p>Search</p>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Search -->
<main>
    <div class="shop-area pt-95 pb-100 section-padding-3 search-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h4 class="text-center page-search-title">
                            Search for products on our store
                        </h4>
                        <div class="page-search-bar">
                            <form action="searchProcess.php" method="get">
                                <input type="search" name="key" placeholder="Search our store" autocomplete="off">
                                <button type="submit">
                                    <span class="fallback-text">
                                        Search
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="shop-bottom-area mt-95">
                        <div class="tab-content">
                            <div class="shop-list-wrap mb-30">
                                <?php
                                if ($row != 0) {
                                    foreach ($results as $item) { ?>
                                        <div class="row product-card">
                                            <div class="col-lg-4 col-md-4 product-list-img">
                                                <a href="index.php?f=product&file=detail&id=<?php echo $item['id']; ?>">
                                                    <img src="./Admin/images/products/<?php echo $item['url']; ?>">
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-8 align-self product-list-content">
                                                <a href="index.php?f=product&file=detail&id=<?php echo $item['id']; ?>"><h2><?php echo $item['name']; ?></h2></a>
                                                <div class="product-list-content-price">
                                                    <span class="new">$ <?php echo $item['price']; ?></span>
                                                </div>
                                                <div class="product-list-content-description">
                                                    <span>Description :</span>
                                                    <p><?php echo $item['description']; ?></p>
                                                </div>
                                                <div class=" d-flex flex-wrap align-content-center product-list-content-availability">
                                                    <div class="name">Availability :</div>
                                                    <span><?php echo $item['count']; ?> left in stock</span>
                                                </div>
                                                <br>
                                                <br>
                                                <div class="product-list-content-add-to-cart">
                                                    <a id="add-to-cart" href="process.php?id=<?php echo $row['id']; ?>&action=add">
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                }; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>