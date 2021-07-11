<?php
require_once "../db/data_layer.php";
    function select_category(){
        $result = get_category_names();
        // ensure that only a category that isn't a subcategory can be selected
        foreach($result as $option){
            if($option[1] == NULL || $option[1] == '') 
                echo '<option value="'.$option[0].'">'.$option[0].'</option>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Category</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>Add Category</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="category_main.php" style="font-weight:bold;">Cancel</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <div class="taskform">
            <h1>Add Category</h1>
            <form method="POST" action="../db/db_add_category.php">
                <ul class="form-item">
                    <li>
                        <label for="txtCategoryName">Category Name</label>
                        <input type="text" id="txtCategoryName" name="categoryname" maxlength="255">
                    </li>
                    <li>
                        <label for="txtParentCategory">ParentCategory Name</label>
                        <select name="parentcategory" id="txtParentCategory">
                            <option value='' selected>(none)</option>
                            <?php select_category() ?>
                        </select>
                    </li>
                    <li>
                        <label for="txtCategoryDescription">Task Description</label>
                        <textarea required id="txtCategoryDescription" name="categorydescription" maxlength="255" rows="5"
                            cols="50"></textarea>
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