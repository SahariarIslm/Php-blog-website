<?php include'inc/header.php' ?>
<?php include'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $note = $fm->validation($_POST['note']);
        $note = mysqli_real_escape_string($db->link,$_POST['note']);
                if (empty($note)) {
                   echo "<span class='error'>field must not be empty</span>";
                }else{
                    $query = "update tbl_footer
                    set 
                    note='$note'
                    where id = '1'";
                    $updated_social = $db->update($query);
                    if ($updated_social) {
                        echo "<span class='success'>Data updated seccessfully </span>";
                    }else{
                        echo "<span class='error'>Data not updated  </span>";
                    }
                }
            }
        ?>
        <?php 
        $query = "select * from tbl_footer where id='1'";
        $social = $db->select($query);
        if ($social) {
            while ($result = $social->fetch_assoc()) { ?>
        <div class="block copyblock"> 
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['note'];?>" name="note" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        <?php } } ?>
    </div>
</div>
<?php include'inc/footer.php' ?>