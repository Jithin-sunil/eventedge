
<?php
include('../Assets/Connection/Connection.php');
if(isset($_POST['btn_submit']))
{
	$district=$_POST['sel_district'];
	$place=$_POST['txt_place'];
	$insqry="insert into tbl_place(place_name,district_id)values('".$place."','".$district."')";
	if($con->query($insqry))
	{
		echo"
		<script>
		alert('inserted')
		window.location='Place.php'
		</script>";
}
else
{
	echo "failed";
}
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
      <td align="center" colspan="2"> Place</td>
    </tr>
    <tr>
      <td>Select District:</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
          <option>--select--</option>
          <?php
		  $selqry="select*from tbl_district";
		  $result=$con->query($selqry);
		  while($row=$result->fetch_assoc())
		  {
			  ?>
              <option value="<?php echo $row ["district_id"];?>"> <?php echo $row ["district_name"];?></option>
      
    <?php
		  }
		  ?>
          </select></td>
    </tr>
    <tr>
      <td>Place</td>
      <td><label for="txt_place"></label>
      <input type="text" name="txt_place" id="txt_place" /></td>
    </tr>
    <tr>
      <td align="center" colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="reset" name="btn_clear" id="btn_clear" value="Cancel" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>District Name</td>
      <td>Place</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$selqry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
	$result=$con->query($selqry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row ["district_name"];?></td>
      <td><?php echo $row ["place_name"]; ?></td>
      <td>&nbsp;</td>
    </tr>
	<?php
	}
	?>
	
  </table>
</form>
</body>
</html>