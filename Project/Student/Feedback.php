<?php
include('../Assets/Connection/Connection.php');
include('Head.php');

if (isset($_POST['btn_submit'])) {
    $feedback = $_POST['txt_content'];
    $insqry = "INSERT INTO tbl_feedback(feedback_content) VALUES ('$feedback')";

    if ($con->query($insqry)) {
        echo "<script>
                alert('Feedback Submitted');
                window.location='Feedback.php';
              </script>";
    } else {
        echo "Failed to submit feedback.";
    }
}

if (isset($_GET['did'])) {
    $delqry = "DELETE FROM tbl_feedback WHERE feedback_id=" . $_GET['did'];
    if ($con->query($delqry)) {
        echo "<script>
                alert('Feedback Deleted');
                window.location='Feedback.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .feedback-container {
            margin-top: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            padding: 20px;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        textarea {
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container feedback-container">
        <!-- Feedback Form -->
        <div class="card mb-3">
            <div class="card-header text-center">
                <h4>Submit Feedback</h4>
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="txt_content">Feedback</label>
                        <textarea name="txt_content" id="txt_content" class="form-control" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btn_submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Feedback Table -->
        <div class="card">
            <div class="card-header text-center">
                <h4>Submitted Feedbacks</h4>
            </div>
            <div class="card-body p-2">
                <table class="table table-bordered table-hover">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Content</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selqry = "SELECT * FROM tbl_feedback";
                        $result = $con->query($selqry);

                        while ($row = $result->fetch_assoc()) {
                            $i++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td><?php echo $row['feedback_content']; ?></td>
                            <td class="text-center">
                                <a href="Feedback.php?did=<?php echo $row['feedback_id']; ?>" 
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
