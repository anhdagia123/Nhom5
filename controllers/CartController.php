<?php
<?php
class CartController {
    public function addToCart() {
        $id = $_GET['id'] ?? null;

        if (!$id || !(new Product)->find($id)) {
            header("Location: " . ROOT_URL);
            exit;
        }

        $product = (new Product)->find($id);
        $carts = $_SESSION['cart'] ?? [];

        if (isset($carts[$id])) {
            $carts[$id]['quantity']++;
        } else {
            $carts[$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1,
                'image' => $product['image']
            ];
        }

        $_SESSION['cart'] = $carts;

        $url = $_SESSION['URI'] ?? (ROOT_URL . "?ctl=view-cart");
        header("Location: " . $url);
        exit;
    }

    public function updateCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantity'])) {
            $carts = $_SESSION['cart'] ?? [];

            foreach ($_POST['quantity'] as $id => $qty) {
                $id = (int)$id;
                $qty = (int)$qty;
                if (isset($carts[$id])) {
                    $carts[$id]['quantity'] = max(1, $qty);
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
                'status' => 1,
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

