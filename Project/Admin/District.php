<?php 
include('../Assets/Connection/Connection.php');
$districtid = $districtname = "";
if(isset($_POST['submit']))
{
	$district=$_POST['txt_name'];
	$districtid = $_POST["txt_id"];
	if ($districtid == "")
	{
		$insQry="insert into tbl_district(district_name)values('".$district."')";
		if($con->query($insQry))
		{
			echo"
			<script>
			alert('Inserted');
			</script>";
			//echo "Inserted";
		}
		else
		{
			echo "Failed";
			
		}	
	}
	else
	{
		$update = "update tbl_district set district_name='".$district."' where district_id=".$districtid;
		if($con->query($update))
		{
			echo "<script>
			alert('Data Updated..')
			window.location='District.php'
			</script>";	
		}	
	}
	
}
if(isset($_GET["did"]))
{
$delQry="delete from tbl_district where district_id=".$_GET["did"];
if($con->query($delQry))
{
?>
<script>
alert("Data Deleted")
window.location="District.php"
</script>
<?php
}}

if(isset($_GET["eid"]))
{
	$sel = "select * from tbl_district where district_id=".$_GET["eid"];
	$res = $con->query($sel);
	$data = $res->fetch_assoc();	
	$districtname = $data["district_name"];
	$districtid = $data["district_id"];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td>District Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $districtname; ?>" />
      <input type="hidden" name="txt_id" value="<?php echo $districtid; ?>" /></td>
    </tr>
    <tr>
      <td align=center colspan="2"><input type="submit" name="submit" id="submit" value="Submit" />
      <input type="submit" name="clear" id="clear" value="clear" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>District</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_district";
	$result=$con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["district_name"]; ?></td>
      <td><a href="District.php?did=<?php echo $row["district_id"];?>">Delete </a>
      		<a href="District.php?eid=<?php echo $row["district_id"];?>">Edit </a>
            </td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>