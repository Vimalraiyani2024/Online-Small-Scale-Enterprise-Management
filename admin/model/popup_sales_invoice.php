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
	<div id="modal11">
		<div class="modal-content">		
			<div class="cf footer">
				<h2>Create New Sales Invoice</h2>
			</div>
			<div id="btn-header">
				<a href="#" class="btn">Close</a>
				<button type="submit" name="add_sales_order" id="btn-popup">Save</button>
			</div>
			<div class="copy">				
				<div class="table-responsive">
			  	<table class="table table">
			  	<tbody>
				<tr><a href="#modal">OMG</a>
					<td>Customer</td>
					<td>					
						<select id="customer_id" name="customer_id" class="form-control" required>
							<option selected="selected"></option>
							<?php 					
								$rs=mysql_query("select *from customer_master where is_deleted='0'")or die(mysql_error());
								while($row=mysql_fetch_array($rs))					
									echo'<option value='.$row['customer_id'].'>'.$row['customer_name'].'</option>';								
						    ?>
						</select>					
					</td>
					<td>Sales Date</td>
					<td><input type="text" id="sale_quo_date" readonly class="form-control"  name="order_date"  value="<?php echo date("d/m/Y"); ?>"  required/></td>								
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
<?php include_once("add_sales_invoice.php"); ?>