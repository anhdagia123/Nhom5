<?php

class HomeController {
    public function index() {
        $product = new Product();
        $shirts = $product->listProductInCategoryHome(1);

     

        $trousers = $product->listProductInCategoryHome(6); // Bỏ dòng này khi dùng dữ liệu mẫu

        $bestSellers = $product->listProductInCategoryHome(7);
        $categories= (new Category)->all();

        $title = "Trang chu ban quan ao ";

        return view("clients.home",compact('shirts','trousers','title','bestSellers','categories'));
    }
    
}
