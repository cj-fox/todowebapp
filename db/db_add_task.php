<?php
    require_once "data_layer.php";
    
    if($_POST){
        
        if(isset($_POST['taskstatus']) && isset($_POST['taskdescription']) && isset($_POST['duedate']) && isset($_POST['prioritylevel'])) //checks that required fields are filled out
        {
            
                $categoryname = htmlspecialchars($_POST['categoryname']);
                if ($categoryname == '') $categoryname = NULL;
                $prioritylevel = htmlspecialchars($_POST['prioritylevel']);
                $taskdescription = htmlspecialchars($_POST['taskdescription']);
                $duedate = htmlspecialchars($_POST['duedate']);
                $taskstatus = htmlspecialchars($_POST['taskstatus']);
               
                //add task function
                add_task($categoryname,$prioritylevel,$taskdescription,$duedate,$taskstatus);
                
                header("Location: ../task/task_main.php");//go back to main task page (default view)
        }
             
    }
    
    ?>