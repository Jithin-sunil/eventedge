<?php

include("../Assets/Connection/Connection.php");
session_start();
include('Head.php');
if(isset($_POST["btn_save"]))
{
$name=$_POST["txt_name"];

$desc=$_POST["txtdesc"];




  $photo = $_FILES["file_logo"]["name"];
  $temp = $_FILES["file_logo"]["tmp_name"];
  move_uploaded_file($temp,"../Assets/Files/Group/".$photo);
  
  

 $insqry="insert into tbl_group(group_name,group_logo,coordinator_id,group_description	,group_date) values('".$name."','".$photo."','".$_SESSION["cid"]."','".$desc."',curdate())";
  
  if($con->query($insqry))
  {
	 
	  
	  echo "<script>alert('Inserted')</script>";
  }
  else
   {
	  echo "<script>alert('Failed')</script>";
  }



  
}
  if(isset($_GET["did"]))
{
$del="delete from tbl_group where group_id='".$_GET["did"]."'";
echo $del;
	$con->query($del);
	header("Location:Group.php");  
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>group</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <div align="center">
  <br /><br /><br><br />
<div id="tab">
    <table width="529" height="228" border="1">
      <tr>
        <td width="259">Name</td>
        <td width="254"><label for="txt_name"></label>
        <input type="text" name="txt_name" id="txt_name" required autocomplete="off"/></td>
      </tr>
      <tr>
        <td>Logo</td>
        <td><label for="file_logo"></label>
        <input type="file" name="file_logo" id="file_logo" required="required" /></td>
      </tr>
      
      <tr>
        <td>Enter Description</td>
        <td><label for="txtdesc"></label>
        <textarea name="txtdesc" id="txtdesc" cols="23" rows="3" required="required"></textarea></td>
      </tr>
      <tr>
        <td><div align="center">
          <input type="submit" name="btn_save" id="btn_save" value="Save" />
        </div></td>
        <td><div align="center">
          <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
        </div></td>
      </tr>
    </table>
    </div>
  </div>
  <div align="center"></div>
  <div align="center"></div>
  <div align="center"></div>
  <div align="center"></div>
</form>
<form>

<br /><br /><br><br />
<div id="tab">
<table border="1" cellpadding="10" align="center">
    <tr>
      <td width="42">SI No.</td>
      <td width="43">Group Name</td>
      <td width="33">Details</td>
      <td width="36">Action</td>
    </tr>
    <?php
	$i=0;
	$selQry="select * from tbl_group   where coordinator_id='".$_SESSION["cid"]."'";
	$result=$con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++;		
	?>
    <tr>
        <td><?php echo $i?></td>
        <td><?php echo $row["group_name"]?></td>
      <td><?php echo $row["group_description"]?></td>
        <td><a href="group.php?did=<?php echo $row["group_id"]?>">Delete</a>
        
        </td>
    </tr>
    <?php
	}

	?>
  </table>
  </div>
  </form>
  <br /><br /><br />

</body>
</html>
<?php
include('Foot.php');
?>