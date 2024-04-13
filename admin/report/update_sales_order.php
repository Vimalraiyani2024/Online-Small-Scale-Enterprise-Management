<?php include_once("header.php"); ?>
<?php
	if(isset($_REQUEST['cid']))
	{
		$rs=mysql_query("select a.sales_order_id,customer_name,order_date,reference,reference_date,delivery_date ,remark,tax from sales_order_master a,customer_master b where a.customer_id=b.customer_id and a.is_deleted='0'")or die(mysql_error());
		$row=mysql_fetch_array($rs);		
		$rs1=mysql_query("select * from sales_order_detail where sales_order_id='$row[0]' order by sales_order_detail_id desc")or die(mysql_error());		
	}
?>
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
</script>
<form action="" method="POST" id="form1">		
<div id="update_panel">			
	
	<a href="?close=2" id="close-box">Close</a>
	<h3>Edit Sales Order -<?php echo $row[0]; ?></h3>				
				<div class="table-responsive">
			  	<table class="table table">
			  	<tbody>
				
				<tr>
					<td>Customer<input type="hidden" value="<?php echo $row[0]; ?>" name="order_no" /></td>
					<td><input type="text" class="form-control" value="<?php echo ucwords($row['customer_name']); ?>" disabled="disabled"/>
					</td>
					<td>Order Date</td>
					<td><input type="text" id="sale_quo_date" disabled="disabled" class="form-control"  name="order_date"  value="<?php echo date("d-m-Y",strtotime($row['order_date'])); ?>"  required/></td>								
				</tr>
				<tr>					
					<td>Reference</td>
					<td> <input class="form-control" name="reference" type="text" disabled="disabled" value="<?php echo $row['reference']; ?>" placeholder="Reference" required/></td>	
					<td>Reference Date</td>
					<td><input type="text" id="sale_ref_quo_date" class="form-control" disabled="disabled"  name="ref_date" value="<?php echo date("d-m-Y",strtotime($row['reference_date'])); ?>"  required/></td>								
				</tr>
				<tr>				  	
					<td>Delivery Date</td>
					<td><input type="text" id="sale_exp_quo_date" class="form-control" disabled="disabled"  name="delivery_date" value="<?php echo date("d-m-Y",strtotime($row['delivery_date'])); ?>"   required/></td>									
				  	<td>Tax </td>
					<td>		<input class="form-control" type="text" disabled="disabled" value="<?php	 $a=explode(",",$row['tax']); 	 echo $a[2]." ".$a[0]." %"; ?>"  />
					 </td>
				</tr>
				<tr>
					<td>Remark</td>
					<td colspan="3"><textarea class="form-control"  disabled="disabled" placeholder="Remark" name="remark" required><?php echo $row['remark']; ?></textarea></td>
				</tr>	
				<tr>
					<Td colspan="4">	
					<div class="table-responsive">											
  					<table id="item_detail" class="table">
						<thead>
				 		<tr>
							<th>ITEM</th>												
							<th>DESCRIPTION</th>
							<th style="text-align:right;" width="13%">UNIT PRICE</th>									
							<th style="text-align:right;">QTY</th>
							<th colspan="2" style="text-align:right">TOTAL</th>
						</tr>
						</thead>
						<tr>
							<td>										
								<select name="item_name1" id="item_name" class="form-control" onChange="showData(this);">
								<option value="" selected="selected">Select Item</option>
								<?php 
									$rs=mysql_query("select *from product_master")or die(mysql_error());
									while ($row = mysql_fetch_array($rs )) 
 						    			echo "<option value=".$row["item_id"].">". $row["item_name"]."</option>";
								?>  
								</select>											
							</td>
							<td><div id="item_desc"></div></td>
							<td align="right">
							<input type="text" class="form-control" style="background:none; border:none;cursor:default;border-color:#FFFFFF;border-radius:0" id="item_price" name="item_price" disabled="disabled" style="text-align:right;"/></td>
							<td  align="right"><input class="form-control" name="item_quantity" onkeypress="return FixNumber(this.value,5);" onkeydown="return isNumberKey(this);" type="text" id="item_quantity" style="text-align:right; width:80px;" /></td>						
							<td colspan="2" style="text-align:right"><button name="add_item_sales_orderz" id="btn-add" type="submit">Add Item</button></td>
						</tr>
							<?php
							while($row1=mysql_fetch_array($rs1))
							{														
							echo '<tr><td>'.$row1['item_name'].'</td><td><div>'.$row1['item_desc'].'</div></td><td style="text-align:right;">'.$row1['item_price'].'</td><td style="text-align:right;">'.$row1['item_qty'].'</td><td style="text-align:right;">'.$row1['item_price']*$row1['item_qty'].'</td><td><a href="?cid='.$row1[0].'&delete=del_item_so" name="del" class="btn-delete">x</a></td></tr>';
					}
					?>
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

</div>