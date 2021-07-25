<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    //to not give access to dashboard if user is not logged in
    if(!isset($_SESSION, $_SESSION['user_id'], $_SESSION['token']) || empty($_SESSION['token']) || strlen($_SESSION['token']) != 30){
        $_SESSION['error'] = "Please login first";

        @header('location: login');
        exit;
    }
?>
<div class="container mt-5">
    <?php
        include 'inc/notification.php';
        
    ?>
    <h1>Category List</h1>
    <a href="../log/category.json" target="_category" style="font-size: 1.5rem; color: #000"> 
        <i class="fas fa-file-download mt-4"> Download</i>
    </a>
    <table class="table table-hover category-list mt-5">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Title</th>
                <th scope="col">Summary</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $all_categories = getAllData('categories');
                if($all_categories){
                    //debugger($all_categories);
                    foreach($all_categories as $index=>$cat_info){
            ?>
                <tr>
                    <td><?php echo ($index+1) ?></td>
                    <td><?php echo $cat_info['title']; ?></td>
                    <td><?php echo $cat_info['summary']; ?></td>
                    <td><?php echo $cat_info['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                    <td>
                    <?php
                            $edit_url = 'category-add?id='.$cat_info['id'].'&act='.substr(md5('edit-cat-'.$cat_info['id'].'-'.$_SESSION['token']), 5, 15);
                            //substr-> sperates string. md5->used to encrypt.
                        ?>
                        <a href="<?php echo $edit_url;?>"><i class="fas fa-edit"> </i></a>
                        <?php
                            $url = 'category?id='.$cat_info['id'].'&act='.substr(md5('del-cat-'.$cat_info['id'].'-'.$_SESSION['token']), 5, 15);
                            //substr-> sperates string. md5->used to encrypt.
                        ?>
                        <a href="<?php echo $url;?>" onclick="return confirm('Are you sure you want to delete this category?');"><i class="far fa-trash-alt alert-danger"></i></a>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    echo "
                        <tr>
                            <td colspan='5'>No Data Found.</td>
                        </tr>
                    ";
                }
            ?>
        </tbody>
    </table>
</div>


<?php
    include 'inc/footer.php';
?>