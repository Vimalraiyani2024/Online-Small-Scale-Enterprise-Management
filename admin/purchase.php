<?php include_once("header.php"); 
	if(isset($_SESSION['ossem_user_id'])){
?>
<div id="main">
	<div id="left_menu">
		<div id="cssmenu"> 
		<ul>
		   <li class='has-sub'><a href='#'><span>Purchase</span></a>
			  <ul>
				 <li><a href='purchase.php?pid=1'><span>Supplier Master</span></a></li>
				 <li><a href='purchase.php?pid=2'><span>Purchase Order</span></a></li>
				 <li class='last'><a href='purchase.php?pid=3'><span>Quotations</span></a></li>
			  </ul>
		   </li>
		   <li class='has-sub'><a href='#'><span>Item</span></a>
			  <ul>
				 <li><a href='purchase.php?pid=4'><span>Item Master</span></a></li>
			  </ul>
		   </li>
			<li class='has-sub'><a href='#'><span>Purchase Invoice</span></a>
			  <ul>
				 <li><a href='purchase.php?pid=5'><span>Purchase Invoice</span></a></li>
				  <li class='last'><a href='purchase.php?pid=6'><span>Purchase Return</span></a></li>
			  </ul>
		   </li>
			<li class='has-sub'><a href='#'><span>Reports</span></a>
			  <ul>
				 <li><a href='purchase.php?pid=supplier_register'><span>Supplier List</span></a></li>
				 <li><a href="purchase.php?pid=purchase_by_date"><span>Total Purchase by Date</span></a></li>
				 <li><a href="purchase.php?pid=purchase_supplier_wise"><span>Total Purchase by Supplier</span></a></li>
				 <li><a href="purchase.php?pid=item_register"><span>Item List</span></a></li>
				 <li><a href="purchase.php?pid=purchase_register"><span>Purchase Register</span></a></li>					 
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
				include_once("purchase_quotations.php");
			if($_REQUEST['close']=='2')
				include_once("purchase_order.php");
			if($_REQUEST['close']=='purchase')
				include_once("supplier_list.php");
				
			if($_REQUEST['close']=='c_invoice')
				include_once("purchase_invoice.php");
		
			if($_REQUEST['close']=='c_pur_return')
				include_once("purchase_return.php");
										
		}
		else if(isset($_REQUEST['sid']) && $_REQUEST['list']=='sup_del')
		{
			$i=$_REQUEST['sid'];			
			mysql_query("update supplier_master set is_deleted='1' where supplier_id='$i'")or die(mysql_error());
			include_once("supplier_list.php");	
		}
		else if(isset($_REQUEST['sid']))
		{
			$i=$_REQUEST['sid'];			
			if( $_REQUEST['list']=="sup_view")
			{				
				include_once("supplier_detail.php");	
			}
		}
		else if(isset($_REQUEST['print']) && isset($_REQUEST['id']))
		{
			$id=$_REQUEST['id'];
			if($_REQUEST['print']=='purchase_order')	
			{			
				echo ' <script language="javascript"> window.open("../print/print_purchase_order.php?tmpid='.$id.'","Purchase Order window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				echo '<meta http-equiv="refresh" content="0;url=purchase.php?pid=2"> ';
			}
			else if($_REQUEST['print']=='purchase_quotation')	
			{			
				echo ' <script language="javascript"> window.open("../print/print_purchase_quotation.php?tmpid='.$id.'","Purchase Quotation window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				echo '<meta http-equiv="refresh" content="0;url=purchase.php?pid=3"> ';	
			}
			else if($_REQUEST['print']=='purchase_return')	
			{
				echo ' <script language="javascript"> window.open("../print/print_purchase_return.php?tmpid='.$id.'","Purchase Return window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				echo '<meta http-equiv="refresh" content="0;url=purchase.php?pid=6"> ';	
			}
		else if($_REQUEST['print']=='purchase_invoice')	
			{
				echo ' <script language="javascript"> window.open("../print/print_purchase_invoice.php?tmpid='.$id.'","Purchase Invoice window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
				echo '<meta http-equiv="refresh" content="0;url=purchase.php?pid=5"> ';	
			}
		}
		else if(isset($_REQUEST['tmpid']))
		{
			if($_REQUEST['list']=="pur_quo")
				include_once("/report/view_pur_quotation.php");

			if($_REQUEST['list']=="view_pur_order")
				include_once("/report/view_pur_order.php");		
				
			if($_REQUEST['list']=="view_invoice")
				include_once("/report/view_pur_invoice.php");	
				
			if($_REQUEST['list']=="view_pur_return")
				include_once("/report/view_pur_return.php");		
		}
		else if(isset($_REQUEST['del_id'])&& $_REQUEST['list']=='pur_invoice_del')
		{
			$i=$_REQUEST['del_id'];
			mysql_query("update purchase_master set is_deleted='1' where pur_id='$i'")or die(mysql_error());
			mysql_query("update purchase_detail set is_deleted='1' where pur_id='$i'")or die(mysql_error());
			include_once("purchase_invoice.php");	
		}
		else if(isset($_REQUEST['pid']))
		{						
			if($_REQUEST['pid']=="1")
				include_once("supplier_list.php");	
			if($_REQUEST['pid']=="2")
				include_once("purchase_order.php");
			if($_REQUEST['pid']=="3")
				include_once("purchase_quotations.php");
			if($_REQUEST['pid']=="4")
				include_once("product_list.php");			
			if($_REQUEST['pid']=="5")
				include_once("purchase_invoice.php");	
			if($_REQUEST['pid']=="6")
				include_once("purchase_return.php");
				
			if($_REQUEST['pid']=="supplier_register")
				include_once("/report/supplier_register.php");
			
			if($_REQUEST['pid']=="purchase_by_date")
				include_once("/report/purchase_by_date.php");	
	
			if($_REQUEST['pid']=="purchase_supplier_wise")
				include_once("/report/purchase_supplier_wise.php");
			
			if($_REQUEST['pid']=="purchase_register")
				include_once("/report/purchase_register.php");	
			if($_REQUEST['pid']=="item_register")
				include_once("/report/product_register.php");									
		}
		else
			include_once("dashboard.php");
	?>		
	</div>	
</div>
<?php
} 
	include_once("footer.php"); 
?>