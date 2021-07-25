<?php
include "inc/header.php";
include "inc/navbar.php";
?>
<?php
$top_news = getNewsByPosition('top');
//debugger($top_news, true);
?>
<div class="row">
    <?php
    $class= "col-lg-6";
    if(!empty($top_news[0]['image']) && file_exists(UPLOAD_DIR.'news/'.$top_news[0]['image'])){
    ?>
    <div class="col-lg-5">
        <div class="img-responsive">
            <a href="detail?id=<?php echo $top_news[0]['id'];?>">
                <?php
            if(!empty($top_news[0]['image']) && file_exists(UPLOAD_DIR.'news/'.$top_news[0]['image'])){
            ?>
                <img src="<?php echo UPLOAD_URL.'news/'.$top_news[0]['image']?>" alt="">
                <?php
            } else{
                echo $top_news[0]['title'];
            }
            ?>
            </a>
        </div>
    </div>
    <?php
    } else {
        $class = "col-lg-12";
    }
    ?>
    <div class="<?php echo $class;?> news_detail">
        <div class="news_d">
            <a href="detail?id=<?php echo $top_news[0]['id'];?>">
                <h4>
                    <?php
                echo $top_news[0]['title'];
                ?>
                </h4>
            </a></br>
            <span>
                <i class="fa fa-calendar"></i>
                <?php
                echo date('j', strtotime($top_news[0]['id']))."<sup>".date('S', strtotime($top_news[0]['id']))."</sup>".date(' M, Y', strtotime($top_news[0]['id']));;
                ?>
                , <small><?php echo  $top_news[0]['news_source']?></small>
            </span>
            <hr>
            <p><?php echo $top_news[0]['summary'];?></p>
            <a href="detail?id=<?php echo $top_news[0]['id'];?>" class="btn btn-success">Read More</a>
        </div>

    </div>
</div>
<?php
include "inc/footer.php";
?>