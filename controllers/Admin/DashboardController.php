<?php 
 class DashboardController {


    public function __construct(){
        $user = $_SESSION['user'] ?? [];
        if ( !$user || $user['role'] != 'admin' ){
            return header("location:" .  ROOT_URL);
        }
    }

    public function index(){
        return view('admin.dashboard');
    }
    public function logout() {
    session_unset();
    session_destroy();
    return header('Location: ' .ROOT_URL );
}
 }