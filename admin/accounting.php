<?php include_once("header.php"); ?>
<div id="main">
	<div id='left_menu'>
		<div id='cssmenu'>
			<ul>			
			   <li class='has-sub'><a href=''><span>Account Info</span></a>
				  <ul>
					 <li><a href='accounting.php?aid=1'><span>Groups </span></a></li>
					 <li class='last'><a href='accounting.php?aid=2'><span>Ledger</span></a></li>
				  </ul>
			   </li>
			   <li class='has-sub'><a href='#'><span>Voucher Entry</span></a>
				  <ul>
					 <li><a href='accounting.php?aid=3'><span>Receipt Entry</span></a></li>
					 <li><a href='accounting.php?aid=4'><span>Payment Entry</span></a></li>
					 <li><a href='accounting.php?aid=5'><span>Journal Entry</span></a></li>				
					  <li class='last'><a href='accounting.php?aid=6'><span>Contra Entry</span></a></li>
				  </ul>
			   </li>
				<li class='has-sub'><a href='#'><span>Inventory Entry</span></a>
				  <ul>
					 <li><a href='accounting.php?aid=7'><span>Sales Entry</span></a></li>
					  <li class='last'><a href='accounting.php?aid=8'><span>Purchase Entry</span></a></li>
				  </ul>
			   </li>
			    <li class='has-sub'><a href='#'><span>Bank and Cash</span></a>
				  <ul>
					 <li><a href='accounting.php?aid=9'><span>Bank Statement</span></a></li>
					  <li class='last'><a href='accounting.php?aid=10'><span>Cash Register</span></a></li>
				  </ul>
			   </li>
				<li class='has-sub'><a href='#'><span>Reports</span></a>
				  <ul>
<!--					 <li><a href="accounting.php?aid=10"><span>Trial Balance Sheet</span></a></li>-->
					 <li><a href="accounting.php?aid=11"><span>Profit-Lost</span></a></li>					 				
					 <li><a href='accounting.php?aid=12'><span>Balance Sheet</span></a></li>				
				  </ul>
			   </li>
			</ul>
		</div>
	</div>
	<div id="content-box">	
<?php
if(isset($_REQUEST['aid']))
	{
	
		if($_REQUEST['aid']=="1")
			include_once("group_list.php");
		else if($_REQUEST['aid']=="2")
			include_once("ledger_list.php");
		else if($_REQUEST['aid']=="3")
			include_once("receipt_list.php");
		else if($_REQUEST['aid']=="4")
			include_once("payment_list.php");
		else if($_REQUEST['aid']=="5")
			include_once("journal_list.php");
		else if($_REQUEST['aid']=="6")
			include_once("contra_list.php");
		else if($_REQUEST['aid']=="7")
			include_once("sales_entry_list.php");
		else if($_REQUEST['aid']=="8")
			include_once("purchase_entry_list.php");	
		else if($_REQUEST['aid']=="9")
			include_once("bank_list.php");
		else if($_REQUEST['aid']=="10")
			include_once("report/cash_regi.php");
		else if($_REQUEST['aid']=="11")
			include_once("report/profitloss.php");
		else if($_REQUEST['aid']=="12")
			include_once("balancesheet.php");
		
	}
	else if(isset($_REQUEST['bank']))
	{
		include_once("report/bank_statement.php");
	}
	else if(isset($_REQUEST['ledger']))
	{
		include_once("report/ledger_statement.php");
	}
	else if(isset($_REQUEST['print']) && isset($_REQUEST['id']))
	{
		$id=$_REQUEST['id'];
		if($_REQUEST['print']=='bank_statement')	
		{			
			echo ' <script language="javascript"> window.open("../print/print_bank_statement.php?tmpid='.$id.'","Bank Statement window","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
			//echo '<meta http-equiv="refresh" content="0;url=accounting.php?bank='.$id.'"> ';
		}
	}
	else
			include_once("dashboard.php");
	?>
</div>
</div>
<?php
include_once("footer.php");
?>