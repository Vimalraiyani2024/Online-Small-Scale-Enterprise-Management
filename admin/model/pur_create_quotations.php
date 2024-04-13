<?php include_once("header.php"); ?>
<script language="javascript">
function showData(sel){
	var item_id=sel.options[sel.selectedIndex].value; 
	if (item_id.length > 0 ) { 
	 $.ajax({
			type: "POST",
			url: "fetch_data.php",
			data: "fetch_item_id="+item_id,
			cache: false,
			beforeSend: function () { 
				$('#item_desc').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {  
				var ajax_data = jQuery.parseJSON(html);
				$("#item_desc").html(ajax_data.item_desc); 
				$("#item_price").val(ajax_data.item_price);
			}
		});
	} 
}
var itemCount = 0;
$(document).ready(function() {
    var wrapper  = $(".input_fields_wrap");
    var add_button = $(".add_field_button"); 
    var html="";
	$(add_button).click(function(e)
	{ 
        e.preventDefault();       
		itemCount++;
		item_id=$("#item_name").val();
		item_name=$("#item_name option:selected").text();
		item_desc= $("#item_desc").html();
		item_price= $("#item_price").val();
		item_qty=$("#item_quantity").val();
		total=parseInt(item_price) * parseInt(item_qty);
		
		if($("#item_name").val()=="" || item_qty=="")
			alert("Please fill all the fields...");
		else
		{		   		
			html='<tr id="tr'+ itemCount + '"><td><input  type="text" readonly id="item_name[]" name="item_name[]" value="'+item_name+'" class="form-control, text-readonly"/></td><td><input type="text" name="item_desc[]" value="'+item_desc+'" style="border-style:none;" readonly class="form-control, text-readonly"/></td><td><input type="text" style="text-align:right;max-width:100px" readonly name="item_price[]" id="item_price[]" value="'+item_price+'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:100px" readonly   id="item_qty[]" name="item_qty[]" value="'+item_qty+'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:100px" readonly name="total[]" value="'+total+'" class="form-control, text-readonly"/></td><td><input type="button" class="btn-delete"  id="' + itemCount + '" value="x"></td><input type="hidden" name="item_id[]" value="'+item_id+'"/></tr>';
			$("#item_desc").html("");
			$("#item_price").val("");
			$("#item_name").val("");
			$("#item_quantity").val("");
			$("#item_detail").append(html)
		}        		
		 $("#"+itemCount).click(function() {
			var buttonId = $(this).attr("id");			
			$("#tr"+ buttonId).remove();	
		});
    });    
});
</script>
<form action="" method="POST" id="form1">
	<div id="modal">
		<div class="modal-content">		
			<div class="cf footer">
				<h2>Create New Purchase Quotation</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="add_pur_quotation" id="btn-popup">Save</button>';
				else
				echo '<button type="submit" name="add_pur_quotation" id="btn-popup">Save</button>';
				?>
			</div>
			<div class="copy">				
				<div class="table-responsive">
			  	<table class="table table">
			  	<tbody>
				  <tr>
				  	<td width="15%">Quotation No.</td>
					<td><input type="text" placeholder="Quotation No" name="pqid" class="form-control"  onkeydown="return FixNumber(this.value,8);" required/></td>
				    <td colspan="2"></td>					
				</tr>
				<tr>
					<td>Supplier</td>
					<td>					
						<select id="supplier_id" name="supplier_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 					
								$rs=mysql_query("select *from supplier_master")or die(mysql_error());
								while($row=mysql_fetch_array($rs))					
									echo'<option value='.$row['supplier_id'].'>'.$row['supplier_name'].'</option>';								
						    ?>
						</select>					
					</td>
					<td>Quotation Date</td>
					<td><input type="text" id="sale_quo_date" readonly class="form-control"  name="quo_date" placeholder="Select Date"  value="<?php echo date("d-m-Y"); ?>" required/></td>								
				</tr>
				<tr>					
					<td>Reference</td>
					<td> <input class="form-control" name="reference" type="text" placeholder="Reference" required/></td>	
					<td>Reference Date</td>
					<td><input type="text" id="sale_ref_quo_date" class="form-control" readonly="readonly"  name="ref_date" value="<?php echo date("d-m-Y"); ?>" placeholder="Select Date"  required/></td>								
				</tr>
				<tr>				  	
					<td>Expiry Date</td>
					<td><input type="text" id="sale_exp_quo_date" class="form-control" readonly="readonly" value="<?php echo date("d-m-Y"); ?>"  name="exp_date" placeholder="Select Date"  required/></td>									
				  	<td>Tax </td>
					<td>
						<select id="tax" class="form-control" name="tax" required>
							<option value="" selected="selected">Select TAX</option>
							<?php
								$rs1=mysql_query("select *from tax_master")or die(mysql_error());
								while($row=mysql_fetch_array($rs1))
									echo'<option value='.$row['tax_per'].','.$row['additional_per'].','.$row['tax_name'].'>'.$row['tax_name'].'</option>';
							?>
						</select>		
					</td>
				</tr>
				<tr>
					<td>Remark</td>
					<td colspan="3"><textarea class="form-control" placeholder="Remark" name="remark" required></textarea></td>
				</tr>	
				<tr>
					<Td colspan="4">												
  					<table id="item_detail" class="table">
						<thead>
				 		<tr>
							<th>ITEM</th>												
							<th>DESCRIPTION</th>
							<th>UNIT PRICE</th>									
							<th>QTY</th>
							<th colspan="2">TOTAL</th>
						</tr>
						</thead>
						<tr>
							<td>										
								<select name="item_name" id="item_name" class="form-control" onChange="showData(this);">
								<option value="" selected="selected">Select Item</option>
								<?php 
									$rs=mysql_query("select *from product_master")or die(mysql_error());
									while ($row = mysql_fetch_array($rs )) 
 						    			echo "<option value=".$row["item_id"].">". $row["item_name"]."</option>";
								?>  
								</select>											
							</td>
							<td><div id="item_desc"></div></td>
							<td style="text-align:right;"><input type="text" class="form-control" style="background:none; border:none;cursor:default;border-color:#FFFFFF;border-radius:0" id="item_price" name="item_price" disabled="disabled" style="text-align:right;max-width:100px"/></td>
							<td style="text-align:right;"><input class="form-control" name="item_quantity" type="text" id="item_quantity" style="text-align:right;max-width:100px" onkeypress="return FixNumber(this.value,8);"   onkeydown="return isNumberKey(this);" /></td>						
							<td colspan="2"><button class="add_field_button" id="btn-add">Add </button></td>
						</tr>
						</table>					
					</td>
				</tr>											
				</tbody>
      		</table>
		</table>      
		</div>
	</div>
</div>
</form>
<div class="overlay"></div>
</div>
</div>
</body>
</html>