<?php
if(isset($_GET['id'])){
        $categoryid = htmlspecialchars($_GET['id']);
    }
    
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
    <title>Edit Category</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>Edit Category</h1>
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
            <h1>Edit Category</h1>
            <h2>Enter Information That Is To Be Updated</h2>
            <form method="POST" action="../db/db_edit_category.php">
                <ul class="form-item">
                    <li>
                        <label for="txtCategoryID">Category ID:</label>
                        <input type="text" readonly value = "<?php echo $categoryid?>"id="txtCategoryID" name="categoryid" maxlength="255">
                    </li>
                    <li>
                        <label for="txtCategoryName">Category Name</label>
                        <input type="text" id="txtCategoryName" name="categoryname" maxlength="255">
                    </li>
                    <li>
                        <label for="txtParentCategory">Parent Category Name</label>
                        <select name="parentcategory" id="txtParentCateory">
                            <option value='' selected>(none)</option>
                            <?php select_category() ?>
                        </select>
                    </li>
                    <li>
                        <label for="txtCategoryDescription">Task Description</label>
                        <textarea id="txtCategoryDescription" name="categorydescription" maxlength="255" rows="5"
                            cols="50"></textarea>
                    </li>
                    
                    <li>
                        <input type="submit" value="Update">
                        <input type="reset">
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <hr>
</body>
</html>