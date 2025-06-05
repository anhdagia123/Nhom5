<?php

class OrderController {
    public function index() {
        $orders = (new Order)->all(); // Đổi $order -> $orders
        return view("admin.orders.list", compact('orders')); // Truyền đúng biến
    }
}
