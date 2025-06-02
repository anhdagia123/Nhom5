<?php 
 class DashboardController {
<<<<<<< HEAD

    public function __construct(){
        $user = $_SESSION['user'] ?? [];
        if ( !$user || $user['role'] != 'admin' ){
            return header("location:" .  ROOT_URL);
        }
    }
=======
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
    public function index(){
        return view('admin.dashboard');
    }
 }