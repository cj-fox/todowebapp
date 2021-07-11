<?php
    require_once 'data_layer.php';
    
    if(isset($_GET['id'])){
        $taskid = htmlspecialchars($_GET['id']);
        mark_complete($taskid);
        header("location: ../task/task_main.php");
        
    }
?>