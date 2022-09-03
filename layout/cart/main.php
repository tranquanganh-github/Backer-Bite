<!-- breadcrumb -->
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
                            <p>Cart</p>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- main-shopping-cart  -->
<main>
    <div class="container-shopping-cart">

        <!-- table-cart-info  -->

        <div class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th class="tb-img">Image</th>
                        <th class="tb-prod">Product</th>
                        <th class="tb-pri">Price</th>
                        <th class="tb-quan">Quantity</th>
                        <th class="tb-total">Total</th>
                        <th class="tb-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($carts as $item) {
                        $total += $item['subTotal']; ?>
                        <tr>
                            <form id="" action="process.php?id=<?php echo $item['id']; ?>&action=update" method="post">
                                <td class="tb-img">
                                    <a href="index.php?f=product&file=detail&id=<?php echo $item['id']; ?>">
                                        <img src="./Admin/images/products/<?php echo $item['url']; ?>" alt="<?php echo $item['url']; ?>">
                                    </a>
                                </td>
                                <td class="tb-prod">
                                    <a href="index.php?f=product&file=detail&id=<?php echo $item['id']; ?>">
                                        <span><?php echo $item['name']; ?></span>
                                    </a>
                                </td>
                                <td class="tb-pri">
                                    $ <?php echo $item['price']; ?>
                                </td>
                                <td class="tb-quan">
                                    <input name="quantity" type="number" class="text-center" min="1" max="10" value="<?php echo $item['quantity']; ?>" style="width: 60px;">
                                </td>
                                <td class="tb-total sub-total">
                                    $ <?php echo $item['subTotal']; ?>
                                </td>
                                <td class="tb-remove">
                                    <button type="submit" onclick="addFunction(<?php echo $item['id']; ?>)">
                                        <i class="fa-solid fa-wrench"></i>
                                    </button>
                                    <br>
                                    <a href="process.php?id=<?php echo $item['id']; ?>&action=remove" onclick="return confirm('Delete this?');">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                </td>
                            </form>
                        </tr>
                    <?php }; ?>
                </tbody>
            </table>
        </div>

        <!-- button-action  -->

        <div class="cart-btn">
            <div class="cart-btn__continue">
                <a href="index.php?f=product&file=allitem">CONTINUE SHOPPING</a>
            </div>
            <div>
                <a href="process.php?&action=clear" onclick="return confirm('Delete all item in cart?');">CLEAR CART</a>
            </div>
        </div>

        <!-- cart-payment  -->

        <div class="cart-payment">
            <div class="cart-payment__main">
                <div class="cart-payment__main--col-left">
                    <!-- <div class="delivery">
                                <label for="">Phone number:<input type="text"></label>
                                <label for="">Address:<input type="text"></label>

                            </div> -->
                    <div class="special">
                        <h3>Special instructions for seller</h3>
                        <textarea name="" id=""></textarea>
                    </div>
                </div>
                <div class="cart-payment__main--col-right">
                    <div>
                        <h3>Cart Totals</h3>
                        <table>
                            <tbody>
                                <!-- <tr>
                                            <th>Subtotal
                                            <td>
                                                <span>$110.00</span>
                                            </td>
                                            </th>
                                        </tr> -->
                                <tr>
                                    <th>Total
                                    <td>
                                        <span>$ <?php echo $total; ?></span>
                                    </td>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <a href="index.php?f=cart&file=checkout&totalPrice=<?php echo $total; ?>">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>