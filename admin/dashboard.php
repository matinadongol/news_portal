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
    <h1>Welcome to dashboard.</h1>
</div>


<?php
    include 'inc/footer.php';
?>