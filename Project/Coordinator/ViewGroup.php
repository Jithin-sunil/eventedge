<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html><html>
<head>

</head>
<body>
  <?php
  ob_start();
 
  include("../Assets/Connections/Connection.php");
  include('Head.php');
  session_start();

?>
<br /><br /><br><br /><br /><br /><br><br />
<div id="tab">
 <table width="600" border="1" align="center">
          <tr>
            <td width="58">Sl.no</td>
            <td width="78">groupId</td>
            <td width="104">Logo</td>
            <td width="104">groupName</td>
            <td width="104">Description</td>
            <td width="104">Action</td>
            
          </tr>
<?php
$i=0;
	$selQry="select * from tbl_group where coordinator_id='".$_SESSION["cid"]."'";
	$result=$con->query($selQry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		?>
          <tr>
            <td width="58" align="center"><?php echo $i?></td>
            <td width="78" align="center"><?php echo $row["group_id"]?></td>
            <td><img src="../Assets/Files/Group/<?php echo $row["group_logo"];?>" width="100" height="100" /></td>
            <td width="104" align="center"><?php echo $row["group_name"]?></td>
            <td width="104" align="center"><?php echo $row["group_description"]?></td>
            <td>
           		
                <a href="Chat.php?id=<?php echo $row["group_id"]?>">Chat</a>
           </td>
          </tr><?php
	}
	?>
    </table>
    </div>
    <br /><br /><br /><br /><br /><br><br /><br /><br /><br><br />
  <?php
  include('Foot.php');
?>
       
 
