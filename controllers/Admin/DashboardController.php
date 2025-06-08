<?php
class DashboardController
{
    protected $dashboardModel;

    public function __construct()
    {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            return header("location:" . ROOT_URL);
        }
        $this->dashboardModel = new DashboardModel();
    }

    private function validateDate($date)
    {
        // Chỉ chấp nhận định dạng 'Y-m-d'
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    public function index()
{
    $from = $_GET['from'] ?? date('Y-m-01');
    $to = $_GET['to'] ?? date('Y-m-d');



    // Kiểm tra định dạng ngày
    if (!$this->validateDate($from) || !$this->validateDate($to)) {
        $from = date('Y-m-01');
        $to = date('Y-m-d');
    }

   if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $revenueDataRaw = $this->dashboardModel->getRevenueByDate($from, $to);
    $revenueByWeekday = $this->dashboardModel->getRevenueByWeekday($from, $to);

    $fullDates = $this->getDateRange($from, $to);
    $mappedRevenue = [];

    // Map raw data thành ['Y-m-d' => revenue]
    $revenueMap = [];
    foreach ($revenueDataRaw as $item) {
        $revenueMap[$item['date']] = (float) $item['revenue'];
    }

    // Fill missing days = 0
    foreach ($fullDates as $date) {
        $mappedRevenue[] = $revenueMap[$date] ?? 0;
    }

    $response = [
        'revenueLabels' => $fullDates,
        'revenueData' => $mappedRevenue,
        'weekdayData' => $revenueByWeekday,
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}


    $topProducts = $this->dashboardModel->getTopProducts();
    $topStock = $this->dashboardModel->getTopStock();
    $topCustomers = $this->dashboardModel->getTopCustomers();
    $newOrders = $this->dashboardModel->getNewOrders();
    $productSoldByWeek = $this->dashboardModel->getProductSoldByWeek($from, $to);
    $revenueData = $this->dashboardModel->getRevenueByDate($from, $to);
    $revenueByWeekday = $this->dashboardModel->getRevenueByWeekday($from, $to);
    
    return view('admin.dashboard', compact(
        'topProducts', 'topStock', 'topCustomers', 'newOrders', 
        'revenueData', 'from', 'to', 'productSoldByWeek', 'revenueByWeekday'
    ));
}
 // Xem chi tiết đơn hàng
    public function detail()
    {
        $id = $_GET['id'] ?? 0;
        if (!$id) {
            return die("Thiếu ID đơn hàng");
        }

        $order = (new OrderModel)->find($id);
        $orderDetails = (new OrderModel)->getOrderDetails($id);
        $statusText = ['Chờ xác nhận', 'Đang xử lý', 'Đang giao hàng', 'Đã giao thành công'];

        if (!$order) {
            return die("Đơn hàng không tồn tại");
        }

        return view('admin.orders.detailDashboard', compact('order', 'orderDetails', 'statusText'));
    }
    private function getDateRange($from, $to)
{
    $range = [];
    $start = new DateTime($from);
    $end = new DateTime($to);

    while ($start <= $end) {
        $range[] = $start->format('Y-m-d');
        $start->modify('+1 day');
    }

    return $range;
}

     // Cập nhật trạng thái đơn hàng qua AJAX
    public function updateOrderStatus()
    {
        $id = (int)($_POST['id'] ?? 0);
        $status = (int)($_POST['status'] ?? 0);

        $orderModel = new OrderModel;
        $order = $orderModel->find($id);

        if (!$order) {
            echo json_encode(['success' => false, 'message' => 'Không tìm thấy đơn hàng!']);
            exit;
        }

        if ($status < $order['status']) {
            echo json_encode(['success' => false, 'message' => 'Không thể quay lại trạng thái trước đó!']);
            exit;
        }

        $orderModel->updateStatus($id, $status);
        echo json_encode(['success' => true]);
        exit;
    }

}
