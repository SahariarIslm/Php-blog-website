<?php include'inc/header.php' ?>
<?php include'inc/sidebar.php' ?>
<?php
if (isset($_GET['seenid'])) {
	$seenid = $_GET['seenid'];
	$query = "update tbl_contact
            set 
            status='1'
            where id = '$seenid'";
    $updated_row = $db->update($query);
    if ($updated_row) {
        echo "<span class='success'>Message sent in the seen box </span>";
    }else{
        echo "<span class='error'>something went wrong</span>";
    }
}

 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from tbl_contact where status='0' order by id desc";
				$msg = $db->select($query);
				if ($msg) {
					$i = 0;
					while ($result = $msg->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['body'],20); ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> ||
						<a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
						<a onclick="return confirm('Are you sure to move?')" href="?seenid=<?php echo $result['id'];?>">Seen</a> 
					</td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
<?php
if (isset($_GET['draftid'])) {
	$draftid = $_GET['draftid'];
	$query = "update tbl_contact
            set 
            status='2'
            where id = '$draftid'";
    $updated_row = $db->update($query);
    if ($updated_row) {
        echo "<span class='success'>Message sent in the Draft Box </span>";
    }else{
        echo "<span class='error'>something went wrong</span>";
    }
}

 ?>
    <div class="box round first grid">
        <h2>Seen Message</h2>
        <?php 
        if (isset($_GET['delid'])) {
        	$delid = $_GET['delid'];
        	$delquery = "delete from tbl_contact where id = $delid";
        	$deldata = $db->delete($delquery);
        	if ($deldata) {
                echo "<span class='success'>Message deleted seccessfully </span>";
            }else{
                echo "<span class='error'>Message not deleted  </span>";
            }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from tbl_contact where status='1' order by id desc";
				$msg = $db->select($query);
				if ($msg) {
					$i = 0;
					while ($result = $msg->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['body'],20); ?></td>
					<td><?php echo $fm->formatDate($result['date']); ?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a> || 
						<a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $result['id'];?>">Delete</a> ||
						<a onclick="return confirm('Are you sure to move?')" href="?draftid=<?php echo $result['id'];?>">Draft</a> 
					</td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>

    <div class="box round first grid">
        <h2>Draft Message</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "select * from tbl_contact where status='2' order by id desc";
				$dmsg = $db->select($query);
				if ($dmsg) {
					$i = 0;
					while ($dresult = $dmsg->fetch_assoc()) {
						$i++;
			?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $dresult['firstname'].' '.$dresult['lastname']; ?></td>
					<td><?php echo $dresult['email']; ?></td>
					<td><?php echo $fm->textShorten($dresult['body'],20); ?></td>
					<td><?php echo $fm->formatDate($dresult['date']); ?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $dresult['id'];?>">View</a> || 
						<a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $dresult['id'];?>">Delete</a>  
					</td>
				</tr>
			<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>

</div>
<script type="text/javascript">
	$(document).ready(function(){
		setupLeftMenu();
		
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include'inc/footer.php' ?>