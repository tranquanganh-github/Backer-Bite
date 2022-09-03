<?php
$id = intval($_GET['id']);
$limit = !empty($_GET['Limit']) ? intval($_GET['Limit']) : 9;
$sort = !empty($_GET['SortBy']) ? $_GET['SortBy'] : "ASC";
$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;
$sql = "SELECT * FROM products WHERE categoriesId = $id";
if($sort == "ASC"){
    $sql .= " ORDER BY name ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count_allitem = $statement->rowCount();
    $totalPage = ceil($count_allitem / $limit);
    $sql .= " LIMIT :offset, :limit";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->execute();
    $all_items = $statement->fetchAll();
}
if($sort == "DESC"){
    $sql .= " ORDER BY name DESC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count_allitem = $statement->rowCount();
    $totalPage = ceil($count_allitem / $limit);
    $sql .= " LIMIT :offset, :limit";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->execute();
    $all_items = $statement->fetchAll();
}
if($sort == "PLtH"){
    $sql .= " ORDER BY price ASC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count_allitem = $statement->rowCount();
    $totalPage = ceil($count_allitem / $limit);
    $sql .= " LIMIT :offset, :limit";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->execute();
    $all_items = $statement->fetchAll();
}
if($sort == "PHtL"){
    $sql .= " ORDER BY price DESC";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count_allitem = $statement->rowCount();
    $totalPage = ceil($count_allitem / $limit);
    $sql .= " LIMIT :offset, :limit";
    $statement = $conn->prepare($sql);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->execute();
    $all_items = $statement->fetchAll();
}

$sql_select_categories = "SELECT * FROM categories";
$statement_select_categories = $conn->prepare($sql_select_categories);
$statement_select_categories->execute();
$menu_categories = $statement_select_categories->fetchAll();

$sql_categories = "SELECT * FROM categories WHERE categoriesID = $id";
$categories = $conn->query($sql_categories)->fetch(PDO::FETCH_ASSOC);
$categories_name = $categories['categoriesName'];

?>
<input id="id" value="<?php echo $id;?>" hidden>
<input id="page" value="<?php echo ($page - 1);?>" hidden>
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
                            <p><?php echo $categories_name?></p>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main products -->
<main>
    <div class="products-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 left-products">
                    <aside class="slidebar-menu">
                        <ul>
                            <li>
                                <a class="all-menu" href="index.php?f=product&file=menu" style="padding-left: 0;">
                                    Menu
                                </a>
                            </li>
                            <?php foreach ($menu_categories as $row) { ?>
                                <li>
                                    <a href="index.php?f=product&file=main&id=<?php echo $row['categoriesID']; ?>" class="<?= $row['categoriesID'] == $id ? 'active' :'';?>">
                                        <?php echo $row['categoriesName']; ?>
                                    </a>
                                </li>
                            <?php }; ?>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-9">
                    <div class="container-sort">
                        <div class="select-show">
                            <label for="">Sort by :</label>
                            <select name="" id="SortBy" class="select-sort" onChange="upDateSort()">
                                <option value="ASC" <?= $sort == "ASC" ? 'selected' : ''; ?>>Alphabetically, A-Z</option>
                                <option value="DESC" <?= $sort == "DESC" ? 'selected' : ''; ?>>Alphabetically, Z-A</option>
                                <option value="PLtH" <?= $sort == "PLtH" ? 'selected' : ''; ?>>Price, Low to High</option>
                                <option value="PHtL" <?= $sort == "PHtL" ? 'selected' : ''; ?>>Price, High to Low</option>
                            </select>
                        </div>
                        <div class="select-limit-card d-flex">
                            <label>Showing 1 - <?php echo $limit; ?> of <?php echo $count_allitem; ?> result</label>
                            <div>
                                <label for="">Show :</label>
                                <select name="" id="Limit" class="select-limit" onChange="upDateLimit()">
                                    <option value="1" <?= $limit == 1 ? 'selected' : ''; ?>>1</option>
                                    <option value="2" <?= $limit == 2 ? 'selected' : ''; ?>>2</option>
                                    <option value="3" <?= $limit == 3 ? 'selected' : ''; ?>>3</option>
                                    <option value="4" <?= $limit == 4 ? 'selected' : ''; ?>>4</option>
                                    <option value="5" <?= $limit == 5 ? 'selected' : ''; ?>>5</option>
                                    <option value="6" <?= $limit == 6 ? 'selected' : ''; ?>>6</option>
                                    <option value="7" <?= $limit == 7 ? 'selected' : ''; ?>>7</option>
                                    <option value="8" <?= $limit == 8 ? 'selected' : ''; ?>>8</option>
                                    <option value="9" <?= $limit == 9 ? 'selected' : ''; ?>>9</option>
                                    <option value="10" <?= $limit == 10 ? 'selected' : ''; ?>>10</option>
                                    <option value="11" <?= $limit == 11 ? 'selected' : ''; ?>>11</option>
                                    <option value="12" <?= $limit == 12 ? 'selected' : ''; ?>>12</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="container-card">
                        <?php foreach ($all_items as $row) { ?>
                            <div class="container-card-padding">
                                <div class="contaiber-card-margin-bottom">
                                    <div class="card-content">
                                        <div class="card-content__image">
                                            <a href="index.php?f=product&file=detail&id=<?php echo $row['id']; ?>">
                                                <img src="./Admin/images/products/<?php echo $row['url']; ?>" alt="<?php echo $row['url'] ?>">
                                            </a>
                                        </div>
                                        <div class="card-sub-content">
                                            <div class="card-content__product">
                                                <div class="card-content__product--name">
                                                    <h4>
                                                        <a href="index.php?f=product&file=detail&id=<?php echo $row['id']; ?>"><?php echo $row['name'] ?></a>
                                                    </h4>
                                                </div>
                                                <div class="card-content__product--price">
                                                    <span class="new">$<?php echo $row['price'] ?></span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="card-content__product--cart">
                                                    <a id="add-to-cart" href="process.php?id=<?php echo $row['id']; ?>&action=add">
                                                        Add to cart
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pagination">
                        <nav class="d-flex justify-content-center">
                            <ul class="pagination">
                                <li class="page-item <?php echo $page == 1 ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="index.php?f=product&file=allitem&page=<?php echo $page - 1; ?>">Previous</a>
                                </li>
                                <?php for ($i = 1; $i <= $totalPage; $i++) { ?>
                                    <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                                        <a class="page-link" href="index.php?f=product&file=allitem&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php } ?>
                                <li class="page-item <?php echo $page == $totalPage ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="index.php?f=product&file=allitem&page=<?php echo $page + 1; ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- end main product -->