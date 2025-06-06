<?php
class ProductController
{

    // Hiển thị danh sách sản phẩm theo danh mục
    public function list()
    {
        $id = $_GET['id'];
        $product = (new Product)->listProductInCategory($id);
        $category_name = (new Category)->find($id)['cate_name'];
        $categories = (new Category)->all();
        $title = $category_name;
        require ROOT_DIR . 'views/clients/product/list.php';
    }

    // Hiển thị chi tiết sản phẩm và xử lý bình luận
    public function show()
    {
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        if (!$product) {
            header("Location: ?ctl=404");
            exit;
        }
        $title = $product['name'];
        $categories = (new Category)->all();
        $productReleads = (new Product)->listProductRelead($product['category_id'], $id);

        // Lưu thông tin liên quan
        $_SESSION['URI'] = $_SERVER['REQUEST_URI'];
        $_SESSION['totalQuantity'] = (new CartController)->totalSumQuantity();

        // Xử lý bình luận gửi lên
        $commentError = '';
        $commentModel = new CommentModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
            if (isset($_SESSION['user'])) {
                $userId = $_SESSION['user']['id'];
                $content = trim($_POST['comment']);
                if ($commentModel->hasPurchased($userId, $id) && $content) {
                    $commentModel->create([
                        'user_id' => $userId,
                        'product_id' => $id,
                        'content' => $content
                    ]);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit;
                } else {
                    $commentError = "Bạn chưa mua sản phẩm này hoặc nội dung bình luận trống.";
                }
            } else {
                $commentError = "Bạn cần đăng nhập để bình luận.";
            }
        }

        // Xác định quyền bình luận
        $canComment = false;
        if (isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
            $canComment = $commentModel->hasPurchased($userId, $id);
        }
        $comments = $commentModel->getByProduct($id);

        require ROOT_DIR . 'views/clients/product/detail.php';
    }

    // Các phương thức khác...
}