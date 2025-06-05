<?php 

class ProductController {
    // Hiển thị danh sách theo danh mục 
    public function list() {
        $id = $_GET['id']; // Lấy id của danh mục
        $product = (new Product)->listProductInCategory($id);
        $category_name = (new Category)->find($id)['cate_name'];
        $categories = (new Category)->all();
        $title = $category_name;

        return view('clients.product.list', compact('product', 'category_name', 'title', 'categories'));
    }

    // Chi tiết sản phẩm 
    public function show() {
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        $title = $product['name'];
        $categories = (new Category)->all();
        $productReleads = (new Product)->listProductRelead($product['category_id'], $id);

        // Lưu thông tin liên quan để quay lại giỏ hàng hoặc nơi trước đó
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];

        // Tính tổng số lượng sản phẩm trong giỏ
        $_SESSION['totalQuantity'] = (new CartController)->totalSumQuantity();

        return view('clients.product.detail', compact('product', 'title', 'categories', 'productReleads'));
    }
}
