<?php
//sidebar for admin
//  if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1){
?>
<div class="news_navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="font-size: 2rem">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard" style="font-size: 2rem">News Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="category" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="category" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="category-add">Add Category</a></li>
                            <li><a class="dropdown-item" href="category-list">Category List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="news" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            news
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="news" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="news-add">Add News</a></li>
                            <li><a class="dropdown-item" href="news-list">News List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="users" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="users" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="#">Add Users</a></li>
                            <li><a class="dropdown-item" href="#">Users List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="gallery" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="gallery" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="#">Add Gallery</a></li>
                            <li><a class="dropdown-item" href="#">Gallery List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="video" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Videos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="video" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="#">Add Videos</a></li>
                            <li><a class="dropdown-item" href="#">Videos List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="ads" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Advertisement
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="ads" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="#">Add Ads</a></li>
                            <li><a class="dropdown-item" href="#">Ads List</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="comment" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Comments
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="comment" style="font-size: 2rem">
                            <li><a class="dropdown-item" href="#">Comments List</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                            echo $_SESSION['full_name'];
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="font-size: 2rem">
                        <li><a class="dropdown-item" href="logout">Log Out</a></li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?php
//  } else{
    //sidebar for other users.
//  }
?>