<?php
    include 'inc/header.php';
    //to redirect to dashboard when user opens login page if the user is already logged in
    if(isset($_SESSION, $_SESSION['user_id'], $_SESSION['token']) && !empty($_SESSION['token']) && strlen($_SESSION['token']) == 30){
        $_SESSION['success'] = "You are already logged in.";

        @header('location: dashboard');
        exit;
    }
?>
<div class="login-form">
    <?php
        include 'inc/notification.php';
    ?>
    <form method="post" name="login" action="login">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="email" class="form-control" id="username" name="username" >
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
            <input type="checkbox" name="remember_me" value="1"> Remember Me<br>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<?php
 include 'inc/footer.php';
?>