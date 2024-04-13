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
			data: "fetch_cust_id="+cust_id,
			cache: false,
			beforeSend: function () { 
				$('#order_no').html('<img src="loader.gif" alt="" width="24" height="24">');
			},
			success: function(html) {  
				$("#order_no").html(html);
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
			html='<tr id="tr'+ itemCount + '"><td><input  type="text" readonly id="item_name[]" name="item_name[]" value="'+item_name+'" class="form-control, text-readonly"/></td><td><input type="text" name="item_desc[]" value="'+item_desc+'" style="border-style:none;" readonly class="form-control, text-readonly" style="width:auto;"/></td><td><input type="text" style="text-align:right;max-width:100px" readonly name="item_price[]" id="item_price[]" value="'+item_price+'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:60px" readonly   id="item_qty[]" name="item_qty[]" value="'+item_qty+'" class="form-control, text-readonly"/></td><td><input  type="text"  style="text-align:right;max-width:60px" readonly name="total[]" value="'+total+'" class="form-control, text-readonly"/></td><td><input type="button" class="btn-delete"  id="' + itemCount + '" value="x"></td><input type="hidden" name="item_id[]" value="'+item_id+'"/></tr>';						
			
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
	<div id="modal1">
		<div class="modal-content">		
			<div class="cf footer"><h2>Create New Sales Invoice</h2></div>
			<div id="btn-header">
				<a href="#" id="close-box">Close</a>
				<?php 
				if($_SESSION['ossem_user_type']==1)
					echo '<button type="submit" disabled="disabled" name="add_sales_invoice" id="btn-popup">Save</button>';
				else
					echo '<button type="submit" name="add_sales_invoice" id="btn-popup">Save</button>';
				?>
			</div>
			<div class="copy">				
				<div class="table-responsive">									
			  	<table class="table table">
			  	<tbody>
				  <tr>
				  <?php
					  $year=date("y");						
						$current_date=date("d-m");
						$fak_date="31-03";
						if($fak_date < $current_date)
							$year=date("y")+1;
						else
							$year=date("y")-1;
						
						$rs=mysql_query("select invoice_id from  sales_master order by invoice_id desc limit 1")or die(mysql_error());
						$row=mysql_fetch_array($rs);
						$i=substr($row[0],6,4);
						if($i==0)
							$i=1;
						else
							$i++;
						$a=str_pad($i,4,"0",STR_PAD_LEFT);																											
						$word=substr(strtoupper($_SESSION['ossem_enterprise_name']),0,2);
						$invoice_id=$word."".$year."".date("y")."".$a; 
						?>
				  	<td width="15%">Invoice No.</td>
					<td><?php echo $invoice_id; ?></td>
				    <td colspan="2"></td><input type="hidden" value="<?php echo $invoice_id; ?>" name="invoice_id" />					
				</tr>
				<tr>
					<td>Customer</td>
					<td>					
						<select id="customer_id" name="customer_id" class="form-control" onchange="fetch_sales_invoice(this.value)" required>
							<option selected="selected"></option>
							<?php 					
								$rs=mysql_query("select *from customer_master where is_deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($rs))					
									echo'<option value='.$row['customer_id'].'>'.ucwords($row['customer_name']).'</option>';								
						    ?>
						</select>					
					</td>
					<td>Invoice Date</td>
					<td><input type="text" id="sale_quo_date" readonly class="form-control"  name="invoice_date"  value="<?php echo date("d-m-Y"); ?>"  required/></td>								
				</tr>
				<tr>
					<td>Order No.-Date</td>
					<td>
						<div id="order_no"></div>
					</td>
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
					<td>Reference</td>
					<td> <input class="form-control" id="reference" name="reference" type="text" placeholder="Reference" required/></td>	
					<td>Reference Date</td>								
					<td><input type="text" id="sale_ref_quo_date" class="form-control" readonly="readonly"  name="ref_date" value="<?php echo date("d-m-Y"); ?>"  required/></td>								
				</tr>						
				<tr>
					<td>Dispatch By</td>
					<td><input type="text" class="form-control" name="despatch_by" placeholder="Dispatch By"/></td>
					<td>Dispatch Date</td>
					<td><input type="text" class="form-control" id="sale_exp_quo_date" name="despatch_date" placeholder="Dispatch By" value="<?php echo date("d-m-Y"); ?>" readonly="readonly"/></td>
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
 						    			echo "<option value=".$row["item_id"].">". ucwords($row["item_name"])."</option>";
								?>  
								</select>											
							</td>
							<td><div id="item_desc" style="width:auto;"></div></td>
							<td style="text-align:right;"><input type="text" class="form-control" style="background:none; border:none;cursor:default;border-color:#FFFFFF;border-radius:0" id="item_price" name="item_price" disabled="disabled" style="text-align:right;max-width:100px"/></td>
							<td style="text-align:right;"><input class="form-control" name="item_quantity" type="text" id="item_quantity" style="text-align:right;max-width:90px"  onkeydown="return FixNumber(this.value,8);"   onkeypress="return isNumberKey(this);"/></td>						
							<td><button class="add_field_button" id="btn-add">Add</button></td>
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
