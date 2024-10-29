<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

if (isset($_GET['sid'])) {
    $up=" insert into tbl_coordinator (student_id,event_id) values('".$_GET['sid']."','".$_GET['eid']."')";
    if($con->query($up))
    {
        ?>
        <script>
            alert('Added to Coordinator');
            window.location='AssignedEvent.php';
        </script>
        <?php
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }

        .table-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .student-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-edit {
            background-color: #17a2b8;
            color: white;
        }

        .btn-edit:hover {
            background-color: #138496;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="table-container">
                <h3 class="text-center mb-4">View Students</h3>

                <table class="table table-bordered table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Semester</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Example: Fetching students from the database
                        $i = 0;
                         $selqry = "SELECT * FROM tbl_student s 
                                   INNER JOIN tbl_course c ON s.course_id = c.course_id inner join tbl_semester d on s.semester_id=d.semester_id";
                        $result = $con->query($selqry);
                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['student_contact']; ?></td>
                            <td><?php echo $row['student_email']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['semester_name']; ?></td>
                            <td>
                                <img src="../Assets/Files/Student/<?php echo $row['student_photo']; ?>" 
                                     alt="Student Photo" class="student-photo">
                            </td>
                            <td>
                                
                                <a href="ViewStudents.php?sid=<?php echo $row['student_id']; ?>&eid=<?php echo $_GET['eid']?>" 
                                   class="btn btn-delete btn-sm">Add As Coordinator</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('Foot.php'); ?>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
