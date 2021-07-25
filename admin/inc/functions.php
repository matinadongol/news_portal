<?php
function debugger($data, $is_die = false){
    echo "<pre style ='color: #ff0000'>";
    print_r($data);
    echo "</pre>";
    if($is_die){
        exit;
    }
}

function getUserByUsername($username){
    global $conn;
    $sql = "SELECT * FROM users WHERE email_address = '".$username."'";
    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if(mysqli_num_rows($query) <=0){
        return false;
    } else if (mysqli_num_rows($query) > 1){
        return false;
    } else {
        $data = mysqli_fetch_assoc($query);
        return $data;
    }
}

function generateRandomString($length = 15){
    $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $chars_length = strlen($chars);
    $random = "";
    for($i=0; $i<$length; $i++){
        $random .= $chars[rand(0, $chars_length-1)];
    }
    return $random;
}

function updateData($data, $table, $id){
    global $conn;
    $sql = " UPDATE " .$table. " SET ";
    $temp = array();
    foreach($data as $column_name => $value){
        $str = $column_name." = ";
        if(is_string($value)){
            $str .= " '".$value."' ";
        } else {
            $str .= $value;
        }
        $temp[] = $str;
    }
    $sql .= implode(", ", $temp);
    $sql .= " WHERE id = ".$id;

    $query = mysqli_query($conn, $sql);
    if($query){
        return $id;
    } else {
        return false;
    }
}

function sanitize($str){
    global $conn;
    $str = strip_tags($str); //strip_tags -> to remove script tags in the input fields. 
    $str = mysqli_real_escape_string($conn, $str); // remove white spaces. addslashes()-> add slashes on every function call so it is not used often.
    $str = htmlentities($str); // <p>news</p> -> &lt;p&gt;news&lt;/p&gt; reverse of this function is html_entity_decode() 
    return $str;
}

function addData($data, $table){
    global $conn;
    $sql = " INSERT INTO " .$table. " SET ";
    $temp = array();
    foreach($data as $column_name => $value){
        $str = $column_name." = ";
        if(is_string($value)){
            $str .= " '".$value."' ";
        } else {
            $str .= $value;
        }
        $temp[] = $str;
    }
    $sql .= implode(", ", $temp);
    $query = mysqli_query($conn, $sql);
    if($query){
        return mysqli_insert_id($conn); // to generate id in database
    } else {
        return false;
    }
}

function getAllData($table){
    global $conn;
    $sql = "SELECT * FROM ".$table. " ORDER BY id DESC ";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) <= 0){ //no data
        return false;
    } else {
        $data = array();
        while($row = mysqli_fetch_assoc($query)){ //gives every row's element
            $data[] = $row;
        }
        return $data;
    }
}

function getById($table, $id){
    global $conn;
    $sql = "SELECT * FROM ".$table." WHERE id = ".$id." ORDER BY id DESC ";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) <= 0){ //no data
        return false;
    } else {
        $data = array();
        while($row = mysqli_fetch_assoc($query)){ //gives every row's element
            $data[] = $row;
        }
        return $data;
    }
}

function deleteData($table, $field, $value){
    global $conn;
    $sql = "DELETE FROM ".$table." WHERE ".$field." = '".$value."'";
    $query = mysqli_query($conn, $sql);
    if($query){
        return true;
    } else {
        return false;
    }
}

function uploadSingleImage($file, $folder){
    if(isset($file['error']) && $file['error'] == 0){
        // upload image
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if(in_array(strtolower($ext), ALLOWED_EXTENTIONS)){
            $upload_path = UPLOAD_DIR."/".$folder;
            if(!is_dir($upload_path)){
                mkdir($upload_path, '0777', true);
            }
            $file_name = ucfirst($folder)."-".date('Ymdhis').rand(0, 99).".".$ext;
            $success = move_uploaded_file($file['tmp_name'], $upload_path."/".$file_name);
            if($success){
                return $file_name;
            } else {
                return null;
            }
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function getAllNews(){
    global $conn;
    $sql = "SELECT 
                news.id, 
                news.title, 
                news.summary, 
                news.status, 
                categories.title AS category_title
            FROM news 
            LEFT JOIN categories ON news.category_id = categories.id
            ORDER BY news.id DESC";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) <= 0){
        return false;
    } else{
        $data = array();
        while($row = mysqli_fetch_assoc($query)){
            $data[] = $row;
        }
        return $data;
    }
}

function getFilledCategory(){
    global $conn;
    $sql = "SELECT menu_order FROM categories WHERE menu_order !=0";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) <= 0){
        return false;
    } else {
        $data = array();
        while($row = mysqli_fetch_assoc($query)){
            $data[] = $row['menu_order'];
        }
        return $data;
    }
}


//frontend functions
function getMenu($position = 'header'){
    global $conn;
    if($position == 'header'){
        $sql = "SELECT * FROM categories WHERE status = 1 AND show_in_menu = 1 ORDER BY menu_order ASC LIMIT 0, 10";
    } else {
        $sql = "SELECT * FROM categories WHERE status = 1 AND show_in_menu = 1 ORDER BY menu_order ASC";
    }

    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) == 0){
        return false;
    } else {
        $data = array();
        while($row = mysqli_fetch_assoc($query)){
            $data[] = $row;
        }
        return $data;
    }
}

function getNewsByPosition($position = null, $cat_id = null, $keyword = null, $news_id = null, $offset = 0, $count=4){
    global $conn;
    switch(true){
        case ($position == 'top'):
            $sql ="SELECT * FROM news WHERE status = 1 ORDER BY id DESC LIMIT 0, 1";
            break;
        case ($position == 'related'):
            $sql = "SELECT * FROM news WHERE status = 1 AND category_id =".$cat_id." AND id != ".$news_id." ORDER BY id DESC LIMIT 0,3";
            break;
        case ($position == 'latest'):
            $sql ="SELECT * FROM news WHERE status = 1 ORDER BY id DESC LIMIT ".$offset.", ".$count;
            break;
        case ($position == 'home-category'):
            $sql ="SELECT * FROM news WHERE status = 1 AND category_id = ".$cat_id." ORDER BY id DESC LIMIT 0, 4";
            break;
        case ($position == 'category'):
            $sql ="SELECT * FROM news WHERE status = 1 AND category_id = ".$cat_id." ORDER BY id DESC";
            break;
        default:
            $sql="SELECT * FROM news WHERE status = 1 ORDER BY id DESC";
            break;
    }

    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) <= 0){
        return false;
    } else {
        $data = array();
        while($row = mysqli_fetch_assoc($query)){
            $data[] = $row; // this statement is same as -> array_push($data, $row);
        }
        return $data;
    }
}
?>