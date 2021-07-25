<?php
    require 'inc/config.php';
    require 'inc/functions.php';

    session_start();
    $user_id = $_SESSION['user_id'];

    session_destroy();
    if(isset($_COOKIE['_auth_user_token']) && !empty($_COOKIE['_auth_user_token'])){
        setcookie('_auth_user_token'. '', time()-60);
    }

    // updateData(array('token'=>NULL), 'users', $user_id);

    @header('location: ./');
    exit;
?>