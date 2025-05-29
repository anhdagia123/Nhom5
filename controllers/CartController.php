<?php

class CartController {
    public function addToCart(){
        //Tạo gỏ hàng
        $carts = $_SESSION['carts'] ?? [];
        // Lấy sản phẩm theo id vào gỏ hàng
        $id = $_GET['id'];
        $product = (new Product)->find($id);
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
        // Lưu gỏ hàng vào session
        $_SESSION['carts'] = $carts;
        
        $url = $_SESSION['URI'] ?? '/';

        return header("Location:"  .$url);
    }

    // Tính tổng số lượng sản phẩm để hiển thị giỏ hàng
    public function totalSumQuantity() {
        $carts = $_SESSION['carts'] ?? [];
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }
        return $totalQuantity;
    }
    public function viewCart() {
        $carts = $_SESSION['carts'] ?? [];
        $sumPrice = (new CartController)->sumPrice();
        $categories = (new Category)->all();
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart['price'] * $cart['quantity'];
        }
        return view('clients.cart.cart', compact('carts', 'totalPrice', 'categories', 'sumPrice'));
    }
    public function sumPrice(){
        $carts = $_SESSION['carts'] ?? [];
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'] * $cart['price'];
        }
        return $totalQuantity;
    }
    public function deleteCart() {
    $id = $_GET['id'] ?? null;

    if ($id && isset($_SESSION['carts'][$id])) {
        unset($_SESSION['carts'][$id]);
    }

    // Quay lại trang giỏ hàng
    header("Location: ?ctl=view-cart");
    exit;
}
    public function updateCart() {
    if (!isset($_POST['quantity'])) {
        return header("Location: " . ROOT_URL . "?ctl=view-cart");
    }

    $carts = $_SESSION['carts'] ?? [];

    foreach ($_POST['quantity'] as $id => $qty) {
        if (isset($carts[$id])) {
            $qty = (int)$qty;
            $carts[$id]['quantity'] = max(1, $qty); // đảm bảo không nhỏ hơn 1
        }
    }

    $_SESSION['carts'] = $carts;

    return header("Location: " . ROOT_URL . "?ctl=view-cart");
}


}