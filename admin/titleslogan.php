﻿<?php include'inc/header.php' ?>
<?php include'inc/sidebar.php' ?>
<style type="text/css">
.leftside{float: left;width: 70%;}
.rightside{float: left; width: 20%;}
.rightside img{height: 160px;width: 170px;} 
</style>


<div class="grid_10">
    <div class="box round first grid">
    <h2>Update Site Title and Description</h2>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $fm->validation($_POST['title']);
        $slogan = $fm->validation($_POST['slogan']);

        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $slogan = mysqli_real_escape_string($db->link,$_POST['slogan']);
        
        $permited  = array('png');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $same_image = 'logo'.'.'.$file_ext;
        $uploaded_image = "upload/".$same_image;
            if ($title=="" || $slogan=="") {
                echo "<span class='error'>Field must not be empty.</span>";
                }else{

                if (!empty($file_name)) {
                    if ($file_size >1048567) {
                     echo "<span class='error'>Image Size should be less then 1MB!
                     </span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                     echo "<span class='error'>You can upload only:-"
                     .implode(', ', $permited)."</span>";
                    }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "update title_slogan 
                            set 
                            title = '$title',
                            slogan = '$slogan',
                            image = '$uploaded_image'
                            where id = '1' ";
                    $updated_rows = $db->update($query);
                    if ($updated_rows) {
                     echo "<span class='success'>Post Updated Successfully.</span>";
                    }else {
                     echo "<span class='error'>Post Not Updated !</span>";
                    }
                }
            }else{
            $query= "update title_slogan 
                    set 
                    title = '$title',
                    slogan = '$slogan'
                    where id = '1' ";
                $updated_rows = $db->update($query);
                if ($updated_rows) {
                 echo "<span class='success'>Data Updated Successfully.</span>";
                }else {
                 echo "<span class='error'>Data Not Updated !</span>";
                }
            }
        }
    }
?>
    <?php 
    $query = "select * from title_slogan where id='1'";
    $blog_title = $db->select($query);
    if ($blog_title) {
        while ($result = $blog_title->fetch_assoc()) { ?>
        <div class="block sloginblock"> 
        <div class="leftside">          
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form" enctype="multipart/formdata">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <label>Upload Logo</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr> 
    				<tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
                </form>
            </div>
            <div class="rightside">
                <img src="<?php echo $result['image'];?>" alt="logo">
            </div>
        </div>
    <?php } } ?>
    </div>
</div>
<?php include'inc/footer.php' ?>       