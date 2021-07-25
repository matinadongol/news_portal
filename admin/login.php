<?php
require 'inc/config.php';
require 'inc/functions.php';

//debugger($_POST);

if(isset($_POST) && !empty($_POST)){
    // Form submission
    $username = filter_var($_POST['username'], FILTER_VALIDATE_EMAIL);
    if(!$username){
        $_SESSION['error'] = "Invalid username";
        @header('location: ./');
        exit;
    }
    $password = sha1($username.$_POST['password']);

    $user_info = getUserByUsername($username);
    if($user_info){
        //debugger($user_info, true);
        if($password === $user_info['password']){
            if($user_info['role_id'] == 1 || $user_info['role_id'] == 2){
                if($user_info['status'] == 1){
                    $_SESSION['success'] = "Welcome to the admin panel.";
                    $_SESSION['user_id'] = $user_info['id'];
                    $_SESSION['full_name'] = $user_info['full_name'];
                    $_SESSION['role_id'] = $user_id['role_id'];
                    
                    $_SESSION['token'] = generateRandomString(30);

                    //Update User
                    $data = array();
                    $data['login_ip'] = $_SERVER['REMOTE_ADDR']; //gives client's public ip.
                    $data['last_login'] = 'now()';
                    $data['remember_token'] = $_SESSION['token'];
                    //if you want to set cookie
                    if(isset($_POST['remember_me']) && $_POST['remember_me'] == 1){
                        setcookie('_auth_user_token', $_SESSION['token'], (time()+864000));
                    }

                    updateData($data, 'users', $users_info['id']);
                    @header('location: dashboard');
                    exit;
                } else{
                    $_SESSION['warning'] = "Username not activated. Please contact our admin";
                    @header('location: ./');
                    exit;
                }
            } else {
                $_SESSION['warning'] = "You have no right to access this page.";
                @heaader('location: ./');
                exit;
            }
        } else {
            $_SESSION['error'] = "Password doesnot match.";
            @header('location: ./');
            exit;
        }
    }
} else {
    // DIrect access
    $_SESSION['error'] = "Unauthorized access";
    @header('location: ./');
    exit;
}

?>