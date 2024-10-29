<?php
$result='';
if(isset($_POST['btn_add']))
{
	$Number1=$_POST['txt_num1'];
	$Number2=$_POST['txt_num2'];
	$result=$Number1 + $Number2;
}
if(isset($_POST['btn_minus']))
{
	$Number1=$_POST['txt_num1'];
	$Number2=$_POST['txt_num2'];
	$result=$Number1 -$Number2;
}
if(isset($_POST['btn_mult']))
{
	$Number1=$_POST['txt_num1'];
	$Number2=$_POST['txt_num2'];
	$result=$Number1 * $Number2;
}
if(isset($_POST['btn_div']))
{
	$Number1=$_POST['txt_num1'];
	$Number2=$_POST['txt_num2'];
	$result=$Number1 / $Number2;
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
      <td align="center" colspan="2"><input type="submit" name="btn_add" id="btn_add" value="+" />
      <input type="submit" name="btn_minus" id="btn_minus" value="-" />
      <input type="submit" name="btn_mult" id="btn_mult" value="*" />
      <input type="submit" name="btn_div" id="btn_div" value="/" /></td>
    </tr>
    <tr>
      <td>Result</td>
      <td><?php echo $result ?></td>
    </tr>
  </table>
</form>
</body>
</html>
