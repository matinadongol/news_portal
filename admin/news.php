<?php
    require 'inc/config.php';
    require_once 'inc/functions.php'; //ignores if file is double included.
    //to not give access to dashboard if user is not logged in
    if(!isset($_SESSION, $_SESSION['user_id'], $_SESSION['token']) || empty($_SESSION['token']) || strlen($_SESSION['token']) != 30){
        $_SESSION['error'] = "Please login first";

        @header('location: login');
        exit;
    }

    if(isset($_POST) && !empty($_POST)){
        $news = array();
        $news['title'] = sanitize($_POST['title']);
        $news['category_id'] = (int)sanitize($_POST['category_id']);
        $news['summary'] = sanitize($_POST['summary']);
        $news['description'] = htmlentities($_POST['description']);
        $news['news_date'] = sanitize($_POST['news_date']);
        $news['location'] = sanitize($_POST['location']);
        $news['news_source'] = sanitize($_POST['news_source']);
        $news['status'] = (int)sanitize($_POST['status']);//int is not a function but casting
        $news['added_by'] = $_SESSION['user_id'];

        $news['image'] = '';

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $news['image'] = uploadSingleImage($_FILES['image'], 'news');
        }

        $news_id = addData($news, 'news');
        if($news_id){
            $_SESSION['success'] = "News added successfully.";
        } else {
            $_SESSION['error'] = "Sorry! There was problem while adding news.";
        }
        @header('location: news-list');
        exit;
    }else{
        $_SESSION['error'] = "Unauthorized access";
        @header('location: news-list');
        exit;
    }
?>