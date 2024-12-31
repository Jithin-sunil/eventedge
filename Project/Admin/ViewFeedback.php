<?php
include('../Assets/Connection/Connection.php');
include('Head.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .table-container {
            margin: 30px auto;
            max-width: 800px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="container table-container">
    <h2>View Feedback</h2>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                
                <th>Content</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Example PHP logic to fetch feedback data
            $i = 0;
            $feedbackQuery = "SELECT * FROM tbl_feedback";  // Adjust the query to match your DB schema
            $result = $con->query($feedbackQuery);
            while ($row = $result->fetch_assoc()) {
                $i++;
                echo "<tr>
                        <td>$i</td>
                        
                        <td>{$row['feedback_content']}</td>
                      </tr>";
            }
            if ($i == 0) {
                echo "<tr><td colspan='3' class='text-center'>No feedback available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>
<?php
include("Foot.php");
?>
