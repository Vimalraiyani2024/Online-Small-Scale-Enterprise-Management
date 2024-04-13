<?php include_once("header.php");?>
<form action="" method="post" role="form">
	<a href="#modal" id="btn-create">Create</a><br /><br/>
  <div class="table-responsive"> 
    <table class="table  table-striped">
      <thead>
        <tr>         
		   <th><b id="b-title">Sr. No.</b></th>
          <th><b id="b-title">Ledger Name</b></th>
		  <th><b id="b-title">Under Group</b></th>
		  <th style="text-align:right"><b id="b-title">Opening Balance</b></th>
		 <th></th>
        </tr>
      </thead>
      <tbody>
		  <?php
		  $i=1;
	 echo "<tr>";
	  $rs=mysql_query("select a.group_id,ledger_id,ledger_name,group_name,opening_bal,group_name from ledger_master a, group_master b where a.group_id = b.group_id order by ledger_id desc")or die(mysql_error());
	  while($row=mysql_fetch_array($rs))
	  {
	  	echo "<td>".$i++."</td>";
	  	echo "<td width=60%><a href='accounting.php?ledger=".$row['ledger_id']."'>".ucwords($row['ledger_name'])."</td>";
		echo "<td>".ucwords($row['group_name'])."</td>";
		echo "<td align=right>".$row['opening_bal']."</td>";				
		echo "</tr>";
	  }
	  ?>
      </tbody>
    </table>
  </div>
</div>
</form>
<?php 
	include_once("model/add_ledger.php");
 ?>

