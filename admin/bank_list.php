<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<h4 id="title">Bank List</h4>
  <div class="table-responsive"> 
    <table class="table table-striped">
      <thead>
        <tr>
          <th style="text-align:right; width:10%"><b id="b-title">Sr. No.</b></th>
          <th><b id="b-title">Bank Name</b></th>
		  <th style="text-align:right; width:20%"><b id="b-title">Opening Balance</b></th>
        </tr>
      </thead>
      <tbody>
	<?php
	$i=1;
	 echo "<tr>";
	  $rs=mysql_query("select * from ledger_master where group_id IN(select group_id from group_master where group_name IN('Bank Account'))") or die(mysql_error());
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo "<td style='text-align:right'>".$i++."</td>";
	  	echo "<td><a href='accounting.php?bank=".$row['ledger_id']."'>".ucwords($row['ledger_name'])."</td>";
		echo "<td align=right>".$row['opening_bal']."</td>";		
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>

</form>
<?php 
	include_once("model/add_contra.php");
 ?>