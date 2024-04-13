<?php 
	include_once("header.php");
	if(isset($_SESSION['ossem_user_id'])&isset($_SESSION['ossem_user_type']))
	{
		if($_SESSION['ossem_user_id']!=10)
		{
?>
<div id="main">
<div id="left_menu">
	<div id='cssmenu'>
		<ul>			 
		   <li class='has-sub'><a href='#'><span>Sales</span></a>
			  <ul>
				 <li><a href='sales.php?sid=1'><span>Customer Master</span></a></li>
				 <li><a href='sales.php?sid=2'><span>Sales Order</span></a></li>
				 <li class='last'><a href='sales.php?sid=3'><span>Quotations</span></a></li>		
			  </ul>
		   </li>
		   <li class='has-sub'><a href='#'><span>Product</span></a>
			  <ul>
				 <li><a href='sales.php?sid=4'><span>Product Master</span></a></li>
			  </ul>
		   </li>
			<li class='has-sub'><a href='#'><span>Sales Invoice</span></a>
			  <ul>
				 <li><a href='sales.php?sid=5'><span>Sales Invoice</span></a></li>
				  <li class='last'><a href='sales.php?sid=6'><span>Sales Return</span></a></li>
			  </ul>
		   </li>
			<li class='has-sub'><a href='#'><span>Reports</span></a>
			  <ul>
				 <li><a href="sales.php?sid=customer_register"><span>Customer List</span></a></li>
				 <li><a href="sales.php?sid=sales_by_date"><span>Total Sales by Date</span></a></li>
				 <li><a href="sales.php?sid=sales_customer_wise"><span>Total Sales by Customer</span></a></li>
				 <li><a href="sales.php?sid=product_register"><span>Product List</span></a></li>
				 <li><a href="sales.php?sid=sales_register"><span>Sales Register</span></a></li>					
			  </ul>
		   </li>
		</ul>
	</div>
</div>
	<div id="content-box">
		<?php
		if(isset($_REQUEST['close']))
		{	
			if($_REQUEST['close']=='1')
				include_once("quotations.php");
			if($_REQUEST['close']=='2')
				include_once("sales_order.php");
			if($_REQUEST['close']=='3')
				include_once("customer_list.php");
			if($_REQUEST['close']=='c_invoice')
				include_once("sales_invoice.php");
			if($_REQUEST['close']=='sales')
				include_once("dashboard.php");				
			if($_REQUEST['close']=='c_return_invoice')
				include_once("sales_return.php");
			if($_REQUEST['close']=='cdetail')
				include_once("customer_detail.php");				
		}
		else if(isset($_REQUEST['update'])&&isset($_REQUEST['cid']))
		{
			$i=$_REQUEST['cid'];			
			if($_REQUEST['update']=="customer")			
				include_once("report/update_customer.php");
			else if($_REQUEST['update']=="sales_order")			
				include_once("report/update_sales_order.php");
			else if(isset($_REQUEST['update'])=="sales_order")						
				include_once("model/update_sales_order.php");	
							
		}
		else if(isset($_REQUEST['delete'])&isset($_REQUEST['cid']))	
		{
			$i=$_REQUEST['cid'];			
			if($_REQUEST['delete']=="del_item_so")
			{	
				mysql_query("delete from sales_order_detail where sales_order_detail_id='$i'")or die(mysql_error());
				include_once("report/update_sales_order.php");
			}	
		}
		else if(isset($_REQUEST['print']) && isset($_REQUEST['id']))
		{
			$id=$_REQUEST['id'];
			if($_REQUEST['print']=='sales_order')	
			{			
				echo ' <script language="javascript"> window.open("../print/print_sales_order.php?tmpid='.$id.'","Sales Order window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				echo '<meta http-equiv="refresh" content="0;url=sales.php?sid=2"> ';
			}
			if($_REQUEST['print']=='sales_quo')	
			{			
				echo ' <script language="javascript"> window.open("../print/print_sales_quotation.php?tmpid='.$id.'","Sales Quotation window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				//include_once("quotations.php");		
				echo '<meta http-equiv="refresh" content="0;url=sales.php?sid=3">';
			}
			if($_REQUEST['print']=='sales_invoice')	
			{			
				echo ' <script language="javascript"> window.open("../print/print_sales_invoice.php?tmpid='.$id.'","Sales Invoice window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				//include_once("sales_invoice.php");		
				echo '<meta http-equiv="refresh" content="0;url=sales.php?sid=5">';
			}
			if($_REQUEST['print']=='sales_return')	
			{			
				echo ' <script language="javascript"> window.open("../print/print_sales_return.php?tmpid='.$id.'","Sales Return window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				//include_once("sales_return.php");	
				echo '<meta http-equiv="refresh" content="0;url=sales.php?sid=6">';	
			}
		}
		else if(isset($_REQUEST['view']))
		{
			if($_REQUEST['view']=="cust_view")
				include_once("customer_detail.php");	
		}
		else if(isset($_REQUEST['tmpid']))
		{			
			if($_REQUEST['list']=="sales_quo")
				include_once("/report/view_quotation.php");	
			
			if($_REQUEST['list']=="view_sales_order")
				include_once("/report/view_sales_order.php");	
					
			if($_REQUEST['list']=="invoice")
				include_once("/report/view_sales_invoice.php");
				
			if($_REQUEST['list']=="view_sales_return")
				include_once("/report/view_sales_return.php");				
		}
		
		else if(isset($_REQUEST['iid'])&& $_REQUEST['list']=='sales_del')
		{
			$i=$_REQUEST['iid'];
			mysql_query("update sales_master set is_deleted='1' where invoice_id='$i'")or die(mysql_error());
			include_once("sales_invoice.php");	
		}
		
		else if(isset($_REQUEST['did'])&& $_REQUEST['list']=='sales_quo_del')
		{
			$i=$_REQUEST['did'];
			mysql_query("update sales_qua_master set is_deleted='1' where sales_qua_id='$i'")or die(mysql_error());
			include_once("quotations.php");	
		}
		else if(isset($_REQUEST['did']))
		{
			$i=$_REQUEST['did'];
			if($_REQUEST['list']=='sales_order_del')
			{			
				mysql_query("delete from sales_order_detail where sales_order_id='$i'")or die(mysql_error());
				mysql_query("delete from sales_order_master where sales_order_id='$i'")or die(mysql_error());		
				include_once("sales_order.php");
			}
			if($_REQUEST['list']=='sales_return_del')
			{
				mysql_query("update  sales_return_detail set is_deleted='1' where sales_return_id='$i'")or die(mysql_error());
				mysql_query("update  sales_return set is_deleted='1' where sales_return_id='$i'")or die(mysql_error());		
				include_once("sales_return.php");
			}
		}
		
		else if(isset($_REQUEST['cid'])&& isset($_REQUEST['list']) && $_REQUEST['list']=='cust_del')
		{
			$i=$_REQUEST['cid'];
			mysql_query("update customer_master set is_deleted='1' where customer_id='$i'")or die(mysql_error());
			include_once("customer_list.php");	
		}				
		
		else if(isset($_REQUEST['sid']))
		{						
			if($_REQUEST['sid']=="1")
				include_once("customer_list.php");	
			if($_REQUEST['sid']=="2")
				include_once("sales_order.php");
			if($_REQUEST['sid']=="3")
				include_once("quotations.php");
			if($_REQUEST['sid']=="4")
				include_once("product_list.php");			
			if($_REQUEST['sid']=="5")
				include_once("sales_invoice.php");	
			if($_REQUEST['sid']=="6")
				include_once("sales_return.php");	
				
			if($_REQUEST['sid']=="product_register")
				include_once("report/product_register.php");					
									
			if($_REQUEST['sid']=="sales_customer_wise")
				include_once("report/sales_customer_wise.php");
				
			if($_REQUEST['sid']=="sales_by_date")
				include_once("report/sales_by_date.php");					
													
			if($_REQUEST['sid']=="customer_register")
				include_once("report/customer_register.php");	
			if($_REQUEST['sid']=="sales_register")
				include_once("report/sales_register.php");					
		}
		else
			include_once("dashboard.php");
		?>			
	</div>
</div>
<?php 
	}
}
include_once("footer.php"); 
?>
