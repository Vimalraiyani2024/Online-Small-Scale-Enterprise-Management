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
    var max_fields      = 100; 
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button"); 
    
    var x = 1; 
    $(add_button).click(function(e)
	{ 
        e.preventDefault();
        if(x < max_fields)
		{ 
            x++; 
			item_name=$("#item_name option:selected").text();
			item_desc= $("#item_desc").html();
			item_price= $("#item_price").val();
			item_qty=$("#item_quantity").val();
			total=parseInt(item_price) * parseInt(item_qty);
            
			$(wrapper).append('<div><table class="table table-bordered"><td><input  type="text" style="border-style:none;" readonly  id="item_id[]" name="item_id[]" value="'+item_name+'"/></td><td><input type="text" name="item_desc[]" value="'+item_desc+'" style="border-style:none;" readonly"/></td><td><input type="text" style="border-style:none;" readonly name="item_price[]" id="item_price[]" value="'+item_price+'"/></td><td><input  type="text"  style="border-style:none;" readonly   id="item_qty[]" name="item_qty[]" value="'+item_qty+'"/></td><td><input  type="text"  style="border-style:none;" disabled   id="test" name="total[]" value="'+total+'" /></td><td><a href="#" class="remove_field">x</a></td></table></div>');
        }
    });    
    $(wrapper).on("click",".remove_field", function(e)
	{
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
<form action="" method="POST" id="form1">
	<div id="modal">
		<div class="modal-content">		
			<div class="cf footer">
				<h2>Create New Sales Quotations</h2>
			</div>
			<div id="btn-header">
				<a href="#" class="btn">Close</a>
				<button type="submit" name="add_quotation" id="btn-popup">Save</button>
			</div>
			<div class="copy">				
				<div class="table-responsive">
			  	<table class="table table-bordered">
			  	<tbody>
				  <tr>
				  	<td width="15%">Quotation No.</td>
					<?php 
						$year=date("y");						
						$current_date=date("d-m");
						$fak_date="31-03";
						if($fak_date < $current_date)
							$year=date("y")+1;
						else
							$year=date("y")-1;
						
						$rs=mysql_query("select sales_qua_id from  sales_qua_master order by sales_qua_id desc limit 1")or die(mysql_error());
						$row=mysql_fetch_array($rs);
						$i=substr($row[0],10,4);
						if($i==0)
							$i=1;
						else
							$i++;
						$a=str_pad($i,4,"0",STR_PAD_LEFT);																											
						$word=substr(strtoupper($_SESSION['enterprise_name']),0,2);
						$qid="QUO".$word."".$year."".date("y")."".$a; 
					?><input type="hidden" value="<?php echo $_SESSION['db_name']; ?>" name="db" id="db"/>
					<td colspan="3"><?php echo $qid; ?></td><input type="hidden" value="<?php echo $qid; ?>" name="qid" />
				</tr>
				<tr>
					<td rowspan="5">Customer</td>
					<td rowspan="5">					
						<select id="customer_id" name="customer_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 					
								$rs=mysql_query("select *from customer_master")or die(mysql_error());
								while($row=mysql_fetch_array($rs))					
									echo'<option value='.$row['customer_id'].'>'.$row['customer_name'].'</option>';								
						    ?>
						</select>					
					</td>
					<td>Quotation Date</td>
					<td><input class="form-control" id="quo_date" name="quo_date" type="text"  placeholder="Quotation Date"/></td>
				</tr>
				<tr>					
					<td>Reference Date</td>
					<td><input class="form-control" name="ref_date" type="text" placeholder="Reference Date"/></td>								
				  </tr>
				<tr>				  	
				  	<td>Reference</td>
					<td> <input class="form-control" name="reference" type="text" placeholder="Reference"/></td>								
				</tr>
				<tr>				  	
					<td>Expiry Date</td>
					<td><input class="form-control" name="exp_date" type="text" placeholder="Expiry Date" /></td>							
				</tr>
				<tr> 
				  	<td>Tax </td>
					<td>
						<select id="tax" class="form-control" name="tax" required>
							<option value="3" selected="selected">Select TAX</option>
							<?php
								$rs1=mysql_query("select *from tax_master")or die(mysql_error());
								while($row=mysql_fetch_array($rs1))
									echo'<option value='.$row['tax_per'].','.$row['additional_per'].','.$row['tax_name'].'>'.$row['tax_name'].'</option>';
							?>
						</select>		
					</td>
				</tr>								
				<tr>
					<Td colspan="4">
						
							<div class="input_fields_wrap">
  <table class="table table-striped">
						<thead>
				 		<tr>
							<th>PRODUCT</th>
							<th>DESCRIPTION</th>	
							<th>UNIT PRICE</th>													
							<th>QTY</th>
							<th></th>
						</tr>
						</thead>
						<tr>
							<td>										
								<select name="item_name" id="item_name" class="form-control" onChange="showData(this);">
								<option value="" selected="selected">Select Product</option>
								<?php 
									$rs=mysql_query("select *from product_master")or die(mysql_error());
									while ($row = mysql_fetch_array($rs )) 
 						    			echo "<option value=".$row["item_id"].">". $row["item_name"]."</option>";
								?>  
								</select>											
							</td>
							<td><div id="item_desc"></div></td>
							<td style="text-align:right;"><input type="text" class="form-control" id="item_price" name="item_price" disabled="disabled"/></td>
							<td style="text-align:right;"><input class="form-control" name="item_quantity" type="text" id="item_quantity" /></td>						
							<td><button class="add_field_button" id="btn">Add</button></td>
						</tr>
							</div>	
						</td>
		
				</tr>
				<tr>
					<td colspan="4" align="right"><div id="total_tax" style="margin-right:5%; font-weight:300;"></div></td>
				</tr>
				<tr>
					<td colspan="4" align="right"><div id="total" style="margin-right:5%; font-weight:600;"></div></td>
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