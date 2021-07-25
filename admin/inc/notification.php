<?php

if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
    echo "<p class='alert alert-danger' style='font-size: 1.5rem'>".$_SESSION['error']."</p>";
    unset($_SESSION['error']);
}

if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
    echo "<p class='alert alert-success' style='font-size: 1.5rem'>".$_SESSION['success']."</p>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['warning']) && !empty($_SESSION['warning'])){
    echo "<p class='alert alert-warning' style='font-size: 1.5rem'>".$_SESSION['warning']."</p>";
    unset($_SESSION['warning']);
}

if(isset($_SESSION['info']) && !empty($_SESSION['info'])){
    echo "<p class='alert alert-info' style='font-size: 1.5rem'>".$_SESSION['info']."</p>";
    unset($_SESSION['info']);
}

?>