<form action="" method="post" id="form1">
	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>Add Department</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="add_department" id="btn-popup">Save</button>';
				else
					echo '<button type="submit" name="add_department" id="btn-popup">Save</button>';
				?>
			</div>			
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
					<td><label>Department Name </label></td>
					<td colspan="3"><input type="text" class="form-control" name="dept_name" id="dept_name" placeholder="Department Name" required></td>
				  </tr>			 
				</tbody>
      		</table>
			</div>
			
			</div>
		</div>
	</form>
	<div class="overlay"></div>
</div>