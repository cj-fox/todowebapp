<?php
    require_once "data_layer.php";
    
    function display_table(){
        $date = htmlspecialchars($_POST['datecompleted']);

        $result = task_completed_view($date);
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
            echo "</tr>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Completed Tasks View</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>View 2: Completed Tasks</h1>
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
        <h2 style="text-align:center;">Tasks Completed on Chosen Date</h2>
        <h3 style="text-align:center;">Sorted By Due Date</h3>
        <p style="text-align:center;"><a href = "../task/add_task.php">Add Task</a></p>
        <table>
            <tr>
                <th>Task ID</th>
                <th>Category</th>
                <th>Parent Category</th>
                <th>Priority Level</th>
                <th>Task Description</th>
                <th>Due Date</th>
                <th>Task Status</th>
                <th>Date Completed</th>
            </tr>
            
            <?php
                display_table();
            ?>
        </table>
    </section>
    <hr>
</body>
</html>