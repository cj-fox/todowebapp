<?php
    require_once "data_layer.php";
    
    if($_POST)
    {
        
        if(isset($_POST['categoryname'])) //checks that required fields are filled out
        {
            
                $categoryname = htmlspecialchars($_POST['categoryname']);
                $parentcategory = htmlspecialchars($_POST['parentcategory']);
                $categorydescription = htmlspecialchars($_POST['categorydescription']);
                
               
                //add category function
                add_category($categoryname,$parentcategory,$categorydescription);                
                header("location: ../category/category_main.php");//go back to main task page (default view)
        }
             
    }
    
    ?>