<?php
	error_reporting(E_ALL^ E_DEPRECATED);
	$con=$ob->connection();
	if(isset($_SESSION['ossem_db_name']))
		mysql_select_db($_SESSION['ossem_db_name'],$con)or die("Database error ".mysql_error());

	if(isset($_REQUEST['print_profitloss']))
	{
		$from=$_POST['from_date'];
		$to=$_POST['to_date'];
			echo ' <script language="javascript"> window.open("../print/print_profitloss.php?from='.$from.'&to='.$to.'","Profit Loss","location=no,menubar=no,status=no,width=850,height=640,toolbar=no,replace=true")</script>';				
			echo '<meta http-equiv="refresh" content="0;url=accounting.php?aid=11"> ';
	}	
	if(isset($_REQUEST['add_employee']))
	{
		$emp_name=$_POST['emp_name'];
		$doj=date("Y-m-d",strtotime($_POST['join_date']));
		$add=$_POST['address'];
		$add1=$_POST['address1'];
		$phone=$_POST['phone'];
		$mob=$_POST['mob'];
		$email=$_POST['email'];
		$dob=date("Y-m-d",strtotime($_POST['birth_date']));
		$s=$_POST['sex'];
		$mstatus=$_POST['mstatus'];
		$dept=$_POST['dept'];
		$jobtitle=$_POST['jobtitle'];
		$basic=$_POST['salary'];
		$ref=$_POST['ref'];
		$file_name = $_FILES['img_emp']['name'];
		$new_file_name=$_SESSION['ossem_user_id']."".date("j")."".time();	
		$image_name="";								
		if($_FILES["img_emp"]["name"]!="")
		{				
			if((($_FILES["img_emp"]["type"] == "image/gif")|| ($_FILES["img_emp"]["type"] == "image/jpeg")|| ($_FILES["img_emp"]["type"] == "image/jpg")|| ($_FILES["img_emp"]["type"] == "image/png"))&& ($_FILES["img_emp"]["size"] <= 512000)) 
			{
				if($_FILES["img_emp"]["error"] > 0) 
					$image_name="";
				else 
				{
					$path="../emp_img/";				
					$path=$path.$new_file_name.$file_name;				
				 	move_uploaded_file($_FILES["img_emp"]["tmp_name"],$path);
					$image_name=$new_file_name.$file_name;			
	   			}
			} 
			else 
			{
			    echo '<script> alert("File must be include valid format and size");</script>';
				return false;
			}
		}
		
		$add_emp=array($emp_name,$doj,$add,$add1,$phone,$mob,$email,$dob,$s,$mstatus,$dept,$jobtitle,$basic,$ref,$image_name);				
		$ob->insert("employee_master",$add_employee_fields,$add_emp);
		echo '<meta http-equiv="refresh" content="0;url=employee.php?eid=2">';	

	}
	if(isset($_REQUEST['add_department']))
	{
		$dept_name = $_POST['dept_name'];
		$add_dept = array($dept_name);
		$ob->insert("department_master",$add_dept_fields,$add_dept);

	}
	if(isset($_REQUEST['add_entry']))
	{			
		$entry_id = $_POST['entry_id'];
		$entry_date = date("Y-m-d",strtotime($_POST['entry_date']));
		$credit_ledger_id = $_POST['credit_ledger_id'];
		$debit_ledger_id = $_POST['debit_ledger_id'];
		$amount = $_POST['amount'];
		$remark = $_POST['remark'];
		$entry_type = $_POST['entry_type'];
		$add_entry = array($entry_id,$entry_date,$credit_ledger_id,$debit_ledger_id,$amount,$remark,$entry_type);
		$ob->insert("entry_master",$add_entry_fields,$add_entry);
		if($entry_type=='r')
			echo '<meta http-equiv="refresh" content="0;url=accounting.php?aid=3">';
		if($entry_type=='p')
			echo '<meta http-equiv="refresh" content="0;url=accounting.php?aid=4">';
		if($entry_type=='j')
			echo '<meta http-equiv="refresh" content="0;url=accounting.php?aid=5">';
		if($entry_type=='c')
			echo '<meta http-equiv="refresh" content="0;url=accounting.php?aid=6">';
	}
	if(isset($_REQUEST['add_item_sales_order']))
	{
		$order_no=$_POST['order_no'];
		$item_name=$_POST['item_name1'];		
		$item_quantity=$_POST['item_quantity'];
		$rs=mysql_query("select *from product_master where item_id='$item_name'")or die("");
		$row=mysql_fetch_array($rs);
		$rst=mysql_query("select *from sales_order_detail where item_name='".$row['item_name']."'")or die(mysql_error());	

		if (mysql_num_rows($rst)==0)
		{
			$sales_order_detail_fields=array("sales_order_id","item_name","item_desc","item_price","item_qty");			
			$add=array($order_no,$row['item_name'],$row['item_desc'],$row['item_price'],$item_quantity);
			$ob->insert("sales_order_detail",$sales_order_detail_fields,$add);	
		}	
	}
	
	if(isset($_REQUEST['add_pur_invoice']))
	{
		$purchase_id=$_POST['pur_id'];			
		$purchase_date=date("Y-m-d",strtotime($_POST['pur_date']));
		$supplier_id=$_POST['supplier_id'];
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$despatch_by=$_POST['despatch_by'];
		$despatch_date=date("Y-m-d",strtotime($_POST['despatch_date']));
		$remark=$_POST["remark"];		
		$is_deleted=0;
		$entry_date=date("Y-m-d H:i:s");
		$add_purchase=array($purchase_id,$purchase_date,$reference,$ref_date,$supplier_id,$tax,$despatch_by,$despatch_date,$remark,$is_deleted,$entry_date);
		
		$a=explode(",",$_POST['tax']); 
		$ledger_name="";
		if($a[2]=="VAT")
			$ledger_name="Purchase ".$a[0]."%";
		else if($a[2]=="CST")
			$ledger_name="Interstate Purchase ".$a[0]."%";
		
		$temp1=mysql_query("select ledger_id from ledger_master where ledger_name=(select supplier_name from supplier_master where supplier_id=$supplier_id)")or die(mysql_error());		
		$temp2=mysql_query("select ledger_id from ledger_master where ledger_name='$ledger_name'")or die(mysql_error());		
		
		$temp_rs1=mysql_fetch_array($temp1);
		$temp_rs2=mysql_fetch_array($temp2);
		
		$credit_ledger_id=$temp_rs1[0];
		$debit_ledger_id=$temp_rs2[0];
		
		$amount=0.0;
		
		$res1=$ob->insert("purchase_master",$purchase_fields,$add_purchase);
	 	if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
		{
			$item_id=$_POST['item_id'];
			$item_desc=$_POST['item_desc'];
			$item_qty=$_POST['item_qty'];
			$item_price=$_POST['item_price'];
			$item_name=$_POST['item_name'];		
			for($i=0;$i<count($item_name);$i++)
			{
				$amount += $item_qty[$i] * $item_price[$i];
				$add_purchase_detail=array($purchase_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
				$res2=$ob->insert("purchase_detail",$purchase_detail_fields,$add_purchase_detail);	
			}		
		}		
		$add_entry=array($purchase_id,$purchase_date,$credit_ledger_id,$debit_ledger_id,$amount,$remark,$is_deleted);		
		$res3=$ob->insert("pur_entry_master",$purchase_entry_fields,$add_entry);
		echo'<script language="javascript">alert("Record Save Successfully...")</script>';
		echo '<meta http-equiv="refresh" content="0;url=#">';				
	}

	if(isset($_REQUEST['add_sales_invoice']))
	{		
		$invoice_id=$_POST['invoice_id'];			
		$invoice_date=date("Y-m-d",strtotime($_POST['invoice_date']));
		$customer_id=$_POST['customer_id'];
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$despatch_by=$_POST['despatch_by'];
		$despatch_date=date("Y-m-d",strtotime($_POST['despatch_date']));
		$remark=$_POST["remark"];		
		$is_deleted=0;
		$entry_date=date("Y-m-d H:i:s");

		$add_sales=array($invoice_id,$invoice_date,$reference,$ref_date,$customer_id,$tax,$despatch_by,$despatch_date,$remark,$is_deleted,$entry_date);	 	
		$a=explode(",",$_POST['tax']); 
		$ledger_name="";
		if($a[2]=="VAT")
			$ledger_name="Sales ".$a[0]."%";
		else if($a[2]=="CST")
			$ledger_name="Interstate Sales ".$a[0]."%";
		
		$temp1=mysql_query("select ledger_id from ledger_master where ledger_name=(select customer_name from customer_master where customer_id=$customer_id)")or die(mysql_error());		
		$temp2=mysql_query("select ledger_id from ledger_master where ledger_name='$ledger_name'")or die(mysql_error());		
		
		$temp_rs1=mysql_fetch_array($temp1);
		$temp_rs2=mysql_fetch_array($temp2);
		
		$credit_ledger_id=$temp_rs1[0];
		$debit_ledger_id=$temp_rs2[0];
		$amount=0.0;
		
		$res1=$ob->insert("sales_master",$sales_fields,$add_sales);
				
	 	if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
		{
			$item_id=$_POST['item_id'];
			$item_desc=$_POST['item_desc'];
			$item_qty=$_POST['item_qty'];
			$item_price=$_POST['item_price'];
			$item_name=$_POST['item_name'];		
			for($i=0;$i<count($item_name);$i++)
			{
				$amount += $item_qty[$i] * $item_price[$i];
				$add_sales_detail=array($invoice_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
				
				$res2=$ob->insert("sales_detail",$sales_detail_fields,$add_sales_detail);	
			}		
		}
		$add_entry=array($invoice_id,$invoice_date,$credit_ledger_id,$debit_ledger_id,$amount,$remark,$is_deleted);		
		$res3=$ob->insert("sales_entry_master",$sales_entry_fields,$add_entry);
	
		echo'<script language="javascript">alert("Record Save Successfully...")</script>';
		echo '<meta http-equiv="refresh" content="0;url=#">';						
	}
	if(isset($_REQUEST['add_customer']))
	{
		if(isset($_POST['iscompany']))
			$iscompany="1";
		else
			$iscompany="0";
		$customer_name=$_POST['c_name'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$contact_name=$_POST['contact_name'];
		$designation=$_POST['designation'];
		$pincode=$_POST['pincode'];
		$email=$_POST['email'];
		$mobile_no=$_POST['mobile_no'];
		if(isset($_POST['phone'])) 
			$phone_no=$_POST['phone'];
		else
			$phone_no="";
		if(isset($_POST['isregistered'])){
			$vat_tin_no=$_POST['vat_tin_no'];
			$cst_no=$_POST['cst_no'];
		}
		else{
			$vat_tin_no="";
			$cst_no="";
		}
		$is_deleted="0";
		$rs = mysql_query("select group_id from group_master where group_name = 'Sundry Debtors'");
		$row=mysql_fetch_array($rs);
		$group_id = $row[0];
		$cur_date = date('Y-m-d H:i:s');
		$opening_bal = 0;
		$add_ledger = array($customer_name,$opening_bal,$cur_date,$group_id);
		$add_customer = array($customer_name,$address,$city,$state,$pincode,$email,$mobile_no,$phone_no,$vat_tin_no,$cst_no,$contact_name,$designation,$iscompany,$is_deleted,$cur_date);
		$ob->insert("customer_master",$customer_fields,$add_customer);
		$ob->insert("ledger_master",$ledger_fields,$add_ledger);
		echo '<meta http-equiv="refresh" content="0;url=#">';
	}
	if(isset($_REQUEST['add_supplier']))
	{
		if(isset($_POST['iscompany']))
			$iscompany="1";
		else
			$iscompany="0";
		$supplier_name=$_POST['supplier_name'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$contact_name=$_POST['contact_name'];
		$designation=$_POST['designation'];
		$pincode=$_POST['pincode'];
		$email=$_POST['email'];
		$mobile_no=$_POST['mobile'];
		if(isset($_POST['phone'])) 
			$phone_no=$_POST['phone'];
		else
			$phone_no="";
		if(isset($_POST['isregistered'])){
			$vat_tin_no=$_POST['vat_tin_no'];
			$cst_no=$_POST['cst_no'];
		}
		else{
			$vat_tin_no="";
			$cst_no="";
		}
		$is_deleted='0';
		$rs = mysql_query("select group_id from group_master where group_name = 'Sundry Creditors'");
		$row=mysql_fetch_array($rs);
		$group_id = $row[0];
		$cur_date = date('Y-m-d H:i:s');
		$opening_bal = 0;
		$add_ledger = array($supplier_name,$opening_bal,$cur_date,$group_id);
		$add_supplier = array($supplier_name,$address,$city,$state,$pincode,$email,$mobile_no,$phone_no,$vat_tin_no,$cst_no,$contact_name,$designation,$iscompany,$is_deleted,$cur_date);
		$ob->insert("supplier_master",$supplier_fields,$add_supplier);
		$ob->insert("ledger_master",$ledger_fields,$add_ledger);
		echo '<meta http-equiv="refresh" content="0;url=#">';
	}	
	if(isset($_REQUEST['add_product']))
	{
		$item_name=$_POST['item_name'];
		$item_desc=$_POST['item_desc'];
		$item_unit=$_POST['item_unit'];
		$item_rate=$_POST['item_rate'];
		$item_price=$_POST['item_price'];
		$category_id=$_POST['category'];
		$file_name = $_FILES['product_img']['name'];
		$new_file_name=$_SESSION['ossem_user_id']."".date("j")."".time();	
		$image_name="";								
		if($_FILES["product_img"]["name"]!="")
		{				
			if((($_FILES["product_img"]["type"] == "image/gif")|| ($_FILES["product_img"]["type"] == "image/jpeg")|| ($_FILES["product_img"]["type"] == "image/jpg")|| ($_FILES["product_img"]["type"] == "image/png"))&& ($_FILES["product_img"]["size"] <= 512000)) 
			{
				if($_FILES["product_img"]["error"] > 0) 
					$image_name="";
				else 
				{
					$path="../images/";				
					$path=$path.$new_file_name.$file_name;				
				 	move_uploaded_file($_FILES["product_img"]["tmp_name"],$path);
					$image_name=$new_file_name.$file_name;			
	   			}
			} 
			else 
			{
			    echo '<script> alert("File must be include valid format and size");</script>';
				return false;
			}
		}
		$entry_date=date('Y-m-d H:i:s');
		$add_product=array($item_name,$item_desc,$item_unit,$item_rate,$item_price,$category_id,$image_name,$entry_date);				
		$ob->insert("product_master",$product_fields,$add_product);
		echo '<meta http-equiv="refresh" content="0;url=#">';	
	}
	if(isset($_POST['add_quotation']))
	{		
		$sales_qua_id=$_POST['qid'];			
		$customer_id=$_POST['customer_id'];
		$quo_date=date("Y-m-d",strtotime($_POST['quo_date1']));
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$exp_date=date("Y-m-d",strtotime($_POST['exp_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$remark=$_POST["remark"];	
		$status="0";	
		$is_deleted=0;
		
		$add_quotation=array($sales_qua_id,$quo_date,$customer_id,$reference,$ref_date,$exp_date,$tax,$status,$remark,$is_deleted);				
		$res1=$ob->insert("sales_qua_master",$quotation_fields,$add_quotation);
		if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
		{
			$item_id=$_POST['item_id'];
			$item_desc=$_POST['item_desc'];
			$item_qty=$_POST['item_qty'];
			$item_price=$_POST['item_price'];
			$item_name=$_POST['item_name'];		
			for($i=0;$i<count($item_name);$i++)
			{
				$add_quotation_detail=array($sales_qua_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
				$res2=$ob->insert("sales_qua_detail",$quotation_detail_fields,$add_quotation_detail);	
			}		
		}	
		echo'<script language="javascript">alert("Record Save Successfully...")</script>';
		echo '<meta http-equiv="refresh" content="0;url=#">';			
	}
		
	if(isset($_POST['add_sales_order']))
	{	
		$sales_order_id=$_POST['sorderid'];			
		$customer_id=$_POST['customer_id'];
		$order_date=date("Y-m-d",strtotime($_POST['order_date']));
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$delivery_date=date("Y-m-d",strtotime($_POST['delivery_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$remark=$_POST["remark"];	
		$status="0";	
		$is_deleted="0";
		$c=mysql_num_rows(mysql_query("select *from sales_order_master where sales_order_id='$sales_order_id'"));
		if($c >0){
			echo'<script> alert("Sales Order Available..");</script>';
		}
		else
		{
			$add_sales_order=array($sales_order_id,$order_date,$customer_id,$reference,$ref_date,$delivery_date,$tax,$status,$remark,$is_deleted);				
			$ob->insert("sales_order_master",$sales_order_fields,$add_sales_order);
			
			if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
			{
				$item_id=$_POST['item_id'];
				$item_desc=$_POST['item_desc'];
				$item_qty=$_POST['item_qty'];
				$item_price=$_POST['item_price'];
				$item_name=$_POST['item_name'];		
				for($i=0;$i<count($item_name);$i++)
				{
					$add_sales_order_detail=array($sales_order_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
					$ob->insert("sales_order_detail",$sales_order_detail_fields,$add_sales_order_detail);	
				}		
			}		
			echo '<meta http-equiv="refresh" content="0;url=#">';
		}
	}

	if(isset($_POST['add_pur_order']))
	{	
		$po_id=$_POST['porderid'];			
		$supplier_id=$_POST['supplier_id'];
		$po_date=date("Y-m-d",strtotime($_POST['po_date']));
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$delivery_date=date("Y-m-d",strtotime($_POST['delivery_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$remark=$_POST["remark"];	
		$status="0";	
		$is_deleted="0";
		$entry_date=date("Y-m-d H:i:s");
		$add_pur_order=array($po_id,$po_date,$supplier_id,$reference,$ref_date,$delivery_date,$tax,$status,$remark,$is_deleted,$entry_date);				
		$ob->insert("pur_order_master",$pur_order_fields,$add_pur_order);
		
		if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
		{
			$item_id=$_POST['item_id'];
			$item_desc=$_POST['item_desc'];
			$item_qty=$_POST['item_qty'];
			$item_price=$_POST['item_price'];
			$item_name=$_POST['item_name'];		
			for($i=0;$i<count($item_name);$i++)
			{
				$add_pur_order_detail=array($po_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
				$ob->insert("pur_order_detail",$pur_order_detail_fields,$add_pur_order_detail);	
			}		
		}		
		echo '<meta http-equiv="refresh" content="0;url=#">';
	}
	if(isset($_POST['add_pur_quotation']))
	{	
		$pur_qua_id=$_POST['pqid'];			
		$supplier_id=$_POST['supplier_id'];
		$quo_date=date("Y-m-d",strtotime($_POST['quo_date']));
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$exp_date=date("Y-m-d",strtotime($_POST['exp_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$remark=$_POST["remark"];	
		$status="0";	
		$is_deleted=0;
		$entry_date=date("Y-m-d H:i:s");
		
		$c=mysql_num_rows(mysql_query("select *from pur_qua_master where pur_qua_id='$pur_qua_id'"));
		if($c >0){
			echo'<script> alert("Purchase Quotation Available..");</script>';
		}
		else
		{
			$add_pur_quotation=array($pur_qua_id,$quo_date,$supplier_id,$reference,$ref_date,$exp_date,$tax,$status,$remark,$is_deleted,$entry_date);				
			$ob->insert("pur_qua_master",$pur_quotation_fields,$add_pur_quotation);
			if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
			{
				$item_id=$_POST['item_id'];
				$item_desc=$_POST['item_desc'];
				$item_qty=$_POST['item_qty'];
				$item_price=$_POST['item_price'];
				$item_name=$_POST['item_name'];		
				for($i=0;$i<count($item_name);$i++)
				{
	
					$add_pur_quotation_detail=array($pur_qua_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
					$ob->insert("pur_qua_detail",$pur_quotation_detail_fields,$add_pur_quotation_detail);					
				}		
			}		
			echo '<meta http-equiv="refresh" content="0;url=#">';
		}
	}	
	if(isset($_REQUEST['add_group']))
	{
		$group_name = $_POST['g_name'];
		$add_group = array($group_name);
		$ob->insert("group_master",$group_fields,$add_group);
		echo '<meta http-equiv="refresh" content="0;url=#">';
	}
	if(isset($_REQUEST['add_ledger']))
	{
			$ledger_name = $_POST['ledger_name'];
			$group_id = $_POST['group_id'];
			$cur_date = date('Y-m-d H:i:s');
			$opening_bal = $_POST['opening_bal'];
			$rs = mysql_query("select * from ledger_master where ledger_name = '$ledger_name'") or die("error");
			$row = mysql_fetch_row($rs);
			if(!$row)
			{
				$add_ledger = array($ledger_name,$opening_bal,$cur_date,$group_id);
				$ob->insert("ledger_master",$ledger_fields,$add_ledger);
			}
			else
				echo "error";
			echo '<meta http-equiv="refresh" content="0;url=#">';
	}

	if(isset($_POST['add_sales_return']))
	{	
		$sales_return_id=$_POST['sales_return_id'];			
		$customer_id=$_POST['customer_id'];
		$return_date=date("Y-m-d",strtotime($_POST['return_date']));		
		$reference="Invoice No. ".$_POST['invoice_id'];
		$invoice=$_POST['invoice_id'];		
		$remark=$_POST["remark"];		
		$is_deleted="0";
		$entry_date=date("Y-m-d H:i:s");
		$q="select * from sales_return where sales_return_id='$sales_return_id'";
		$rs_temp=mysql_query($q)or die(mysql_error());
		if(mysql_num_rows($rs_temp)>0)
			echo '<script>alert("Return Invoice Entry already found...");</script>';
		else
		{		
			$row=mysql_fetch_array(mysql_query("select tax,invoice_date from sales_master where invoice_id='$invoice'"));
			$ref_date=$row['invoice_date'];	
			$tax=$row['tax'];				
			$add_sales_return=array($sales_return_id,$return_date,$customer_id,$reference,$ref_date,$tax,$remark,$is_deleted,$entry_date);				
			$ob->insert("sales_return",$sales_return_fields,$add_sales_return);
			if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
			{
				$item_id=$_POST['item_id'];
				$item_desc=$_POST['item_desc'];
				$item_qty=$_POST['item_qty'];
				$item_price=$_POST['item_price'];
				$item_name=$_POST['item_name'];		
				for($i=0;$i<count($item_name);$i++)
				{
					$add_sales_return_detail=array($sales_return_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
					$ob->insert("sales_return_detail",$sales_return_detail_fields,$add_sales_return_detail);	
				}		
			}		
			echo '<meta http-equiv="refresh" content="0;url=#">';
		}
	}		

	
	if(isset($_REQUEST['add_pur_return']))
	{
		$pur_return_id=$_POST['pur_return_id'];			
		$pur_return_date=date("Y-m-d",strtotime($_POST['pur_return_date']));
		$supplier_id=$_POST['supplier_id'];
		$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
		$reference=$_POST['reference'];
		$tax=$_POST['tax'];	
		$despatch_by=$_POST['despatch_by'];
		$despatch_date=date("Y-m-d",strtotime($_POST['despatch_date']));
		$remark=$_POST["remark"];		
		$is_deleted=0;
			
		$add_pur_return=array($pur_return_id,$pur_return_date,$reference,$ref_date,$supplier_id,$tax,$despatch_by,$despatch_date,$remark,$is_deleted);
		$ob->insert("pur_return",$pur_return_fields,$add_pur_return);
	 
	 	if(isset($_POST['item_id']) && isset($_POST['item_name']) && isset($_POST['item_desc']) && isset($_POST['item_price']) && isset($_POST['item_qty']))
		{
			$item_id=$_POST['item_id'];
			$item_desc=$_POST['item_desc'];
			$item_qty=$_POST['item_qty'];
			$item_price=$_POST['item_price'];
			$item_name=$_POST['item_name'];		
			for($i=0;$i<count($item_name);$i++)
			{
				$add_pur_return_detail=array($pur_return_id,$item_name[$i],$item_desc[$i],$item_price[$i],$item_qty[$i]);
				$ob->insert("pur_return_detail",$pur_return_detail_fields,$add_pur_return_detail);	
			}		
		}
			echo '<meta http-equiv="refresh" content="0;url=#">';
	}											
?>
