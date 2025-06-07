
<?php include_once ROOT_DIR . "views/clients/header.php"; ?>


<main class="container my-5">
    <section class="row justify-content-center">
        <div class="col-lg-10">
            <article class="card shadow border-0">
                <header class="card-header bg-primary text-white text-center">
                    <h1 class="h3 mb-0">Thông tin thanh toán</h1>
                </header>
                <div class="card-body">
                    <?php if (!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= ROOT_URL . '?ctl=checkout' ?>" method="POST" autocomplete="on">
                        <div class="row g-4">
                            <!-- Thông tin người nhận -->
                            <div class="col-md-6">
                                <h2 class="h5 text-primary mb-3">Thông tin người nhận</h2>
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Họ và tên</label>
                                    <input type="text" id="fullname" name="fullname" class="form-control" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="tel" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                    <textarea id="address" name="address" class="form-control" rows="4" required><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                                </div>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($user['id'] ?? '') ?>">
                            </div>

                            <!-- Thông tin giỏ hàng -->
                            <div class="col-md-6">
                                <h2 class="h5 text-success mb-3">Thông tin giỏ hàng</h2>
                                <ul class="list-group mb-3">
                                    <?php
                                    $total = 0;
                                    foreach ($carts as $item):
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total += $subtotal;
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-semibold"><?= htmlspecialchars($item['name']) ?></span>
                                            <div class="small text-muted">Số lượng: <?= $item['quantity'] ?></div>
                                        </div>
                                        <span><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</span>
                                    </li>
                                    <?php endforeach; ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                                        <strong>Tổng tiền:</strong>
                                        <span class="text-danger fw-bold"><?= number_format($total, 0, ',', '.') ?> VNĐ</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Phương thức thanh toán -->
                        <section class="mt-4">
                            <h2 class="h5 text-secondary mb-3">Phương thức thanh toán</h2>
                            <div class="row row-cols-1 row-cols-md-3 g-2">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="cod" id="cod" checked>
                                        <label class="form-check-label" for="cod">Thanh toán khi giao hàng (COD)</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="bank" id="bank">
                                        <label class="form-check-label" for="bank">Chuyển khoản ngân hàng</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="momo" id="momo">
                                        <label class="form-check-label" for="momo">Ví điện tử Momo</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="zalo" id="zalo">
                                        <label class="form-check-label" for="zalo">Ví điện tử ZaloPay</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment" value="card" id="card">
                                        <label class="form-check-label" for="card">Thẻ ATM / Visa / MasterCard</label>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Nút đặt hàng -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg px-5">Xác nhận đặt hàng</button>
                        </div>
                    </form>
                </div>
            </article>
        </div>
    </section>
</main>

<!-- Bootstrap JS nếu cần -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>