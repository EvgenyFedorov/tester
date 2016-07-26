<?php

session_start();

if(!isset($_SESSION['adminLogin'])){

    $_SESSION['adminLogin'] = false;

}

require_once 'ajax/db_function.php';

require_once 'admin/admin_class.php';

$admin_class = new Admin();

if(isset($_POST['loginingAdmin']) AND ($_POST['login'] == 'admin') AND $_POST['password'] == 'password'){

    if($admin_class->status_db === true){

        $admin_class->admin_Login();

    }

}
if(isset($_POST['exitAdmin'])){

    $admin_class->admin_Exit();

}elseif($_SESSION['adminLogin'] === true){

    include_once 'admin/view/admin_exit.php';

    $admin_class->load_all_users();


}else{

    include_once 'admin/view/admin_login.php';

}

?>