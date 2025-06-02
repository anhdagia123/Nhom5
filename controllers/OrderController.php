<?php

class OrderController{
    public function index(){
        $order = (new Order)->all();
        return view("admin.orders.list", compact('orders'));
    }
}