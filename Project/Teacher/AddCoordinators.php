<?php
include('../Assets/Connection/Connection.php');

include('Head.php');

if (isset($_POST['button'])) {
    $coordinator = $_POST['txt_name'];
    $coordinatormail = $_POST['txt_email'];
    $coordinatorcontact = $_POST['txt_contact'];
    $coordinatorpass = $_POST['txt_password'];
    $coordinatorcourse = $_POST['sel_course'];

    $insqry = "INSERT INTO tbl_coordinator(coordinator_name, coordinator_contact, coordinator_email, 
                coordinator_password, course_id, event_id, assign_teacher_id) 
               VALUES ('$coordinator', '$coordinatorcontact', '$coordinatormail', 
                       '$coordinatorpass', '$coordinatorcourse', '{$_GET['did']}', '{$_SESSION['tid']}')";

    if ($con->query($insqry)) {
        echo "
        <script>
            alert('Data Inserted');
            window.location='AddCoordinators.php';
        </script>";
    } else {
        echo "Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Coordinators</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      padding-top: 50px;
    }

    .form-container {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
      max-width: 400px;
    }

    .form-container h3 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .btn-submit {
      background-color: #007bff;
      color: white;
      width: 100%;
      border-radius: 25px;
      padding: 10px;
    }

    .btn-submit:hover {
      background-color: #0056b3;
    }

    input, select {
      height: 38px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="form-container">
        <h3 class="text-center">Add Coordinator</h3>

        <form id="form1" name="form1" method="post" action="">
          <div class="form-group">
            <label for="txt_name">Name</label>
            <input type="text" name="txt_name" id="txt_name" class="form-control" 
                   pattern="^[A-Z]+[a-zA-Z ]*$" required 
                   title="Name allows only alphabets, spaces, and the first letter must be uppercase." />
          </div>

          <div class="form-group">
            <label for="txt_email">Email</label>
            <input type="email" name="txt_email" id="txt_email" class="form-control" required />
          </div>

          <div class="form-group">
            <label for="txt_contact">Contact</label>
            <input type="text" name="txt_contact" id="txt_contact" class="form-control" 
                   pattern="[7-9]{1}[0-9]{9}" required 
                   title="Phone number must start with 7-9, followed by 9 more digits." />
          </div>

          <div class="form-group">
            <label for="txt_password">Password</label>
            <input type="password" name="txt_password" id="txt_password" class="form-control" 
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required 
                   title="Must contain at least one number, one uppercase and lowercase letter, and be at least 8 characters long." />
          </div>

          <div class="form-group">
            <label for="sel_course">Course</label>
            <select name="sel_course" id="sel_course" class="form-control" required>
              <option value="">--Select--</option>
              <?php
              $selqry = "SELECT * FROM tbl_course";
              $result = $con->query($selqry);
              while ($row = $result->fetch_assoc()) {
              ?>
                <option value="<?php echo $row['course_id']; ?>">
                  <?php echo $row['course_name']; ?>
                </option>
              <?php
              }
              ?>
            </select>
          </div>

          <button type="submit" name="button" id="button" class="btn btn-submit mt-3">
            Submit
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('Foot.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
