<?php
class AdminOrderController {

    public function __construct() {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            return header("location:" . ROOT_URL);
        }
    }

    // Hiển thị danh sách đơn hàng
    public function index() {
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $limit = 5;
    $offset = ($page - 1) * $limit;
    $orders = (new OrderModel)->all($limit, $offset);
    $totalOrders = (new OrderModel)->countAll();
    $totalPages = ceil($totalOrders / $limit);
    $message = session_flash('message');
    return view('admin.orders.list', compact('orders', 'message', 'page', 'totalPages'));
}

    // Trang chi tiết đơn hàng
    public function detail() {
        $id = $_GET['id'];
        $order = (new OrderModel)->find($id);
        $orderDetails = (new OrderModel)->getOrderDetails($id);
        $statusText = ['Chờ xác nhận', 'Đang xử lý', 'Đang giao hàng', 'Đã giao thành công'];
        return view('admin.orders.detail', compact('order', 'orderDetails', 'statusText'));
    }

    // Cập nhật trạng thái đơn hàng qua AJAX
   public function updateOrderStatus() {
    $id = (int)($_POST['id'] ?? 0);
    $status = (int)($_POST['status'] ?? 0);

    $order = (new OrderModel)->find($id);
    if (!$order) {
        echo json_encode(['success' => false, 'message' => 'Không tìm thấy đơn hàng!']);
        exit;
    }
    if ($status < $order['status']) {
        echo json_encode(['success' => false, 'message' => 'Không thể quay lại trạng thái trước đó!']);
        exit;
    }
    // Không cho phép admin cập nhật trực tiếp lên trạng thái 3
    if ($status == 3) {
        echo json_encode(['success' => false, 'message' => 'Trạng thái "Đã giao thành công" chỉ được cập nhật khi khách xác nhận đã nhận hàng!']);
        exit;
    }
    (new OrderModel)->updateStatus($id, $status);
    echo json_encode(['success' => true]);
    exit;
}

    // Xóa đơn hàng
    public function delete() {
        $id = $_GET['id'];
        (new OrderModel)->delete($id);
        $_SESSION['message'] = 'Xóa đơn hàng thành công';
        header('Location: ' . ADMIN_URL . '?ctl=list-order');
        die;
    }
}