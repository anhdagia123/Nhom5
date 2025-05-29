<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="cart-container">
    <h1>Giỏ hàng của bạn</h1>

    <!-- Form gửi dữ liệu cập nhật -->
    <form action="<?= ROOT_URL ?>?ctl=update-cart" method="post">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0; // tổng tiền toàn bộ giỏ hàng
                foreach($carts as $stt => $cart) : 
                    $subtotal = $cart['price'] * $cart['quantity'];
                    $total += $subtotal;
                ?>
                <tr>
                    <th scope="row"><?= $stt + 1 ?></th>
                    <td><img src="<?= $cart['image'] ?>" alt="" width="60"></td>
                    <td><?= $cart['name'] ?></td>
                    <td><?= number_format($cart['price'], 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <input type="number" name="quantity[<?= $cart['id'] ?>]" value="<?= $cart['quantity'] ?>" min="1">
                    </td>
                    <td><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</td>
                    <td><a href="<?= ROOT_URL . '?ctl=delete-cart&id=' . $cart['id'] ?>">Xóa</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="total-label">Tổng tiền:</td>
                    <td class="total-price"><?= number_format($total, 0, ',', '.') ?> VNĐ</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <div class="cart-actions">
            <a href="<?= ROOT_URL ?>" class="btn-grey">Tiếp tục mua sắm</a>
            <div class="right-actions">
                <button type="submit" class="btn-yellow">Cập nhật giỏ hàng</button>
                <a href="<?= ROOT_URL ?>?ctl=checkout" class="btn-green">Thanh toán</a>
            </div>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>
