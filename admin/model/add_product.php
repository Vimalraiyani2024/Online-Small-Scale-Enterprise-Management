<form action="" method="post" id="form1"  enctype="multipart/form-data">
	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>Product Entry Form</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php 
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="type" disabled="disabled" name="add_product" id="btn-popup">Save</button>';
				else
					echo '<button type="type" name="add_product" id="btn-popup">Save</button>';
				?>				
			</div>
			<div class="copy">				
				<div class="table-responsive">
				<table class="table">      
				<tbody>
				  <tr>
					<td><label>Product Name</label></td>
					<td colspan="2"><input type="text" class="form-control" name="item_name" placeholder="Product Name" required></td>
				  </tr>
				  <tr>
				  	<td>Description</td>
					<td colspan="2"> <textarea class="form-control" rows="2" name="item_desc"placeholder="Description" required></textarea></td>
				</tr>
					<td>Unit</td>
					<td><div class="form-group">
						<select name="item_unit" class="form-control" required>
							<option selected="selected"></option>
							<option value="Unit">Unit</option>
							<option value="Dozon">Dozons</option>
							<option value="Grms">Grms</option>
							<option value="Kgs">Kgs</option>
						</select>
					</div>
					</td>										
				  </tr>
				  <tr>
				  	<Td></Td>
				  	<td><input type="text" class="form-control" name="item_rate" placeholder="Product Rate" onkeydown="return FixNumber(this.value,8);"   onkeypress="return isNumberKey(this);" required></td>
					<td><input type="text" class="form-control" name="item_price" placeholder="Product Price" onkeydown="return FixNumber(this.value,8);"   onkeypress="return isNumberKey(this);" required></td>				 				
				  <tr>
					<td>Product Category</td>
					<td>
					<div class="form-group">
						<select name="category" class="form-control" required>
							<option selected="selected"></option>
							<option>Hardware</option>
							<option>Software</option>
							<option>Services</option>
							<option>Other</option>
							<?php 
							
							/*	$rs=mysql_query("select *from product_category")or die(mysql_error());
								while($row=mysql_fetch_array($rs))
								{
									echo'<option value='.$row[0].'>'.$row['category_name'].'</option>';
								}*/
						    ?>
						</select>
					</div>					
					<td>	
				  </tr>
					<tr>
						<td>Select Photo</td>
						<Td colspan="2"><input type="file" name="product_img"/></Td>
					</tr>
				</tbody>
      		</table>
			</div>
			</div>
		</div>
	</form>
	<div class="overlay"></div>
</div>
