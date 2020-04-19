<?php include'inc/header.php' ?>
<?php include'inc/sidebar.php' ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="20%">No.</th>
						<th width="25%">Post Title</th>
						<th width="35%">Image</th>
						<th width="20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$query = "select * from tbl_slider order by id desc";
					$slider = $db->select($query);
					if ($slider) {
					$i=0;
					while ($result = $slider->fetch_assoc()) {
						$i++;
				?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['title']; ?></td>
						<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
						<td>
							 
							<?php  
							if (Session::get('userRole') == '0') { ?>
							<a href="editslider.php?sliderid=<?php echo $result['id'] ?>">Edit</a> 
							||  
							<a onclick="return confirm('Are you sure to delete?')" href="delslider.php?sliderid=<?php echo $result['id'] ?>">Delete</a>
							<?php } ?>
						</td>
					</tr>
				<?php } } ?>
				</tbody>
			</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include'inc/footer.php' ?>