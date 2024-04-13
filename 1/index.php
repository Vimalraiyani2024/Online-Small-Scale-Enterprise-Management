<?php 
	include_once("../class/autoload.php");
	if(isset($_SESSION['ossem_user_id']) && isset($_SESSION['ossem_db_name']))
	{		
		if($_SESSION['ossem_user_type1']==10)
		{					
			$con=$ob->connection();			
			include_once("inc_header.php"); 
?>                                                      	          
     <!-- JavaScript Plugins -->
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/core/mws.js"></script>
    <script src="js/core/themer.js"></script>
</body>
</html>
<?php
}}
else
echo '<meta http-equiv="refresh" content="0;url=../index.php"> ';
?>