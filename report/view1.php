<?php
    require_once "../db/data_layer.php";
    
    function display_table(){
        $result = task_default_view();
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td>" . $row[4] . "</td>";
            echo "<td>" . $row[5] . "</td>";
            echo "<td>" . $row[6] . "</td>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Default View</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>View 1: Default</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="../index.html">Home</a>
                <a href="../authors.html">Authors</a>
                <a href="reports.html" id="current">Reports</a>
                <a href="../task/task_main.php">Tasks</a>
                <a href="../category/category_main.php">Categories</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <h2 style="text-align:center;">Overdue and Due Today Tasks</h2>
        <h3 style="text-align:center;">Sorted By Priority</h3>
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
            </tr>
            
            <?php
                display_table();
            ?>
        </table>
    </section>
    <hr>
</body>
</html>