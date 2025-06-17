<?php
class DashboardModel extends BaseModel
{
    // Top 5 sản phẩm bán chạy
   public function getTopProducts()
{
    $sql = "SELECT p.id, p.name, SUM(od.quantity) AS total_sold
            FROM order_details od
            JOIN product p ON od.product_id = p.id
            JOIN orders o ON od.order_id = o.id
            WHERE o.status = 3
            GROUP BY p.id, p.name
            ORDER BY total_sold DESC
            LIMIT 5";
    return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

    // Top 5 sản phẩm tồn kho
    public function getTopStock()
    {
        $sql = "SELECT id, name, quantity as stock  FROM product ORDER BY stock DESC LIMIT 5";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Top 5 khách hàng mua nhiều nhất
    public function getTopCustomers()
    {
        $sql = "SELECT u.id, u.fullname as name, COUNT(o.id) as total_orders
                FROM orders o
                JOIN users u ON o.user_id = u.id
                WHERE o.status = 3
                GROUP BY u.id, u.fullname
                ORDER BY total_orders DESC
                LIMIT 5";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Đơn hàng mới chờ xác nhận
    public function getNewOrders($limit = 10)
    {
        $sql = "SELECT o.*, u.fullname as customer_name
                FROM orders o
                JOIN users u ON o.user_id = u.id
                WHERE o.status = 'pending'
                ORDER BY o.created_at DESC
                LIMIT :limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  
 public function getRevenueByDate($from, $to)
{
    // Chuyển từ ngày đầu vào (có thể là '2025-06-05' hoặc '2025-06-05 12:13:22') về định dạng chuẩn có giờ phút giây
    $from = date('Y-m-d 00:00:00', strtotime($from));
    $to = date('Y-m-d 23:59:59', strtotime($to));

    $sql = "SELECT DATE(o.created_at) AS date, SUM(od.price * od.quantity) AS revenue
            FROM orders o
            JOIN order_details od ON o.id = od.order_id
            WHERE o.status = 3 AND o.created_at BETWEEN :from AND :to
            GROUP BY DATE(o.created_at)
            ORDER BY date ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        'from' => $from,
        'to' => $to
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getProductSoldByWeek($from, $to)
{
    $from = date('Y-m-d 00:00:00', strtotime($from));
    $to = date('Y-m-d 23:59:59', strtotime($to));

    $sql = "SELECT 
                YEARWEEK(o.created_at, 1) AS week,
                CONCAT('Tuần ', WEEK(o.created_at, 1), '/', YEAR(o.created_at)) AS week_label,
                DATE_FORMAT(DATE_ADD(o.created_at, INTERVAL(2 - DAYOFWEEK(o.created_at)) DAY), '%d/%m/%Y') AS week_start,
                SUM(od.price * od.quantity) AS total_revenue
            FROM orders o
            JOIN order_details od ON o.id = od.order_id
            WHERE o.status = 3 AND o.created_at BETWEEN :from AND :to
            GROUP BY week, week_label, week_start
            ORDER BY week ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        'from' => $from,
        'to' => $to
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function getRevenueByWeekday($from, $to)
{
    $from = date('Y-m-d 00:00:00', strtotime($from));
    $to = date('Y-m-d 23:59:59', strtotime($to));

    $sql = "SELECT 
                DAYOFWEEK(o.created_at) AS weekday,
                DATE_FORMAT(o.created_at, '%W') AS weekday_name,
                SUM(od.price * od.quantity) AS total_revenue
            FROM orders o
            JOIN order_details od ON o.id = od.order_id
            WHERE o.status = 3 AND o.created_at BETWEEN :from AND :to
            GROUP BY weekday, weekday_name
            ORDER BY weekday ASC";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute([
        'from' => $from,
        'to' => $to
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}