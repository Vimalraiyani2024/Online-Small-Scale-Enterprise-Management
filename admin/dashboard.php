<div id="item_container1">
	<div style= "min-height:50px; height:auto; width:auto">
		<img src="../img/logo.png"  width="150px" height="50px" style="float:left; margin-left:10px; vertical-align:bottom"/>
		<h3 style="margin-left:10px; margin-top:2px">Welcome <?php echo strtoupper($_SESSION['ossem_enterprise_name']); ?> </h3>
	</div>
	
<div id="div-dashboard">
   <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="purchase.php?pid=1"> <img  id="img-dashboard" src="../img/supplier.png"/></a><h1 id="dashboard-heading"><?php echo mysql_num_rows(mysql_query("select *from supplier_master where is_deleted='0'")); ?></h1>
            <div style="text-align:center"><span class="dashboard-text">Total Suppliers</span></div>
        </div>
		<div id="dashboard-bottom">	
		 </div>
    </div>
	 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="sales.php?sid=1"> <img  id="img-dashboard" src="../img/customer.png"/></a><h1 id="dashboard-heading"><?php echo mysql_num_rows(mysql_query("select *from customer_master where is_deleted='0'")); ?></h1>
            <div style="text-align:center"><span class="dashboard-text">Total Customers</span></div>
        </div>
		<div id="dashboard-bottom">
		
		 </div>
    </div>
	
	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="#"> <img  id="img-dashboard" src="../img/Account User Add.jpg"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select * from employee_master");
		 echo mysql_num_rows($rs1); ?> </h1>
            <div style="text-align:center"><span class="dashboard-text">Total Employee</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="sales.php?sid=4"> <img  id="img-dashboard" src="../img/product.png"/></a><h1 id="dashboard-heading"><?php echo mysql_num_rows(mysql_query("select *from product_master")); ?></h1>
            <div style="text-align:center"><span class="dashboard-text">Total Product</span></div>
        </div>
		<div id="dashboard-bottom">
		 	<span class="dashboard-text1">New Product :<?php 
		 	$rs1=mysql_query("select entry_date from product_master")or die(mysql_error());
			$c=0;
		 	while($row=mysql_fetch_array($rs1))
		 	{
		 		if(date("Y-m-d",strtotime($row[0]))==date("Y-m-d"))
					$c+=1;
		 	} 
		 	echo $c;
		 ?></span>
		 </div>
    </div>
	
  	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="purchase.php?pid=5"> <img  id="img-dashboard" src="../img/purchase.png"/></a><h1 id="dashboard-heading">
		   <?php	
		   $total=0.0;
		   $rs=mysql_query("select a.pur_id,(select sum(item_price*item_qty) from purchase_detail where pur_id=a.pur_id) as total,tax from purchase_master a,supplier_master b where  a.supplier_id=b.supplier_id and a.is_deleted='0'")or die(mysql_error());
			while($row=mysql_fetch_array($rs))
	  		{		
			 	$tmp=0.0;
			 	$a=explode(",",$row['tax']);
				$tmp=$row['total']+$row['total']*($a[0]/100)+($row['total']*$a[1]/100);
				$total+=$tmp;
		  }
		  echo number_format($total,2);
	 ?></h1>
           <div style="text-align:center"><span class="dashboard-text">Total Purchase</span></div>
        </div>
		<div id="dashboard-bottom">
		
		 </div>
    </div>
	
		
  	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="sales.php?sid=5"> <img  id="img-dashboard" src="../img/sales.png"/></a><h1 id="dashboard-heading">
		<?php	
		$rs=mysql_query("select tax,(select sum(item_price*item_qty) from sales_detail where invoice_id=a.invoice_id) as total from sales_master a where a.is_deleted='0'")or die(mysql_error());	
		$total=0.0;
	  while($row=mysql_fetch_array($rs))
	  {
	    $a=explode(",",$row['tax']);;
		$tmp=$row['total']+$row['total']*($a[0]/100)+($row['total']*$a[1]/100);
		$total+=$tmp;	
	  }
	  echo number_format($total);
	  ?></h1>
            <div style="text-align:center"><span class="dashboard-text">Total Sales</span></div>
        </div>
		<div id="dashboard-bottom">
		
		 </div>
    </div>

	 	
   	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="accounting.php?aid=4"> <img  id="img-dashboard" src="../img/payment.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select sum(amount) from 

