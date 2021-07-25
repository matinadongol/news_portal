<?php
include "inc/header.php";
include "inc/navbar.php";

$news_id = (int)sanitize($_GET['id']);
if($news_id > 0){
    $news_detail = getById('news', $news_id);
    //debugger($news_detail, true);
}
?>
<div class="detail_page container mt-5">
    <?php
if($news_detail){
?>
    <h4><?php echo $news_detail[0]['title']?></h4>
    <span>
        <i class="fa fa-calendar"></i>
        <?php
                echo date('j', strtotime($news_detail[0]['id']))."<sup>".date('S', strtotime($news_detail[0]['id']))."</sup>".date(' M, Y', strtotime($news_detail[0]['id']));
                ?>
        , <small><?php echo  $news_detail[0]['news_source']?></small>
    </span>
    <hr>
    <?php
    if(!empty($news_detail[0]["image"]) && file_exists(UPLOAD_DIR.'news/'.$news_detail[0]['image'])){
        echo "<img src='".UPLOAD_URL.'news/'.$news_detail[0]['image']."' class='img img-responsive'";
    }
    ?>
    <br>
    <div class="news_description my-5">
        <?php echo $news_detail[0]['location']." - ".html_entity_decode($news_detail[0]['description']);?>
    </div>
    <?php
}else {
    echo "No news found";
}
?>
</div>
<hr>

<div class="card-news container mt-5">
    <h4 class="text-center mb-5">Related News</h4>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        if($news_detail){
            $related = getNewsByPosition('related', $news_detail[0]['category_id'], NULL, $news_detail[0]['id']);
        } else {
            $related = getNewsByPosition('latest');
        }
        if($related){
            foreach($related as $related_news){
        ?>
        <div class="col">
            <div class="card h-100">
                <?php
                if(!empty($related_news["image"]) && file_exists(UPLOAD_DIR.'news/'.$related_news['image'])){
                ?>
                <img src="<?php echo UPLOAD_URL.'news/'.$related_news['image'];?>" class="card-img-top" alt="...">
                <?php
                }
                ?>
                <div class="card-body">
                    <a href="detail?id=<?php echo $related_news['id'];?>">
                    <h5 class="card-title"><?php echo $related_news['title']; ?></h5>
                    </a>
                    <p class="card-text"><?php echo $related_news['summary']; ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted"><?php echo date('j', strtotime($related_news['id']))."<sup>".date('S', strtotime($related_news['id']))."</sup>".date(' M, Y', strtotime($related_news['id']));?></small>
                </div>
            </div>
        </div>
        <?php        
            }
        }
        ?>
    </div>
</div>
<?php
include "inc/footer.php";
?>