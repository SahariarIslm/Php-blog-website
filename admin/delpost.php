<?php include $_SERVER['DOCUMENT_ROOT']."/blog/lib/Session.php"; 
	  Session::checksession(); 
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/config/config.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/lib/Database.php";?>
<?php include $_SERVER['DOCUMENT_ROOT']."/blog/helpers/Format.php";?>
<?php 
    $db = new Database();

    if (!isset($_GET['delpostid'])||$_GET['delpostid'] == NULL) {
        echo "<script>window.location = 'postlist.php';</script>";
    }else{
        $postid = $_GET['delpostid'];
        $query = "select * from tbl_post where id='$postid'";
        $getdata = $db->select($query);
        if ($getdata) {
        	while ($delimg=$getdata->fetch_assoc()) {
        		$dellink = $delimg['image'];
        		unlink($dellink);
        	}
        }
        $delquery = "delete from tbl_post where id='$postid'";
        $delData = $db->delete($delquery);
        if ($delData) {
        	echo "<script>alert('Data Deleted Successfully')</script>";
        	echo "<script>window.location = 'postlist.php';</script>";
        }else{
        	echo "<script>alert('Data Not Deleted')</script>";
        	echo "<script>window.location = 'postlist.php';</script>";
        }
    }
?>