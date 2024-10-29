<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assigned Event</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <h3 class="text-center mb-4">Assigned Events</h3>

      <form id="form1" name="form1" method="post" action="">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Details</th>
              <th>Date</th>
              <th>Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 0;
            $selqry = "SELECT * FROM tbl_coordinator  c  
                       INNER JOIN tbl_event e ON e.event_id = c.event_id 
                       WHERE c.teacher_id = " . $_SESSION['tid'];
            $result = ($con->query($selqry));

            while ($row = $result->fetch_assoc()) {
              $i++;
            ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td><?php echo $row['event_details']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td>
                  <a href="ViewStudents.php?eid=<?php echo $row['event_id']; ?>" 
                     class="assign-btn">Assign Coordinator</a>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>

<?php include('Foot.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
