<?php
include('../Assets/Connection/Connection.php');
include("Head.php");
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>View Complaint</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }

    .table-container {
      margin: 30px auto;
      max-width: 800px;
    }

    .table th,
    .table td {
      vertical-align: middle;
      text-align: center;
    }

    .btn-reply {
      color: #fff;
      background-color: #dc3545;
      border: none;
    }

    .btn-reply:hover {
      background-color: #c82333;
    }
  </style>
</head>

<body>
  <div class="container table-container">
    <h3 class="text-center mb-4">View Complaints</h3>
    <form id="form1" name="form1" method="post" action="">
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Details</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $selqry = "SELECT * FROM tbl_complaint";
          $result = $con->query($selqry);

          while ($row = $result->fetch_assoc()) {
            $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['complaint_title']; ?></td>
            <td><?php echo $row['complaint_content']; ?></td>
            <td>
              <?php 
              if ($row['complaint_status'] == 0) { ?>
                <a href="Reply.php?did=<?php echo $row['complaint_id']; ?>" class="btn btn-reply btn-sm">Reply</a>
              <?php } else { 
                echo $row['complaint_reply']; 
              } ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
  </div>

  <!-- Bootstrap JS (Optional for interactivity) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include("Foot.php");
?>
