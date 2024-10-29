<?php
include("../Assets/Connection/Connection.php");
include('Head.php');
?>
<br><br><br>
<br><br><br>
<br><br><br>
<br><br><br>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Coordinator</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>Name</td>
      <td>Email</td>
      <td>Contact</td>
      <td>Course</td>
      <td></td>
    </tr>
    <?php
	$i=0;
	$selqry="select * from tbl_coordinator c inner join tbl_student s on c.student_id=s.student_id 
  inner join tbl_course co on co.course_id=s.course_id where c.event_id=".$_GET['eid'];
	$result=$con->query($selqry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $row['student_name'];?></td>
      <td><?php echo $row['student_email'];?></td>
      <td><?php echo $row['student_contact'];?></td>
      <td><?php echo $row['course_name'];?></td>
      <td></td>
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