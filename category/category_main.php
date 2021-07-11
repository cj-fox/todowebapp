<?php
    require_once ("../db/data_layer.php");
    function display_table(){
        $result = get_categories();///////////
        foreach($result as $row){
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
            echo "<td><a href = 'edit_category.php?id=" . $row[0] . "'>Edit Category</a></td>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Categories</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>Categories</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="../index.html">Home</a>
                <a href="../authors.html">Authors</a>
                <a href="../report/reports.html">Reports</a>
                <a href="../task/task_main.php">Tasks</a>
                <a href="category_main.php" id="current">Categories</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <h2>Category Table</h2>
        <p style="text-align:center;"><a href = "add_category.php">Add Category</a></p>
        <table>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Parent Category</th>
                <th>Category Description</th>
                <th><!-- Edit Category--></th>
            </tr>
            
            <?php
                display_table();
            ?>
        </table>
    </section>
    <hr>
</body>
</html>