<?php

class OrderController {
    public function index() {
        $orders = (new Order)->all(); // Đổi $order -> $orders
        return view("admin.orders.list", compact('orders')); // Truyền đúng biến
    }
public function myOrders() {
    if (!isset($_SESSION['user'])) {
        header("Location: " . ROOT_URL . "?ctl=login");
        exit;
    }
    $user_id = $_SESSION['user']['id'];
    $orders = (new Order)->getByUser($user_id);
    return view('clients.cart.orders', compact('orders'));
}

public function orderDetail() {
    if (!isset($_SESSION['user']) || empty($_GET['id'])) {
        header("Location: " . ROOT_URL . "?ctl=my-orders");
        exit;
    }
    $order_id = $_GET['id'];
    $order = (new Order)->find($order_id);
    $orderDetails = (new Order)->getOrderDetails($order_id);
    return view('clients.cart.order_detail', compact('order', 'orderDetails'));
}
public function confirmOrder() {
    if (!isset($_SESSION['user']) || $_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['order_id'])) {
        header("Location: " . ROOT_URL . "?ctl=my-orders");
        exit;
    }
    $order_id = (int)$_POST['order_id'];
    // Kiểm tra đơn hàng thuộc về user hiện tại
    $order = (new Order)->find($order_id);
    if ($order && $order['user_id'] == $_SESSION['user']['id'] && $order['status'] == 2) {
        (new Order)->update($order_id, 3); // 3 = Hoàn thành
        $_SESSION['message'] = "Đã xác nhận nhận hàng thành công!";
    }
    header("Location: " . ROOT_URL . "?ctl=my-orders");
    exit;
}
}
