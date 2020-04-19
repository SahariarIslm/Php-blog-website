<?php include $_SERVER['DOCUMENT_ROOT']."/blog/lib/Session.php"; 
	  Session::checksession(); 
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/config/config.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/lib/Database.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/helpers/Format.php";?>
<?php 
    $db = new Database();

    if (!isset($_GET['sliderid'])||$_GET['sliderid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php';</script>";
    }else{
        $sliderid = $_GET['sliderid'];
        $query = "select * from tbl_slider where id='$sliderid'";
        $getdata = $db->select($query);
        if ($getdata) {
        	while ($delimg=$getdata->fetch_assoc()) {
        		$dellink = $delimg['image'];
        		unlink($dellink);
        	}
        }
        $delquery = "delete from tbl_slider where id='$sliderid'";
        $delData = $db->delete($delquery);
        if ($delData) {
        	echo "<script>alert('Slider Deleted Successfully')</script>";
        	echo "<script>window.location = 'sliderlist.php';</script>";
        }else{
        	echo "<script>alert('Slider Not Deleted')</script>";
        	echo "<script>window.location = 'sliderlist.php';</script>";
        }
    } 
?>