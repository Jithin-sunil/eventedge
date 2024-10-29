<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $complaint = $_POST['txt_title'];
    $complaintcontent = $_POST['txt_content'];
    
    $insqry = "INSERT INTO tbl_complaint(complaint_title, complaint_content, complaint_date) VALUES ('$complaint', '$complaintcontent', CURDATE())";
    if ($con->query($insqry)) {
        echo "<script>
                alert('Data Inserted');
                window.location='Complaint.php';
              </script>";
    } else {
        echo "Failed to insert data.";
    }
}

if (isset($_GET['did'])) {
    $delqry = "DELETE FROM tbl_complaint WHERE complaint_id=" . $_GET['did'];
    if ($con->query($delqry)) {
        echo "<script>
                alert('Data Deleted');
                window.location='Complaint.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .complaint-container {
            margin-top: 30px;
            max-width: 600px; /* Reduced maximum width */
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container complaint-container">
        <!-- Complaint Submission Form -->
        <div class="card mb-4">
            <div class="card-header text-center">
                <h4>Submit a Complaint</h4>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="txt_title">Title</label>
                        <input required type="text" name="txt_title" id="txt_title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="txt_content">Content</label>
                        <textarea required name="txt_content" id="txt_content" class="form-control" rows="3"></textarea> <!-- Reduced rows -->
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Complaints Table -->
        <div class="card">
            <div class="card-header text-center">
                <h4>Submitted Complaints</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Action</th>
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
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $row['complaint_title']; ?></td>
                            <td><?php echo $row['complaint_content']; ?></td>
                            <td class="text-center">
                                <a href="Complaint.php?did=<?php echo $row['complaint_id']; ?>" 
                                   class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
include('Foot.php');
?>
