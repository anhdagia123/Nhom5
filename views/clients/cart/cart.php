<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="cart-container">
    <h1>Giỏ hàng của bạn</h1>

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
                $total = 0; 
                foreach($carts as $stt => $cart) : 
                    $id = $cart['id'] ?? $stt;
                    $quantity = isset($cart['quantity']) ? (int)$cart['quantity'] : 1;
                    $price = isset($cart['price']) ? (float)$cart['price'] : 0;
                    $name = isset($cart['name']) ? htmlspecialchars($cart['name']) : 'Không xác định';
                    $image = isset($cart['image']) ? htmlspecialchars($cart['image']) : '';
                    $subtotal = $price * $quantity;
                    $total += $subtotal;
                ?>
                <tr>
                    <th scope="row"><?= $stt + 1 ?></th>
                    <td>
                        <?php if($image): ?>
                            <img src="<?= $image ?>" alt="<?= $name ?>" width="60">
                        <?php else: ?>
                            <span>Không có hình</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $name ?></td>
                    <td><?= number_format($price, 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <input type="number" name="quantity[<?= $id ?>]" value="<?= $quantity ?>" min="1">
                    </td>
                    <td><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</td>
                    <td>
                        <a href="<?= ROOT_URL . '?ctl=delete-cart&id=' . $id ?>">Xóa</a>
                    </td>
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
