<?php
include('../Assets/Connection/Connection.php');
include('Head.php');
?>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org<br><br><br>/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Events</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>Name</td>
      <td>Details</td>
      <td>Date</td>
      <td>Type</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selqry="select * from tbl_event e inner join tbl_event_type t on t.event_type_id=e.event_type_id";
	$result=($con->query($selqry));
	while($row=$result->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['event_name'];?></td>
      <td><?php echo $row['event_details'];?></td>
      <td><?php echo $row['event_date'];?></td>
      <td><?php echo $row['event_type_name'];?></td>
      <td><a href="ViewCoordinator.php">View Coordinators</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>
<?php 
include('Foot.php');
?>