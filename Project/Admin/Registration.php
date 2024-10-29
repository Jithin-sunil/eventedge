<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$contact=$_POST['txt_contact'];
	$email=$_POST['txt_mail'];
	$password=$_POST['password'];
	$insQry="insert into tbl_admin(admin_name,admin_contact,admin_email,admin_password)values('".$name."','".$contact."','".$email."','".$password."')";
	if($con->query($insQry))
	{
		echo"
		<script>
		alert('Inserted');
		</script>";
        }
        else
        {
        echo "failed";
        }
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_admin where admin_id=".$_GET["did"];
	if($con->query($delQry))
	{
?>
<script>
alert("Data Deleted")
window.location="Registration.php"
</script>
<?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
    <tr>
      <td><p>Name</p></td>
      <td><label for="txt_name"></label>
      <input required type="text" name="txt_name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" id="txt_name" /></td>
    </tr>
    <tr>
      <td width="71">Contact</td>
      <td width="168"><label for="txt_contact"></label>
      <input required type="text" name="txt_contact"  pattern="[7-9]{1}[0-9]{9}" 
                title="Phone number with 7-9 and remaing 9 digit with 0-9" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_mail"></label>
      <input required type="email" name="txt_mail" id="txt_mail" /></td>
    </tr>
   
    
    <tr>
      <td>Password</td>
      <td><label for="password"></label>
      <input required type="password" name="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="password"  id="password" /></td>
    </tr>
    <tr>
      <td align=Center colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
   
  </table>
  <p>&nbsp;</p>
  <table width="373" border="1">
    <tr>
      <td width="17">#</td>
      <td width="46">Name</td>
      <td width="60">Contact</td>
      <td width="47">Email</td>
      <td width="78">Password</td>
      <td width="85">Action</td>
    </tr>
    <?php
	$i=0;
	$selqry="select * from tbl_admin";
	$result=$con->query($selqry);
	while($row=$result->fetch_assoc())
	{
		$i++;
	?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row["admin_name"]; ?> </td>
      <td><?php echo $row["admin_contact"]; ?></td>
      <td><?php echo $row["admin_email"];?></td>
      <td><?php echo $row["admin_password"];?></td>
      <td><a href="Registration.php?did=<?php echo $row["admin_id"];?>">Delete </a> </td>
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