<?php
    require_once "../db/data_layer.php";
    function select_category(){
        $result = get_category_names();
        foreach($result as $option){
            echo '<option value="'.$option[0].'">'.$option[0].'</option>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Task</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>Add Task</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="task_main.php" style="font-weight:bold;">Cancel</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <div class="taskform">
            <h1>Add Task</h1>
            <form method="POST" action="../db/db_add_task.php">
                <ul class="form-item">
                    <li>
                        <label for="txtCategoryName">Category Name</label>
                        <select name="categoryname" id="txtCategoryName">
                            <option value='' selected>(none)</option>
                            <?php select_category() ?>
                        </select>
                    </li>
                    <li>
                        <label for="numPriorityLevel">Priority Level (Descending Priority)</label>
                        <input type="number" value="4" id="numPriorityLevel" name="prioritylevel" min="1" max="4"
                            step="1">
                    </li>
                    <li>
                        <label for="txtTaskDescription">Task Description</label>
                        <textarea required id="txtTaskDescription" name="taskdescription" maxlength="255" rows="5"
                            cols="50"></textarea>
                    </li>
                    <li>
                        <label for="dateDueDate">Due Date</label>
                        <input required type="date" id="dateDueDate" name="duedate">
                    </li>
                    <li>
                        <label for="selectTaskStatus">Task Status</label>
                        <select required id="selectTaskStatus" name="taskstatus">
                            <option selected value="Active">Active</option>
                            <option value="Complete">Complete</option>
                        </select>
                    </li>
                    <li>
                        <input type="submit" value="Add">
                        <input type="reset">
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <hr>
</body>
</html>