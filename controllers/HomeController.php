<?php
class HomeController
{
    public function index()
    {
        $product = new Product();
        $categories = (new Category)->all();
        $title = "Trang chu ban quan ao";

        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

        if ($searchTerm !== '') {
            // Nếu có tìm kiếm
            $searchResults = $product->searchByName($searchTerm);
            // Ở trường hợp này, không lấy danh mục áo, quần, best sellers nữa
            return view("clients.home", compact('searchResults', 'categories', 'title', 'searchTerm'));
        } else {
            // Trường hợp bình thường, load danh mục sản phẩm mặc định
            $shirts = $product->listProductInCategoryHome(1);
            $trousers = $product->listProductInCategoryHome(6);
            $bestSellers = $product->listProductInCategoryHome(7);
            return view("clients.home", compact('shirts', 'trousers', 'title', 'bestSellers', 'categories'));
        }
    }
  public function allProducts() {
    $product = new Product();
    $products = $product->getAll();
    $categories = (new Category)->all();
    $title = "Tất cả sản phẩm";

    return view("clients.product.all-products", compact('products', 'categories', 'title'));
}

}
