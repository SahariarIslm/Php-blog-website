<?php include'inc/header.php' ?>
<?php include'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php 
        if (isset($_GET['delcat'])) {
        	$delid = $_GET['delcat'];
        	$delquery = "delete from tbl_category where id = $delid";
        	$deldata = $db->delete($delquery);
        	if ($deldata) {
                echo "<span class='success'>Category deleted seccessfully </span>";
            }else{
                echo "<span class='error'>Category not deleted  </span>";
            }
        }

        ?>
        <div class="block"> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "select * from tbl_category order by id desc";
					$category = $db->select($query);
					if ($category) {
						$i = 0;
						while ($result = $category->fetch_assoc()) {
							$i++;
				?>
				<tr class="even gradeC">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td>
						<?php
						if (Session::get('userRole')=='2' || Session::get('userRole')=='0') { ?>
						<a href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure to delete?')" href="?delcat=<?php echo $result['id']; ?>">Delete</a>
						<?php }  ?>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>
<?php include'inc/footer.php' ?>       
<script type="text/javascript">
	$(document).ready(function(){
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>