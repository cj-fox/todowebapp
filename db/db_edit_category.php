<?php
    require_once "data_layer.php";
    
    if($_POST)
   
    {
     
        $categoryid = htmlspecialchars($_POST['categoryid']);
        $categoryname = htmlspecialchars($_POST['categoryname']);
        $parentcategory = htmlspecialchars($_POST['parentcategory']);
        $categorydescription = htmlspecialchars($_POST['categorydescription']);
        
        //add category function
        edit_category($categoryid, $categoryname,$parentcategory,$categorydescription);                
        header("location: ../category/category_main.php");//go back to main task page (default view)
    }
    
    ?>