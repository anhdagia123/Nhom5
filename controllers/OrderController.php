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
}
