<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="checkout-container">
    <h1>Thông tin thanh toán</h1>

    <form action="<?= ROOT_URL . '?ctl=checkout' ?>" method="POST">
        <div class="checkout-wrapper">
            <!-- Thông tin người nhận -->
            <div class="customer-info">
                <h2 class="section-title blue">Thông tin người nhận</h2>

                <label>Họ và tên</label>
                <input type="text" name="fullname" value="<?= $user['fullname'] ?? '' ?>" required>

                <label>Số điện thoại</label>
                <input type="tel" name="phone" value="<?= $user['phone'] ?? '' ?>" required>

                <label>Email</label>
                <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" required>

                <label>Địa chỉ giao hàng</label>
                <textarea name="address" rows="4" placeholder="Nhập địa chỉ giao hàng" required></textarea>

                <input type="hidden" name="id" value="<?= $user['id'] ?? '' ?>">
            </div>

            <!-- Thông tin giỏ hàng -->
            <div class="order-summary">
                <h2 class="section-title cyan">Thông tin giỏ hàng</h2>

                <?php
                $total = 0;
                foreach ($carts as $item):
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                ?>
                <div class="item">
                    <div>
                        <strong><?= $item['name'] ?></strong><br>
                        Số lượng: <?= $item['quantity'] ?>
                    </div>
                    <div><?= number_format($subtotal) ?> VNĐ</div>
                </div>
                <?php endforeach; ?>

                <div class="total">
                    <strong>Tổng tiền:</strong> <span class="price"><?= number_format($total) ?> VNĐ</span>
                </div>
                <input type="hidden" name="id" value="<?= $user['id']?>">
            </div>
        </div>

        <!-- Phương thức thanh toán -->
        <div class="payment-method">
            <h2 class="section-title grey">Phương thức thanh toán</h2>

            <label>
                <input type="radio" name="payment" value="cod" checked>
                Thanh toán khi giao hàng (COD)
            </label><br>

            <label>
                <input type="radio" name="payment" value="bank">
                Chuyển khoản ngân hàng
            </label><br>

            <label>
                <input type="radio" name="payment" value="momo">
                Ví điện tử Momo
            </label><br>

            <label>
                <input type="radio" name="payment" value="zalo">
                Ví điện tử ZaloPay
            </label><br>

            <label>
                <input type="radio" name="payment" value="card">
                Thanh toán qua thẻ (ATM / Visa / MasterCard)
            </label>
        </div>

        <!-- Nút đặt hàng -->
        <div class="submit-order">
            <button type="submit" class="btn-green">Xác nhận đặt hàng</button>
        </div>
    </form>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>
