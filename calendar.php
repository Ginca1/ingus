<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/calendar.css"></link>
    <title>Document</title>
</head>
<body>

<div class="main2">
    <?php
    include 'header.php';
    ?>

    <div class="calb">
        <?php
        include './api/databaseCalendar.php';

        $id = $_SESSION['id']; // Get the logged-in user's ID

        $sql = "SELECT task_name, description, due_date, task_status FROM tasks WHERE id = $id ORDER BY due_date"; // Filter tasks by user ID
        $result = $conn->query($sql);

        $current_month = null;

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $due_date = new DateTime($row["due_date"]);
                $month = $due_date->format('F Y');

                if ($current_month !== $month) {

                    echo "<div class='calhead'><div class='name'><p class='nametext'>$month</p></div></div>";
                    echo "<div class='taskcat'><div class='cat'>Name</div><div class='cat'>Description</div><div class='cat'>Due Date</div><div class='cat'>Status</div></div>";
                    $current_month = $month;
                }

                echo "<div class='task'>";
                echo "<div class='taskpart'>" . $row["task_name"]. "</div>";
                echo "<div class='taskpart'><p class='description'>" . $row["description"]. "</p></div>";
                echo "<div class='taskpart'>" . $row["due_date"]. "</div>";
                echo "<div class='taskpart'>" . $row["task_status"]. "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='nametext'>You have no tasks yet</div>";
        }
        $conn->close();
        ?>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
