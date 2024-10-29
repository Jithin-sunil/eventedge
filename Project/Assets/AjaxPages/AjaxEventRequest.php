<?php
include('../Connection/Connection.php');
session_start();
{
	$insqry="insert into tbl_request(request_date,student_id,event_id)values(curdate(),'".$_SESSION['sid']."','".$_GET['id']."')";
	if($con->query($insqry))
	{
		?>
        <script>
		alert('Request to Event..')
		window.location="MyEvents.php";
        </script>
        <?php
	}
}
	
?>