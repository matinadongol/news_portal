<?php
    require 'inc/config.php';
    require 'inc/functions.php';

    //to not give access to category if user is not logged in
    if(!isset($_SESSION, $_SESSION['user_id'], $_SESSION['token']) || empty($_SESSION['token']) || strlen($_SESSION['token']) != 30){
        $_SESSION['error'] = "Please login first";

        @header('location: login');
        exit;
    }

    //debugger($_GET, true);

    if(isset($_POST) && !empty($_POST)){
        //debugger($_POST, true);
        //debugger($_REQUEST, true);
        $data= array();
        $data['title'] = sanitize($_POST['title']); //To prevent from sql injection create a function called sanitize.
        $data['summary'] = sanitize($_POST['summary']);
        $data['status'] = sanitize($_POST['status']);
        $data['added_by'] = $_SESSION['user_id'];
        $data['show_in_menu'] = (isset($_POST['show_in_menu']) && $_POST['show_in_menu'] == 1)? 1: 0;
        $data['menu_order'] = $_POST['menu_order'];
       
        $cat_id = (int)$_POST['category_id']; //to check whether form is for create or update
        if($cat_id == 0){
            $act = "add";
            $category_id = addData($data, 'categories');//insert into database
        } else {
            $act = "updat";
            $category_id = updateData($data, 'categories', $cat_id);//update into  database
        }
        
        
        if($category_id){
            $_SESSION['success'] = "Category ".$act."ed successfully";
        } else {
            $_SESSION['error'] = "There was a problem while ".$act."ing category.";
        }
        @header('location: category-list');
        //debugger($data);

    } else if(isset($_GET, $_GET['id'], $_GET['act']) && !empty($_GET['id']) && !empty($_GET['act'])){
        $id = (int)sanitize($_GET['id']);
        if($_GET['act'] == substr(md5('del-cat-'.$id.'-'.$_SESSION['token']), 5, 15)){//similar to csrf token
            $category_detail = getById('categories', $id);
            //debugger($category_detail, true);
            if($category_detail){

                //backup
                $log_file = "../log/category.json";
                $to_write = array(
                    'date' => date('Y-m-d h:i:s A'),
                    'act' => 'delete',
                    'data' => $category_detail
                );
                if(file_exists($log_file)){
                    $data= file_get_contents($log_file);

                    if($data){
                        $array = json_decode($data, true);
                        $array[] = $to_write;
                    } else {
                        $array[] = $to_write;
                    }
                    
                } else{
                    $array[] = $to_write;
                }
                file_put_contents($log_file, json_encode($array));
                //backup ends

                $del = deleteData('categories', 'id', $id);
                if($del){//if true is returned from deleteData function
                    $_SESSION['success'] = "Category deleted successfully.";
                    @header('location: category-list');
                    exit;
                } else{
                    $_SESSION['error'] = "Sorry! There was a problem while deleting.";
                    @header('location: category-list');
                    exit;
                }
            } else{
                $_SESSION['error'] = "Category not found or already deleted.";
                @header('location: category-list');
                exit;
            }
        } else{
            $_SESSION['error'] = "Token Mismatched";
            @header('location: category-list');
            exit;
        }
    } else{
        $_SESSION['warning'] = "Unauthorized access";
        @header('location: category-list');
        exit;
    }
?>