<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if(isset($_POST["btn_submit"])) {
  $Reply = $_POST["txt_reply"];
  $updqry = "UPDATE tbl_complaint SET complaint_status = '1', complaint_reply = '$Reply' WHERE complaint_id = '".$_GET['did']."'";
  
  if($con->query($updqry)) {
    echo '<script>window.location = "ViewComplaint.php";</script>';
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Reply</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }
    .form-container {
      max-width: 500px;
      margin: 50px auto;
      padding: 30px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #ffffff;
    }
  </style>
</head>

<body>
  <div class="container form-container">
    <h3 class="text-center mb-4">Reply to Complaint</h3>
    <form id="form1" name="form1" method="post" action="">
      <div class="form-group">
        <label for="txt_reply">Reply</label>
        <textarea name="txt_reply" required id="txt_reply" class="form-control" rows="5" placeholder="Enter your reply here"></textarea>
      </div>
      <div class="text-center">
        <button type="submit" name="btn_submit" id="btn_submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>

  <!-- Optional Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
include('Foot.php');
?>