entry_master where entry_type='p'"); $row=mysql_fetch_array($rs1); echo $row[0]; ?></h1>
            <div style="text-align:center"><span class="dashboard-text">Total Payment</span></div>
        </div>
		<div id="dashboard-bottom">
		
		 </div>
    </div>
	
	 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="accounting.php?aid=3"> <img  id="img-dashboard" src="../img/receipt.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select sum(amount) from 

entry_master where entry_type='r'"); $row1=mysql_fetch_array($rs1); echo $row1[0]; ?></h1>
            <div style="text-align:center"><span class="dashboard-text">Total Receipts</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="#"> <img  id="img-dashboard" src="../img/3d_chart.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select item_price*item_qty as sum,month(invoice_date) as dt from 

sales_detail a,sales_master b where a.invoice_id=b.invoice_id and b.is_deleted=0");
$lmssum=0.0;
 while($row=mysql_fetch_array($rs1))
 {
 	if(date("m")-1==$row['dt'])
		$lmssum+=$row[0];
 } 
 echo number_format($lmssum,2); ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Last Month Sales</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
		 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="#"> <img  id="img-dashboard" src="../img/url.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select item_price*item_qty as sum,month(pur_date) as dt from 

purchase_detail a,purchase_master b where a.pur_id=b.pur_id and b.is_deleted=0");
$lmpsum=0.0;
 while($row=mysql_fetch_array($rs1))
 {
 	if(date("m")-1==$row['dt'])
		$lmpsum+=$row[0];
 } 
 echo number_format($lmpsum,2); ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Last Month Purchase</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="sales.php?sid=2"> <img  id="img-dashboard" src="../img/delivery.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select * from sales_order_master where status=0");

 echo mysql_num_rows($rs1); ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Pending Sales Order</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="purchase.php?pid=2"> <img  id="img-dashboard" src="../img/shopping-bag.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select * from pur_order_master where status=0");

 echo mysql_num_rows($rs1); ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Pending Purchase Order</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	
	 <div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="sales.php?sid=6"> <img  id="img-dashboard" src="../img/empty-cart.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select sum(item_qty*item_price) from sales_return a,sales_return_detail b where a.sales_return_id=b.sales_return_id and a.is_deleted=0 and b.is_deleted=0");
$row=mysql_fetch_array($rs1);echo $row[0]; ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Sales Return</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="purchase.php?pid=6"> <img  id="img-dashboard" src="../img/basket-empty.png"/></a><h1 id="dashboard-heading">
		   <?php
		   	$rs=mysql_query("select tax,(select sum(item_price*item_qty) from pur_return_detail where pur_return_id=a.pur_return_id) as total from pur_return a,supplier_master b where  a.supplier_id=b.supplier_id and a.is_deleted='0'")or die(mysql_error());
			$total=0.0;
	while($row=mysql_fetch_array($rs))
	{		
		$a=explode(",",$row['tax']); 
		$tmp=$row['total']+$row['total']*($a[0]/100)+($row['total']*$a[1]/100);
		$total+=$tmp;
	}
	echo number_format($total,2);
?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Purchase Return</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="#"> <img  id="img-dashboard" src="../img/stock.png"/></a><h1 id="dashboard-heading"><?php $rs1=mysql_query("select item_price*item_qty as sum,month(invoice_date) as dt from 

sales_detail a,sales_master b where a.invoice_id=b.invoice_id and b.is_deleted=0");
$lmssum=0.0;
 while($row=mysql_fetch_array($rs1))
 {
 	if(date("m")==$row['dt'])
		$lmssum+=$row[0];
 } echo $lmssum; ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Current Month Sales</span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	<div  id="dashboard-box"> 
   		<div id="dashboard-top">
           <a href="#"> <img  id="img-dashboard" src="../img/credit-cards.png"/></a><h1 id="dashboard-heading">
		   
		   <?php $rs1=mysql_query("select item_price*item_qty as sum,month(pur_date) as dt from 

purchase_detail a,purchase_master b where a.pur_id=b.pur_id and b.is_deleted=0");
$lmssum=0.0;
 while($row=mysql_fetch_array($rs1))
 {
 	if(date("m")==$row['dt'])
		$lmssum+=$row[0];
 } 
 echo $lmssum;; ?>
 </h1>
            <div style="text-align:center"><span class="dashboard-text">Current Month Purchase </span></div>
        </div>
		<div id="dashboard-bottom">
		
		</div>
    </div>
	
	
	
</div>
</div>
<?php	include_once("footer.php"); ?>