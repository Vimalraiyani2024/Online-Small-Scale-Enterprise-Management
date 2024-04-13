<?php 
		include_once("../class/autoload.php");
		$con1= $ob->connection();
		$rs1=mysql_query("select *from master where enterprise_id=".$_SESSION['ossem_user_id']."",$con1)or die(mysql_error());	
		$rowE=mysql_fetch_array($rs1);
		mysql_close($con1);		
		$con=$ob->newconnection();	
			
?>
<html>
 <title> Print</title>
 <head>
	<link href="../styles/bootstrap.min.css" rel="stylesheet">     
    <link href="../styles/style.css" rel="stylesheet">
	<script src="../js/jquery.min.js"></script>
	<link href="../styles/bootstrap.css" rel="stylesheet">	
	<link rel="shortcut icon" href="../img/favico.ico">
    <link href="../styles/style.css" rel="stylesheet">	
	</head>
<body style="font-family:'Times New Roman', Times, serif; font-size:8px">						
			<div class="table-responsive" style=" overflow: hidden;">
			<table class="table table-bordered"> 
			<tbody>						
			 <tr>
				<td colspan="3"><?php echo "<b id=b-header>".strtoupper($rowE['enterprise_name'])."</b><br>";
						echo $rowE['address'].'<br>'.$rowE['city'].', '.$rowE['state']."<br>Email : ".$rowE['email_id'].'<br>Mobile No. : +91-'.$rowE['mobile']."";
						?></td>
				<td align="right"><img align="right" width="190px" height="150px" src="../images/<?php echo $rowE['img']; ?>"/></td>
			</tr>