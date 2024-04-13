<?php include_once("header.php"); ?>
<div id="main">
	<div id="left_menu">
		<div id='cssmenu'>
			<ul>
			   <li class='has-sub'><a href='#'><span>Employee</span></a>
				  <ul>
					 <li><a href='employee.php?eid=1'><span>Departments</span></a></li>
					 <li><a href='employee.php?eid=2'><span>Employee Master</span></a></li>
					 <li class='last'><a href='employee.php?eid=3'><span>Attendance</span></a></li>
				  </ul>
			   </li>
			   <li class='has-sub'><a href='#'><span>Reports</span></a>
				  <ul>
					 <li><a href='employee.php?eid=4'><span>Attendances</span></a></li>
					 <li><a href='employee.php?eid=5'><span>Leave Summary</span></a></li>
					 <li><a href='employee.php?eid=6'><span>Salary Reports</span></a></li>
				  </ul>
			   </li>
			</ul>
		</div>
	</div>
	<div id="content-box">	
	<?php
	if(isset($_REQUEST['eid']))
	{
		if(isset($_REQUEST['iid']))
			include_once("report/view_emp.php");
		else if($_REQUEST['eid']=="1")
			include_once("department_list.php");
		else if($_REQUEST['eid']=="2")
			include_once("employee_list.php");
		else if($_REQUEST['eid']=="3")
			include_once("model/add_att_upload.php");
		else if($_REQUEST['eid']=="4")
			include_once("report/attendance_list.php");
		else if($_REQUEST['eid']=="5")
			include_once("report/leave_summary.php");
		else if($_REQUEST['eid']=="6")
			include_once("report/salary_report.php");
	}	
	else if(isset($_REQUEST['view']))
	{
		if($_REQUEST['view']=='employee')
			include_once("report/view_employee.php");
	}	
	else	
		include_once("dashboard.php");
	?>
	</div>
	</div>