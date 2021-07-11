<?php
    require_once "data_layer.php";
    $date = htmlspecialchars($_POST['date']);
    
    
    function display_table(){
        $date = htmlspecialchars($_POST['date']);

        $result = task_weekly_report($date);
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td>" . $row[4] . "</td>";
            echo "<td>" . $row[5] . "</td>";
            echo "<td>" . $row[6] . "</td>";
            echo "<td>" . $row[7] . "</td>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Weekly Summary</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>View 3: Weekly Summary</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="../index.html">Home</a>
                <a href="../authors.html">Authors</a>
                <a href="../report/reports.html" id="current">Reports</a>
                <a href="../task/task_main.php">Tasks</a>
                <a href="../category/category_main.php">Categories</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <h2 style="text-align:center;">Tasks Completed Week of <?php echo $date?> to <?php echo date('Y-m-d', strtotime($date. ' + 6 days'))?></h2>
        <p style="text-align:center;"><a href = "../task/add_task.php">Add Task</a></p>
        <table>
            <tr>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 0 days'))?></th>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 1 days'))?></th>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 2 days'))?></th>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 3 days'))?></th>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 4 days'))?></th>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 5 days'))?></th>
                <th><?php echo date('Y-m-d', strtotime($date. ' + 6 days'))?></th>
                <th>Total</th>
            </tr>
            
            <?php
                display_table();
            ?>
        </table>
    </section>
    <hr>
</body>
</html>