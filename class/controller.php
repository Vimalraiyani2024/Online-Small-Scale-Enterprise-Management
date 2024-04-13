<?php
	$ob = new ssem;
	$customer_fields = array("customer_name","address","city","state","pincode","email_id","mobile_no","phone_no","vat_tin_no","cst_no","contact_name","designation","iscompany","is_deleted","entry_date");
	$supplier_fields = array("supplier_name","address","city","state","pincode","email_id","mobile_no","phone_no","vat_tin_no","cst_no","contact_name","designation","iscompany","is_deleted","entry_date");	
	
	$product_fields = array("item_name","item_desc","item_unit","item_rate","item_price","category_id","image_name","entry_date");
	
	$quotation_fields=array("sales_qua_id","quo_date","customer_id","reference","reference_date","expiry_date","tax","status","remark","is_deleted");	
	$quotation_detail_fields=array("sales_qua_id","item_name","item_desc","item_price","item_qty");	
	
	$pur_quotation_fields=array("pur_qua_id","quo_date","supplier_id","reference","reference_date","expiry_date","tax","status","remark","is_deleted","entry_date");	
	$pur_quotation_detail_fields=array("pur_qua_id","item_name","item_desc","item_price","item_qty");	
	
	
	$sales_order_fields=array("sales_order_id","order_date","customer_id","reference","reference_date","delivery_date","tax","status","remark","is_deleted");	
	$sales_order_detail_fields=array("sales_order_id","item_name","item_desc","item_price","item_qty");	

	$pur_order_fields=array("po_id","po_date","supplier_id","reference","reference_date","delivery_date","tax","status","remark","is_deleted","entry_date");	
	$pur_order_detail_fields=array("po_id","item_name","item_desc","item_price","item_qty");
	
	$sales_return_fields=array("sales_return_id","return_date","customer_id","reference","ref_date","tax","remark","is_deleted","entry_date");	
	$sales_return_detail_fields=array("sales_return_id","item_name","item_desc","item_price","item_qty");	
	
	$sales_fields=array("invoice_id","invoice_date","reference","ref_date","customer_id","tax","despatch_by","despatch_date","remark","is_deleted","entry_date");		
	$sales_detail_fields=array("invoice_id","item_name","item_desc","item_price","item_qty");	
	
	$purchase_fields=array("pur_id","pur_date","reference","ref_date","supplier_id","tax","despatch_by","despatch_date","remark","is_deleted","entry_date");		
	$purchase_detail_fields=array("pur_id","item_name","item_desc","item_price","item_qty");	
	
	$pur_return_fields=array("pur_return_id","pur_return_date","reference","ref_date","supplier_id","tax","despatch_by","despatch_date","remark","is_deleted");		
	$pur_return_detail_fields=array("pur_return_id","item_name","item_desc","item_price","item_qty");	
	
	/*Accounting Fields*/
	$group_fields=array("group_name");
	$ledger_fields=array("ledger_name","opening_bal","ledger_date","group_id");
		
	$add_entry_fields	= array("entry_id","entry_date","credit_ledger_id","debit_ledger_id","amount","remark","entry_type");

	$sales_entry_fields=array("invoice_id","invoice_date","credit_ledger_id","debit_ledger_id","amount","remark","is_deleted");		
	$purchase_entry_fields=array("purchase_id","purchase_date","credit_ledger_id","debit_ledger_id","amount","remark","is_deleted");		

	$record_found_msg="";
	
	/* Employee Fields */
	$add_dept_fields = array("dept_name");
	$add_employee_fields = array("emp_name","doj","address","address1","phone","mob","email","dob","sex","marital_status","dept_id","job_title","basic_salary","reference_by","emp_img");

	include("login_controller.php");
	include("add_controller.php");	
	include("update_controller.php");	

	
?>
