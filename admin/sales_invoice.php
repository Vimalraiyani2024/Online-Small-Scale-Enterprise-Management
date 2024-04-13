<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4  id="title">Sales Invoice</h4>
	<a href="#modal1" id="btn-create">Create </a><br /><br />
  <div class="table-responsive"> 
   	 <table class="table table-striped">
      <thead>
        <tr>
		 <th  width="6%" style="text-align:right"><b id="b-title">Sr. No</b></th>
          <th  width="10%"><b id="b-title">Invoice No.</b></th>
          <th width="13%"><b id="b-title">Invoice Date</b></th>
		  <th><b id="b-title">Customer</b> </th>
		  <th><b id="b-title">Reference</b></th>
		  <th><b id="b-title">Ref. Date</b></th>
		  <th style="text-align:right" width="13%"><b id="b-title">Amount</b></th>		  
		  <th colspan="2"></th>
        </tr>
      </thead>
      <tbody>
		  <?php
		echo "<tr>";
		$i=1;	 
		$rs=mysql_query("select a.invoice_id,customer_name,invoice_date,Reference,ref_date,tax,(select sum(item_price*item_qty) from sales_detail where invoice_id=a.invoice_id) as total from sales_master a,customer_master b where  a.customer_id=b.customer_id and a.is_deleted='0' order by a.entry_date desc")or die(mysql_error());	
	  while($row=mysql_fetch_array($rs))
	  {
	    $a=explode(",",$row['tax']);
		echo '<td style="text-align:right">'.$i++.'</td>';
	  	echo '<td><a href="sales.php?tmpid='.$row['invoice_id'].'&&list=invoice">'.$row['invoice_id'].'</a></td>';
		echo "<td>".date("d-m-Y",strtotime($row['invoice_date']))."</td>";
	 	echo "<td width=30%>".$row['customer_name']."</td>";
		echo "<td>".$row['Reference']."</td>";
	  	echo "<td>".date("d-m-Y",strtotime($row['ref_date']))."</td>";
		$tmp=$row['total']+$row['total']*($a[0]/100)+($row['total']*$a[1]/100);
		echo'<td align="right">'.number_format($tmp,2).'</td>';	
		echo'<td><a href="#id='.$row['invoice_id'].'&update=sales_invoice" <i class="fa fa-edit"></i></a></td>';				
		echo'<td><a href="?print=sales_invoice&id='.$row['invoice_id'].'" <i class="fa fa-print"></i></a></td></tr>';							
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>
</form>
<?php 
	include_once("model/add_sales_invoice.php");
 ?>

