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

    <h1>News List</h1>
    <a href="../log/category.json" target="_category" style="font-size: 1.5rem; color: #000">
        <i class="fas fa-file-download mt-4"> Download</i>
    </a>
    <table class="table table-hover category-list mt-5">
        <thead class="table-dark">
            <tr>
                <th scope="col">S.N.</th>
                <th scope="col">Title</th>
                <th scope="col">Summary</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $all_news = getAllNews('news');
                //debugger($all_news, true);
                if($all_news){
                    //debugger($all_news);
                    foreach($all_news as $key=>$news){
            ?>
            <tr>
                <td><?php echo ($key+1) ?></td>
                <td><?php echo $news['title']; ?></td>
                <td><?php echo $news['summary']; ?></td>
                <td><?php echo $news['category_title']; ?></td>
                <td><?php echo ($news['status'] == 1) ? 'Published' : 'Unpuiblished';?></td>
                <td>
                    Edit/Delete/View
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