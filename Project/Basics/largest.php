<?php
$result='';
if(isset($_POST['Find_largest']))
{
	$Number1=$_POST['txt_num1'];
	$Number2=$_POST['txt_num2'];
	$Number3=$_POST['txt_num3'];

	if($Number1 > $Number2 and $Number1 > $Number3)
	{
		$result=$Number1; 
}
elseif($Number2>$Number3 and $Number2>$Number1)
{
	$result=$Number2;
}
else
{
	$result=$Number3;
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
      <td>Number 1</td>
      <td><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
    </tr>
    <tr>
      <td>Number 2</td>
      <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
    </tr>
    <tr>
      <td>Number 3</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
    </tr>
    <tr>
      <td align=center colspan="2"><input type="submit" name="Find_largest" id="Find_largest" value="Find Largest" /></td>
    </tr>
    <tr>
      <td>Result</td>
      <td><?php echo $result ?></td>
    </tr>
  </table>
</form>
</body>
</html>