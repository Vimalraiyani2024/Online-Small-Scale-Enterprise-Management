<?php	
	//if($q>0)
	{
		//mysql_close($con1)or die(mysql_error());	
		$con2=mysql_connect("localhost","root","")or die(mysql_error());	
		$a=mysql_query("create database ".$dbname."",$con2)or die(mysql_error());		
		mysql_select_db($dbname,$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS customer_master (customer_id int(10) NOT NULL AUTO_INCREMENT,customer_name varchar(100) NOT NULL ,address varchar(200) NOT NULL,  city varchar(50) NOT NULL,  state varchar(50) NOT NULL,  pincode int(6) NOT NULL,  mobile_no varchar(10) NOT NULL,  contact_name varchar(100) NOT NULL,  email_id varchar(50) NOT NULL,  vat_tin_no int(11) NOT NULL,  cst_no int(11) NOT NULL,  designation varchar(20) NOT NULL,  phone_no varchar(12) NOT NULL,  iscompany varchar(1) NOT NULL,  is_deleted varchar(1) NOT NULL, PRIMARY KEY (customer_id))",$con2)or die(mysql_error());
		
		
		mysql_query("CREATE TABLE IF NOT EXISTS entry_master(e_id int(10) NOT NULL AUTO_INCREMENT,  entry_id int(10) NOT NULL,  entry_date varchar(20) NOT NULL,  credit_ledger_id int(10) NOT NULL,  debit_ledger_id int(10) NOT NULL,  amount double(8,2) NOT NULL,  remark varchar(200) NOT NULL,  entry_type char(1) NOT NULL,  PRIMARY KEY (e_id))",$con2)or die(mysql_error());
				
		mysql_query("CREATE TABLE IF NOT EXISTS group_master (group_id int(4) NOT NULL AUTO_INCREMENT,  group_name varchar(100) NOT NULL,PRIMARY KEY (group_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS ledger_master (ledger_id int(10) NOT NULL AUTO_INCREMENT,ledger_name varchar(100) NOT NULL,  opening_bal double(8,2) NOT NULL,  ledger_date date NOT NULL,  group_id int(4) NOT NULL,PRIMARY KEY (ledger_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS product_category(category_id int(4) NOT NULL AUTO_INCREMENT,category_name varchar(30) NOT NULL, PRIMARY KEY (category_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS product_master(item_id int(8) NOT NULL AUTO_INCREMENT,item_name text NOT NULL,item_desc varchar(200) NOT NULL, item_unit varchar(10) NOT NULL,item_rate double(8,2) NOT NULL,item_price double(8,2) NOT NULL,image_name varchar(150) NOT NULL, category_id int(4) NOT NULL,  PRIMARY KEY (item_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS purchase_detail(pur_detail_id int(11) NOT NULL AUTO_INCREMENT,pur_id varchar(20) NOT NULL,item_name varchar(50) NOT NULL,item_desc varchar(200) NOT NULL,item_unit varchar(50) NOT NULL,item_qty int(8) NOT NULL,item_price double(8,2) NOT NULL, is_deleted varchar(1) NOT NULL,  PRIMARY KEY (pur_detail_id))",$con2)or die(mysql_error());
				
		mysql_query("CREATE TABLE IF NOT EXISTS purchase_master(pur_id varchar(20) NOT NULL,pur_date varchar(20) NOT NULL,reference varchar(10) NOT NULL, ref_date varchar(10) NOT NULL,supplier_id int(10) NOT NULL,tax varchar(15) NOT NULL,despatch_by varchar(100) NOT NULL,despatch_date varchar(20) NOT NULL,lr_no int(10) NOT NULL,remark varchar(200) NOT NULL,
	  pur_type varchar(10) NOT NULL,  is_deleted varchar(1) NOT NULL,  PRIMARY KEY (pur_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS pur_entry_master(pur_entry_id int(10) NOT NULL AUTO_INCREMENT,purchase_id varchar(12) NOT NULL,purchase_date varchar(12) NOT 
	NULL,remark varchar(200) NOT NULL,credit_ledger_id int(10) NOT NULL,debit_ledger_id int(10) NOT NULL,amount double(10,2) NOT NULL,is_deleted varchar(1) NOT NULL, PRIMARY KEY (pur_entry_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS pur_order_detail (po_detail_id int(11) NOT NULL AUTO_INCREMENT, po_id varchar(20) NOT NULL,  item_name varchar(50) NOT NULL,  item_desc 
	varchar(200) NOT NULL,  item_unit varchar(100) NOT NULL,  item_price double(10,2) NOT NULL,  item_qty int(10) NOT NULL,  PRIMARY KEY (po_detail_id))",$con2)or die(mysql_error());
	
	    mysql_query("CREATE TABLE IF NOT EXISTS pur_order_master(po_id varchar(20) NOT NULL,po_date varchar(12) NOT NULL,supplier_id int(10) NOT NULL,reference varchar(10) NOT NULL, reference_date varchar(12) NOT NULL, tax varchar(50) NOT NULL,  is_deleted varchar(1) NOT NULL,  status varchar(1) NOT NULL,delivery_date varchar(12) NOT NULL, remark varchar(200) NOT NULL,  PRIMARY KEY (po_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS pur_qua_detail (pur_qua_detail_id int(11) NOT NULL AUTO_INCREMENT,pur_qua_id varchar(15) NOT NULL,item_name varchar(50) NOT NULL,  item_desc varchar(200) NOT NULL,  item_unit varchar(50) NOT NULL,  item_qty int(8) NOT NULL,  item_price double(10,2) NOT NULL,  other_exp double(8,2) NOT NULL,  PRIMARY KEY(pur_qua_detail_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS pur_qua_master(pur_qua_id varchar(15) NOT NULL, quo_date varchar(12) NOT NULL,supplier_id int(10) NOT NULL,reference varchar(100) NOT NULL,reference_date varchar(12) NOT NULL,tax varchar(20) NOT NULL, expiry_date varchar(12) NOT NULL, status varchar(1) NOT NULL,remark varchar(200) NOT NULL, is_deleted int(1) NOT NULL, PRIMARY KEY (pur_qua_id)) ",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS pur_return(pur_return_id int(10) NOT NULL,pur_return_date varchar(12) NOT NULL,reference varchar(100) NOT NULL,supplier_id int(10) NOT NULL,ref_date varchar(12) NOT NULL,  tax varchar(15) NOT NULL,despatch_by varchar(100) NOT NULL, despatch_date varchar(12) NOT NULL,lr_no int(11) NOT NULL,  from_city varchar(50) NOT NULL,  to_city varchar(50) NOT NULL,  no_of_cases int(8) NOT NULL,  remark varchar(200) NOT NULL,  pur_return_type varchar(10) NOT NULL,  is_deleted varchar(1) NOT NULL,  PRIMARY KEY (pur_return_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS pur_return_detail(pur_return_detail_id int(10) NOT NULL AUTO_INCREMENT,  pur_return_id int(10) NOT NULL,  item_name varchar(50) NOT NULL,  item_desc varchar(200) NOT NULL,  item_qty int(8) NOT NULL,  item_price double(8,2) NOT NULL,  PRIMARY KEY (pur_return_detail_id)) ",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS tax_master(
	 tax_id int(10) NOT NULL AUTO_INCREMENT,
	tax_name varchar(20) NOT NULL,
	 tax_per double(4,2) NOT NULL,
	  additional_per double(4,2) 
	NOT NULL,
	  PRIMARY KEY (tax_id)
	)",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS supplier_master(
	supplier_id int(10) NOT NULL AUTO_INCREMENT,
	  supplier_name varchar(100) NOT NULL,
	  address varchar(200) NOT NULL,
	  city 
	
	varchar(50) NOT NULL,
	  state varchar(50) NOT NULL,
	  pincode int(6) NOT NULL,
	  mobile_no varchar(10) NOT NULL,
	  phone_no varchar(15) NOT NULL,
	  designation varchar(100) 
	
	NOT NULL,
	  email_id varchar(50) NOT NULL,
	  contact_name varchar(100) NOT NULL,
	  vat_tin_no int(11) NOT NULL,
	  cst_no int(11) NOT NULL,
	iscompany varchar(1) NOT NULL,
	is_deleted int(1) NOT NULL,
	entry_date varchar(12) NOT NULL,
	  PRIMARY KEY (supplier_id))",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS sales_return_detail (
	 sales_return_detail_id int(11) NOT NULL AUTO_INCREMENT,
	sales_return_id varchar(20) NOT NULL,
	item_name varchar(50) NOT 	
	NULL,
	item_desc varchar(200) NOT NULL,
	  item_unit varchar(50) NOT NULL,
	  item_qty int(8) NOT NULL,
	item_price double(8,2) NOT NULL,
	  is_deleted varchar(1) NOT NULL,	  	
	PRIMARY KEY (sales_return_detail_id)
	)",$con2)or die(mysql_error());
		
		mysql_query("
	CREATE TABLE IF NOT EXISTS sales_return(
	sales_return_id varchar(20) NOT NULL,
	 return_date varchar(20) NOT NULL,
	  customer_id int(10) NOT NULL,
	  reference varchar(20) 
	
	NOT NULL,
	ref_date varchar(20) NOT NULL,
	  tax varchar(30) NOT NULL,
	despatch_by varchar(100) NOT NULL,
	 despatch_date varchar(20) NOT NULL,
	  lr_no varchar(20) NOT NULL,
	  
	
	remark varchar(200) NOT NULL,
	  from_city varchar(50) NOT NULL,
	to_city varchar(50) NOT NULL,
	no_of_cases varchar(20) NOT NULL,
	 sales_return_type varchar(10) NOT NULL,
	  
	
	is_deleted varchar(2) NOT NULL,
	  PRIMARY KEY (sales_return_id),
	  UNIQUE KEY sales_return_id(sales_return_id)
	) ",$con2)or die(mysql_error());
		
	mysql_query("CREATE TABLE IF NOT EXISTS sales_qua_master (
	sales_qua_id varchar(15) NOT NULL,
	  quo_date varchar(10) NOT NULL,
	  customer_id int(10) NOT NULL,
	  reference varchar(100) 
	
	NOT NULL,
	  reference_date varchar(10) NOT NULL,
	  tax varchar(30) NOT NULL,
	  expiry_date varchar(10) NOT NULL,
	status varchar(1) NOT NULL,
	  remark varchar(150) NOT 
	
	NULL,
	 is_deleted varchar(1) NOT NULL,
	  PRIMARY KEY (sales_qua_id)
	) ",$con2)or die(mysql_error());
		
	mysql_query("
	CREATE TABLE IF NOT EXISTS sales_qua_detail (
	sales_qua_detail_id int(10) NOT NULL AUTO_INCREMENT,
	 sales_qua_id varchar(20) NOT NULL,
	  item_name varchar(50) 
	
	NOT NULL,
	 item_desc varchar(200) NOT NULL,
	  item_unit varchar(10) NOT NULL,
	  item_price double(8,2) NOT NULL,
	  item_qty int(8) NOT NULL,
	  PRIMARY KEY 
	
	(sales_qua_detail_id)
	) ",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS sales_order_master (
	sales_order_id varchar(20) NOT NULL,
	order_date varchar(12) NOT NULL,
	 customer_id int(10) NOT NULL,
	  
	
	reference varchar(100) NOT NULL,
	  reference_date varchar(12) NOT NULL,
	 tax varchar(50) NOT NULL,
	 is_deleted varchar(1) NOT NULL,
	  status varchar(1) NOT 
	
	NULL,
	  delivery_date varchar(12) NOT NULL,
	  remark varchar(200) NOT NULL,
	  PRIMARY KEY (sales_order_id)
	) ",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS sales_detail (
	invoice_detail_id int(11) NOT NULL AUTO_INCREMENT,
	  invoice_id varchar(20) NOT NULL,
	item_name varchar(50) NOT 
	
	NULL,
	  item_desc varchar(200) NOT NULL,
	 item_unit varchar(50) NOT NULL,
	  item_qty int(8) NOT NULL,
	item_price double(8,2) NOT NULL,
	  PRIMARY KEY 
	
	(invoice_detail_id)
	)",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS sales_entry_master(
	sales_entry_id int(10) NOT NULL AUTO_INCREMENT,
	  invoice_id varchar(20) NOT NULL,
	invoice_date varchar(20) 
	
	NOT NULL,
	  credit_ledger_id int(10) NOT NULL,
	 debit_ledger_id int(10) NOT NULL,
	  amount double(8,2) NOT NULL,
	  remark varchar(200) NOT NULL,
	is_deleted 
	
	varchar(1) NOT NULL,
	  PRIMARY KEY (sales_entry_id)
	) ",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS sales_master(
	inv_id int(11) NOT NULL AUTO_INCREMENT,
	invoice_id varchar(20) NOT NULL,
	invoice_date varchar(20) NOT NULL,
	  
	
	reference varchar(10) NOT NULL,
	ref_date varchar(20) NOT NULL,
	customer_id int(10) NOT NULL,
	tax varchar(20) NOT NULL,
	 despatch_by varchar(100) NOT 
	
	NULL,
	  despatch_date varchar(20) NOT NULL,
	  lr_no varchar(20) NOT NULL,
	  remark varchar(200) NOT NULL,
	from_city varchar(50) NOT NULL,
	to_city varchar(50) 
	
	DEFAULT NULL,
	  no_of_cases varchar(20) NOT NULL,
	  sales_type varchar(10) NOT NULL,
	  is_deleted int(1) NOT NULL,
	  PRIMARY KEY (inv_id),
	  KEY invoice_id 
	
	(invoice_id),
	  KEY invoice_id_2 (invoice_id)
	)",$con2)or die(mysql_error());
		
		mysql_query("CREATE TABLE IF NOT EXISTS sales_order_detail(
	sales_order_detail_id int(11) NOT NULL AUTO_INCREMENT,
	 sales_order_id varchar(20) NOT NULL,
	 item_name 
	
	varchar(50) NOT NULL,
	  item_desc varchar(200) NOT NULL,
	 item_unit varchar(50) NOT NULL,
	  item_qty int(8) NOT NULL,
	  item_price double(8,2) NOT NULL,
	other_exp double(8,2) NOT NULL,
	  PRIMARY KEY (sales_order_detail_id)
	) ",$con2)or die(mysql_error());	
	
	mysql_query("INSERT INTO group_master (group_id, group_name) VALUES(1, 'Assert'),(2, 'Bank Account'),(3, 'Cash On Hand'),(4, 'Purchase Account'),(5, 'Sales Account'),(6, 'Indirect Income'),(7, 'Indirect Expense'),(8, 'Direct Income'),(9, 'Direct Expense'),(10, 'Sundry Debtors'),(11, 'Sundry Creditors')",$con2)or die(mysql_error());
		$dat=date('d/m/yyyy');
		mysql_query("INSERT INTO ledger_master(ledger_id,ledger_name,opening_bal, ledger_date, group_id) VALUES
	(3, 'Cash', 0.00, '$dat', 3),
	(4, 'Raw Material',0.00, '$dat', 4),
	(5, 'Sales 4.00%',0.00, '$dat', 5),
	(6, 'Packing Material', 0.00, '$dat', 4),
	(13, 'Sales 12.50%', 0.00, '$dat', 5),
	(14, 'Sales 15.00%', 0.00, '$dat', 5),
	(15, 'Interstate Sales 2.00%', 0.00, '$dat', 5),
	(16, 'Interstate Sales 5.00%', 0.00, '$dat', 5),
	(17, 'Purchase 4.00%', 0.00, '$dat', 4),
	(18, 'Purchase 12.50%', 0.00, '$dat', 4),
	(19, 'Interstate Purchase 2.00%', 0.00, '$dat', 4),
	(20, 'Interstate Purchase 5.00%', 0.00, '$dat', 4)",$con2)or die(mysql_error());
	
	mysql_query("INSERT INTO tax_master(tax_id,tax_name,tax_per,additional_per) VALUES(1, 'VAT 4%', 4.00, 1.00),(2, 'VAT 12.5%', 12.50, 2.50),(3, 'CST 2%', 2.00, 0.00),(4, 'CST 5 %', 5.00, 0.00)",$con2)or die(mysql_error());
?>