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
function fetch_sales_invoice(sel){
	var cust_id=sel; 
	if (cust_id.length > 0 ) { 
	 $.ajax({
			type: "POST",
			url: "fetch_data.php",
			data: "fetch_cust_id1="+cust_id,
			cache: false,
			beforeSend: function () { 
				$('#invoice_id').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) { 						
				$("#invoice_id").html(html);
			}
		});
	} 
}
function fetch_sales_invoice_date(sel){
	var cust_id=sel; 
	if (cust_id.length > 0 ) { 
	 $.ajax({
			type: "POST",
			url: "fetch_data.php",
			data: "fetch_sales_invoice_date="+cust_id,
			cache: false,
			beforeSend: function () { 
				$('#ref_date').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) { 
				var ajax_data = jQuery.parseJSON(html);
				$("#ref_date").val(ajax_data.ref_date); 
				$("#tax").val(ajax_data.tax);
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

		
		if($("#item_name").val()=="" || item_qty==""){
			alert("Please fill all the fields...");
		}else
		{	
			total=parseInt(item_price) * parseInt(item_qty);	   		
			html='<tr id="tr'+ itemCount + '"><td><input  type="text" readonly id="item_name[]" name="item_name[]" value="'+item_name+'" class="form-control, text-readonly"/></td><td><input type="text" name="item_desc[]" value="'+item_desc+'" style="border-style:none;" readonly class="form-control, text-readonly"/></td><td><input type="text" style="text-align:right" readonly name="item_price[]" id="item_price[]" value="'+item_price+'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:60px" readonly   id="item_qty[]" name="item_qty[]" value="'+item_qty+'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:60px" readonly name="total[]" value="'+total+'" class="form-control, text-readonly"/></td><td><input type="button" class="btn-delete"  id="' + itemCount + '" value="x"></td><input type="hidden" name="item_id[]" value="'+item_id+'"/></tr>';						
			
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
<form action="" method="post" id="form1">
	<div id="modal">
		<div class="modal-content">			
			<div class="cf footer">
				<h2>Create Sales Return</h2>
			</div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php 
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="add_sales_return" id="btn-popup">Save</button>';
				else
					echo '<button type="submit" name="add_sales_return" id="btn-popup">Save</button>';
				?>
			</div>
			<div class="copy">				
				<div class="table-responsive">
			  	<table class="table">
			  	<tbody>
				  <tr>
				  	<td>Return Invoice No.</td>
					<td><input class="form-control" name="sales_return_id" type="text"   placeholder="Return Invoice No."  onkeydown="return FixNumber(this.value,15);"/></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td>Customer</td>
					<td>					
						<select id="customer_id" name="customer_id" class="form-control" onchange="fetch_sales_invoice(this.value);" required>
							<option selected="selected"></option>
							<?php 
							
								$rs=mysql_query("select b.customer_id,customer_name from customer_master a,sales_master b where a.is_deleted='0' and b.is_deleted='0' and a.customer_id=b.customer_id")or die(mysql_error());
								while($row=mysql_fetch_array($rs))								
									echo'<option value='.$row[0].'>'.ucwords($row['customer_name']).'</option>';								
						    ?>
						</select>					
					</td>
					<td>Return Date</td>
					<td><input class="form-control" id="sale_exp_quo_date" readonly="readonly" name="return_date" type="text" value="<?php echo date("d-m-Y"); ?>"  placeholder="Return Date"/></td>
				</tr>
			
			  <tr>
				  	<td></td>
					<td></td>
				  	<td>Reference</td>
					<td> 
						<select id="invoice_id" name="invoice_id" class="form-control" onchange="fetch_sales_invoice_date(this.value);" required>
							<option selected="selected"></option>							
						</select>		
					</td>								
				</tr>
					<tr>
					<td></td>
					<Td></Td>
					<td>Reference Date</td>
					<td><input class="form-control" id="ref_date" name="ref_date" type="text" placeholder="Reference Date" disabled="disabled"/></td>								
			  </tr>
				<tr>
				  	<td></td>
					<td></td>
				  	<td>Tax </td>
					<td><input class="form-control" name="tax" id="tax" type="text" disabled="disabled"/></td>		
				</tr>
				<tr>
					<td>Remark</td>
					<td colspan="3"><textarea class="form-control" placeholder="Remark" name="remark" required></textarea></td>
				</tr>				
				<tr>
					<Td colspan="4">
					<div class="table-responsive">												
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
 						    			echo "<option value=".$row["item_id"].">". ucwords($row["item_name"])."</option>";
								?>  
								</select>											
							</td>
							<td><div id="item_desc" style="width:auto;"></div></td>
							<td style="text-align:right;"><input type="text" class="form-control" style="background:none; border:none;cursor:default;border-color:#FFFFFF;border-radius:0" id="item_price" name="item_price" disabled="disabled" style="text-align:right;max-width:100px"/></td>
							<td style="text-align:right;"><input class="form-control" name="item_quantity" type="text" id="item_quantity" style="text-align:right;max-width:90px" onkeypress="return FixNumber(this.value,8);"   onkeydown="return isNumberKey(this);" /></td>						
							<td><button class="add_field_button" id="btn-add">Add</button></td>
						</tr>
						</table>
						</div>					
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