<?php
class CartController {
     public function addToCart() {
        $id = $_GET['id'] ?? null;
        $isAjax = isset($_GET['ajax']) && $_GET['ajax'] == 1;

        if (!$id || !(new Product)->find($id)) {
            if ($isAjax) {
                echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
                exit;
            }
            header("Location: " . ROOT_URL);
            exit;
        }

        $product = (new Product)->find($id);
        $carts = $_SESSION['cart'] ?? [];
        $currentQty = $carts[$id]['quantity'] ?? 0;

        // Validate số lượng
        if ($product['quantity'] <= 0 || $currentQty >= $product['quantity']) {
            if ($isAjax) {
                echo json_encode(['success' => false, 'message' => 'Số lượng sản phẩm không đủ']);
                exit;
            }
            $_SESSION['error'] = 'Số lượng sản phẩm không đủ';
            header("Location: " . ROOT_URL . "?ctl=detail&id=" . $id);
            exit;
        }

        // Trừ tồn kho khi thêm vào giỏ
        (new Product)->updateQuantity($id, $product['quantity'] - 1);

        if (isset($carts[$id])) {
            $carts[$id]['quantity']++;
        } else {
            $carts[$id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['image']
            ];
        }

        $_SESSION['cart'] = $carts;

        // Lấy lại số lượng tồn kho mới
        $productNew = (new Product)->find($id);
        $remain = $productNew['quantity'];

        if ($isAjax) {
            echo json_encode([
                'success' => true,
                'message' => 'Đã thêm vào giỏ hàng!',
                'remain' => $remain
            ]);
            exit;
        }

        header("Location: " . ROOT_URL . "?ctl=view-cart");
        exit;
    }

    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
            $carts = $_SESSION['cart'] ?? [];

            foreach ($_POST['quantity'] as $id => $qty) {
                $id = (int)$id;
                $qty = (int)$qty;
                if (isset($carts[$id])) {
                    $oldQty = $carts[$id]['quantity'];
                    $product = (new Product)->find($id);
                    $stock = $product['quantity'];

                    // Nếu tăng số lượng
                    if ($qty > $oldQty) {
                        $diff = $qty - $oldQty;
                        if ($stock >= $diff) {
                            (new Product)->updateQuantity($id, $stock - $diff);
                            $carts[$id]['quantity'] = $qty;
                        } else {
                            $_SESSION['error'] = 'Không đủ hàng trong kho cho sản phẩm ' . $carts[$id]['name'];
                        }
                    }
                    // Nếu giảm số lượng
                    elseif ($qty < $oldQty) {
                        $diff = $oldQty - $qty;
                        (new Product)->updateQuantity($id, $stock + $diff);
                        $carts[$id]['quantity'] = max(1, $qty);
                    }
                }
            }

            $_SESSION['cart'] = $carts;
        }

        header("Location: " . ROOT_URL . "?ctl=view-cart");
        exit;
    }

    public function deleteCart() {
        $id = $_GET['id'] ?? null;
        if ($id && isset($_SESSION['cart'][$id])) {
            // Cộng lại tồn kho khi xóa khỏi giỏ
            $qty = $_SESSION['cart'][$id]['quantity'];
            $product = (new Product)->find($id);
            if ($product) {
                (new Product)->updateQuantity($id, $product['quantity'] + $qty);
            }
            unset($_SESSION['cart'][$id]);
        }

        header("Location: " . ROOT_URL . "?ctl=view-cart");
        exit;
    }

    public function viewCart() {
        $carts = $_SESSION['cart'] ?? [];
        $categories = (new Category)->all();
        $sumPrice = $this->sumPrice();
        $totalPrice = 0;

        foreach ($carts as $cart) {
            $totalPrice += $cart['price'] * $cart['quantity'];
        }

        return view('clients.cart.cart', compact('carts', 'totalPrice', 'categories', 'sumPrice'));
    }

    public function sumPrice() {
        $carts = $_SESSION['cart'] ?? [];
        $sum = 0;

        foreach ($carts as $cart) {
            $sum += $cart['quantity'] * $cart['price'];
        }

        return $sum;
    }

    public function totalSumQuantity() {
        $carts = $_SESSION['cart'] ?? [];
        $totalQuantity = 0;

        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }

        return $totalQuantity;
    }

    public function viewCheckout() {
        if (!isset($_SESSION['user'])) {
            header("Location: " . ROOT_URL . "?ctl=login");
            exit;
        }

        $user = $_SESSION['user'];
        $carts = $_SESSION['cart'] ?? [];
        $sumPrice = $this->sumPrice();

        return view('clients.cart.checkout', compact('user', 'carts', 'sumPrice'));
    }

    public function checkOut() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = ['id', 'fullname', 'phone', 'address', 'payment'];

            foreach ($required as $key) {
                if (empty($_POST[$key])) {
                    $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin.";
                    header("Location: " . ROOT_URL . "?ctl=view-checkout");
                    exit;
                }
            }

            $user = [
                'id' => $_POST['id'],
                'fullname' => $_POST['fullname'],
                'phone' => $_POST['phone'],
                'address' => $_POST['address'],
                'role' => $_SESSION['user']['role'] ?? 'user',
                'active' => $_SESSION['user']['active'] ?? 1,
            ];

            $sumPrice = $this->sumPrice();

            $order = [
                'user_id' => $user['id'],
                'payment_method' => $_POST['payment'],
                'status' => 0,
                'total_price' => $sumPrice,
            ];

            (new User)->update($user['id'], $user);
            $order_id = (new Order)->create($order);

            $carts = $_SESSION['cart'] ?? [];

            foreach ($carts as $id => $cart) {
                $orderDetail = [
                    'order_id' => $order_id,
                    'product_id' => $id,
                    'price' => $cart['price'],
                    'quantity' => $cart['quantity'],
                ];

                (new Order)->createOrderDetail($orderDetail);
            }

            $this->clearCart();
            header("Location: " . ROOT_URL . "?ctl=success");
            exit;
        }

        header("Location: " . ROOT_URL . "?ctl=view-checkout");
        exit;
    }

    public function clearCart() {
        unset($_SESSION['cart'], $_SESSION['totalQuantity'], $_SESSION['URI']);
    }

    public function success() {
        return view("clients.cart.success");
    }
    
}