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
<div class="container mt-5 add">
    <?php
        include 'inc/notification.php';
        $act = 'add';
        ?>
    <h1>News <?php echo ucfirst($act);?></h1>
    <div class="add-form">
        <form action="news" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="News Title"
                    value="<?php echo (isset($news_data[0]['title']) && !empty($news_data[0]['title'])) ? $news_data[0]['title'] : '';?>">
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <textarea class="form-control" id="summary" name="summary" placeholder="News Summary" rows="7"><?php echo (isset($news_data[0]['summary']) && !empty($news_data[0]['summary'])) ? $news_data[0]['summary'] : '';?></textarea>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="News Description"
                    rows="7" style="resize: none"><?php echo (isset($news_data[0]['description']) && !empty($news_data[0]['description'])) ? $news_data[0]['description'] : '';?>
                    </textarea>
            </div>
            <div class="mb-3">
                <label for="" class="control-label">Category</label>
                <div>
                    <select name="category_id" id="category_id" required class="form-control">
                        <option value="" selected disabled>
                            -- Select Any One --</option>
                            <?php
                            $all_categories = getAllData('categories');
                            if($all_categories){
                                foreach($all_categories as $category){
                                ?>
                            <option value="<?php echo $category['id']?>"><?php echo $category['title']?></option>
                                <?php    
                                }
                            }
                            ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="news_date" class="form-label">News Date</label>
                <input type="date" class="form-control" id="news_date" required name="news_date" placeholder="News Date"
                    value="<?php echo (isset($news_data[0]['news_date']) && !empty($news_data[0]['news_date'])) ? $news_data[0]['news_date'] : '';?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" required name="location" placeholder="News Location"
                    value="<?php echo (isset($news_data[0]['location']) && !empty($news_data[0]['location'])) ? $news_data[0]['location'] : '';?>">
            </div>
            <div class="mb-3">
                <label for="news_source" class="form-label">Source</label>
                <input type="text" class="form-control" id="news_source" required name="news_source" placeholder="News Source"
                    value="<?php echo (isset($news_data[0]['news_source']) && !empty($news_data[0]['news_source'])) ? $news_data[0]['news_source'] : '';?>">
            </div>
            <div class="mb-3">
                <label for="" class="control-label">Status</label>
                <div>
                    <select name="status" id="status" required class="form-control">
                        <option value="1">
                            Published</option>
                        <option value="0">
                            Unpublished</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="" class="control-label">Image</label>
                <div>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>
            </div>
            <input type="hidden" name="news_id"
                value="<?php echo (isset($news_data[0]['id']) && !empty($news_data[0]['id'])) ? $news_data[0]['id'] : '';?>">
            <button type="reset" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>


<?php
    include 'inc/footer.php';
?>
<script type="text/javascript" src="<?php echo ASSETS_URL.'tinymce/tinymce.min.js'?>"></script>
<script type="text/javascript">


tinymce.init({
  selector: '#description',
  plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount  imagetools textpattern noneditable help charmap   quickbars emoticons',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment'
});
</script>