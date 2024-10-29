<?php
include('../Assets/Connection/Connection.php');
$categoryid=$categoryname='';
if(isset($_POST['btn_submit']))

{
	$category=$_POST['txt_category'];
	$categoryid=$_POST["category_id"];
	if($categoryid == "")
	{
	$insqry="insert into tbl_category(category_name)values('".$category."')";
	if($con->query($insqry))
	{
		echo"
		<script>
		alert('Data Inserted')
		
		</script>";
	}
	else
	{
		echo"Failed";
	}
}
else
{
	$update ="update tbl_category set category_name='".$category."' where category_id=".$categoryid;
	if($con->query($update))
	{
		echo "<script>
		alert('data updated')
		window.location='category.php'
		
		</script>";
	}
}
}
		
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_category where category_id=".$_GET["did"];
	if($con->query($delQry))
	{
		?>
        <script>
		alert("Data Deleted")
		window.location="Category.php"
		</script>
        <?php
	}
}
if(isset($_GET["eid"]))
{
	$selqry="select * from tbl_category where category_id=".$_GET["eid"];
	$res = $con->query($selqry);
	$data=$res->fetch_assoc();
	$categoryname=$data["category_name"];
	$categoryid=$data["category_id"];
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
      <td>Category Name</td>
      <td><label for="txt_category"></label>
      <input type="text" name="txt_category" id="txt_category" value="<?php echo $categoryname;?>" />
      <input type="text" name="category_id" value="<?php echo $categoryid;?>"</td>
    </tr>
    <tr>
      <td align="center"colspan="2"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="200" border="1">
    <tr>
      <td>#</td>
      <td>Category</td>
      <td><p>Action</p></td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_category";
	$result=$con->query($selQry);
	while($row=$result ->fetch_assoc())
	{
		$i++;
		?>
    <tr>
      <td> <?php echo $i ?></td>
      <td><?php echo $row ["category_name"]; ?></td>
      <td><a href="Category.php?did=<?php echo $row["category_id"]; ?>">Delete</a>
      <a href="Category.php?eid=<?php echo $row["category_id"]; ?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
</body>
</html>