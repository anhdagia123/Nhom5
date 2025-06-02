<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Product.php';
class CartController {
    public function addToCart(){
        //Tạo gỏ hàng
        $carts = $_SESSION['cart'] ?? [];
        // Lấy sản phẩm theo id vào gỏ hàng
        $id = $_GET['id'];
        $product = (new Product)->find($id);
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
        // Lưu gỏ hàng vào session
        $_SESSION['cart'] = $carts;
        
        $url = $_SESSION['URI'] ?? '/';

        return header("Location:"  .$url);
    }

    // Tính tổng số lượng sản phẩm để hiển thị giỏ hàng
    public function totalSumQuantity() {
        $carts = $_SESSION['cart'] ?? [];
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'];
        }
        return $totalQuantity;
    }
    public function viewCart() {
        $carts = $_SESSION['cart'] ?? [];
        $sumPrice = (new CartController)->sumPrice();
        $categories = (new Category)->all();
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart['price'] * $cart['quantity'];
        }
        return view('clients.cart.cart', compact('carts', 'totalPrice', 'categories', 'sumPrice'));
    }
    public function sumPrice(){
        $carts = $_SESSION['cart'] ?? [];
        $totalQuantity = 0;
        foreach ($carts as $cart) {
            $totalQuantity += $cart['quantity'] * $cart['price'];
        }
        return $totalQuantity;
    }
    public function deleteCart() {
    $id = $_GET['id'] ?? null;

    if ($id && isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}


    // Quay lại trang giỏ hàng
    header("Location: ?ctl=view-cart");
    exit;
}
    public function updateCart() {
    if (!isset($_POST['quantity'])) {
        return header("Location: " . ROOT_URL . "?ctl=view-cart");
    }

    $carts = $_SESSION['cart'] ?? [];

    foreach ($_POST['quantity'] as $id => $qty) {
        if (isset($carts[$id])) {
            $qty = (int)$qty;
            $carts[$id]['quantity'] = max(1, $qty); // đảm bảo không nhỏ hơn 1
        }
    }

    $_SESSION['cart'] = $carts;

    return header("Location: " . ROOT_URL . "?ctl=view-cart");
}
    public function viewCheckout(){
        if (!isset($_SESSION['user'])) {
            return header("Location: " . ROOT_URL . "?ctl=login");
        }
        $user = $_SESSION['user'];
        $carts = $_SESSION['cart'] ?? [];
        $sumPrice   = (new CartController)->sumPrice();
        return view('clients.cart.checkout', compact('user', 'carts', 'sumPrice'));
    }
    // Thanh toán
    public function checkOut()
    {
        //lấy thông tin người dùng 
       $user = [
        'id' => $_POST['id'],
        'fullname' => $_POST['fullname'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address'],
        'role' => $_SESSION['user']['role'],
        'active' => $_SESSION['user']['active'],
       ];

       $sumPrice = (new CartController)->sumPrice();
       // lấy thông tin thanh toán
       $order = [
        'user_id' => $_POST['id'],
        'payment_method' => $_POST['payment_method'],
        'status'  => 1,
        'total_price' => $sumPrice,
        
       ];

       (new User)->update($user['id'], $user);
       $order_id = (new Order)->create($order);

      
       $carts = $_SESSION['cart'];
       foreach($carts as $id => $cart){
        $or_detail = [
            'order_id' => $order_id,
            'product_id' => $id,
            'price' => $cart['price'],
            'quantity' => $cart['quantity']
        ];
        (new Order)->createOrderDetail($or_detail);
       }
       $this->clearCart(); // Xóa thông tin giỏ hàng

       return header("Location: " . ROOT_URL . "?ctl=success");
       
    }
    // Xóa giỏ hàng
    public function clearCart(){
        unset($_SESSION['cart']);
        unset($_SESSION['totalQuantity']);
        unset($_SESSION['URL']);
    }
    public function success(){
        return view("clients.carts.success");
    }
}