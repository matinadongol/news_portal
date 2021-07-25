<?php
 $data = file_get_contents('log/category.json');
 if($data){
     $array = json_decode($data, true);
 }
?>
<div class="deleted-list">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
                <th scope="col">Old Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($array as $log_data){
            ?>
            <tr>
                <td><?php echo $log_data['date'];?></td>
                <td><?php echo $log_data['act'];?></td>
                <td><?php echo "<pre>"; print_r($log_data['data']); echo "</pre>";?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
 include 'admin/inc/footer.php';
?>