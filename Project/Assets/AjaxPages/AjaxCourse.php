<option>--select--</option>
 <?php
 include('../connection/connection.php');
		  $selqry="select * from tbl_course where department_id=".$_GET["did"];
		  $result=($con->query($selqry));
		  while($row=$result->fetch_assoc())
		  {
		  ?>
          <option value="<?php echo $row["course_id"]?>"> <?php echo $row["course_name"];?></option>
          <?php
		  }
		  ?>