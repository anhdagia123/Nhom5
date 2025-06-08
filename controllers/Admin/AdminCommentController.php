<?php
class AdminCommentController
{
    public function __construct()
    {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            return header("location:" . ROOT_URL);
        }
    }

    // Hiển thị danh sách bình luận (có phân trang)
    public function index()
    {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;
        $commentModel = new CommentModelAdmin;
        $comments = $commentModel->all($limit, $offset);
        $totalComments = $commentModel->countAll();
        $totalPages = ceil($totalComments / $limit);
        $message = session_flash('message');
        return view('admin.comments.list', compact('comments', 'message', 'page', 'totalPages'));
    }

    // Ẩn bình luận
    public function hide()
    {
        $id = $_GET['id'];
        (new CommentModelAdmin)->updateStatus($id, 1);
        $_SESSION['message'] = 'Ẩn bình luận thành công';
        header('Location: ' . ADMIN_URL . '?ctl=listcomment');
        die;
    }

    // Hiện bình luận
    public function show()
    {
        $id = $_GET['id'];
        (new CommentModelAdmin)->updateStatus($id, 0);
        $_SESSION['message'] = 'Hiện bình luận thành công';
        header('Location: ' . ADMIN_URL . '?ctl=listcomment');
        die;
    }

}