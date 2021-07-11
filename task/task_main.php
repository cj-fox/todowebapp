<?php
    require_once "../db/data_layer.php";
    function display_table(){
        $result = task_list_view();
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
            echo "<td><a href = '../db/db_complete_task.php?id=" . $row[0] . "'>Mark Complete</a></td>";
            echo "</tr>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tasks</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>Tasks</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="../index.html">Home</a>
                <a href="../authors.html">Authors</a>
                <a href="../report/reports.html">Reports</a>
                <a href="task_main.php" id="current">Tasks</a>
                <a href="../category/category_main.php">Categories</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <h2>Task Table - List View</h2>
        <p style="text-align:center;"><a href = "add_task.php">Add Task</a></p>
        <table>
            <tr>
                <th>Task ID</th>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>Priority Level</th>
                <th>Task Description</th>
                <th>Due Date</th>
                <th>Task Status</th>
                <th>Date Completed</th>
                <th><!-- Mark Complete--></th>
            </tr>
            
            <?php
                display_table();
            ?>
        </table>
    </section>
    <hr>
</body>
</html>