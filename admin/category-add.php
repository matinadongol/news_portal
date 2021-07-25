<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    //to not give access to category if user is not logged in
    if(!isset($_SESSION, $_SESSION['user_id'], $_SESSION['token']) || empty($_SESSION['token']) || strlen($_SESSION['token']) != 30){
        $_SESSION['error'] = "Please login first";

        @header('location: login');
        exit;
    }

    //check if edit or create
    $act = "add";
    if(isset($_GET['id'], $_GET['act'])){
        $act = 'edit';
        $id = (int)$_GET['id'];
        if($_GET['act'] != substr(md5('edit-cat-'.$id.'-'.$_SESSION['token']), 5, 15)){
            $_SESSION['error'] = "Token Mismatch";
            @header('location: category-list');
            exit;
        }

        $category_data = getById('categories', $id);
        //debugger($category_data);
        if(!$category_data){
            $_SESSION['info'] = "Category Not Found or already deleted from database.";
            @header('location: category-list');
            exit;
        }
    }

    $total_position = array(1,2,3,4,5,6,7,8,9,10);
    $occupied = getFilledCategory();
    $vacant_position = array_diff($total_position, $occupied);
?>
<div class="container mt-5">
    <?php
        include 'inc/notification.php';
    ?>
    <h1 class="mb-5"><?php echo ucfirst($act);?> Category</h1>
    <!-- ucfirst -> capitalize first letter -->
    <div class="add-form">
        <form action="category" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title"  name ="title" placeholder="Category Title" value="<?php echo (isset($category_data[0]['title']) && !empty($category_data[0]['title'])) ? $category_data[0]['title'] : '';?>">
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea class="form-control" id="summary"  name ="summary" placeholder="Category Summary" rows="7" style="resize: none"><?php echo (isset($category_data[0]['summary']) && !empty($category_data[0]['summary'])) ? $category_data[0]['summary'] : '';?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Show in Menu</label>
                <input type="checkbox" name="show_in_menu" value="1"<?php echo (isset($category_data[0]['show_in_menu']) && $category_data[0]['show_in_menu'] == 1) ? 'checked' : '';?>>Yes
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Menu Order</label>
                <select name="menu_order" id="menu_order">
                    <?php
                    foreach($vacant_position as $key => $value){
                    ?>
                    <option value="<?php echo $value;?>"><?php echo $value;?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="control-label">Status</label>
                <div>
                    <select name="status" id="status" required class="form-control">
                        <option value="1" <?php echo (isset($category_data[0]['status']) && $category_data[0]['status'] == 1) ? 'selected' : '';?>>Active</option>
                        <option value="0" <?php echo (isset($category_data[0]['status']) && $category_data[0]['status'] == 0) ? 'selected' : '';?>>Inactive</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="category_id" value="<?php echo (isset($category_data[0]['id']) && !empty($category_data[0]['id'])) ? $category_data[0]['id'] : '';?>">
            <button type="reset" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>


<?php
    include 'inc/footer.php';
?>