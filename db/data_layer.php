<?php
$server   = "localhost";
$userName = "id16545551_dbuser";
$pass     = "0]YzFI?H+CKY<j(>";
$db       = "id16545551_db1";

//function to get the Task table
function task_list_view()
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con, 
    "SELECT 
        task_id,
        (SELECT category_name FROM CATEGORY WHERE TASK.category_id=CATEGORY.category_id) AS category_name, 
        (SELECT parent_category FROM CATEGORY WHERE TASK.category_id=CATEGORY.category_id) AS parent_category,
        priority_level, 
        task_desc, 
        due_date, 
        task_status, 
        complete_date
    FROM TASK
    ORDER BY priority_level DESC;");
    $data   = array();
    
    while ($row = mysqli_fetch_array($result)) {
        $temp = array();
        array_push($temp, $row['task_id']);
        array_push($temp, $row['category_name']);
        array_push($temp, $row['parent_category']);
        array_push($temp, $row['priority_level']);
        array_push($temp, $row['task_desc']);
        array_push($temp, $row['due_date']);
        array_push($temp, $row['task_status']);
        array_push($temp, $row['complete_date']);
        array_push($data, $temp);
        
    }
    
    //close connection
    mysqli_close($con);
    return $data;
}

//function for default view - View 1
function task_default_view()
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con, 
        "SELECT 
            task_id, 
            (SELECT category_name FROM CATEGORY WHERE TASK.category_id=CATEGORY.category_id) AS category_name, 
            (SELECT parent_category FROM CATEGORY WHERE TASK.category_id=CATEGORY.category_id) AS parent_category,
            priority_level, 
            task_desc, 
            due_date, 
            task_status, 
            complete_date 
        FROM TASK
        WHERE due_date<=CURDATE() AND task_status = 'Active' ORDER BY priority_level ASC;");
    $data   = array();
    
    while ($row = mysqli_fetch_array($result)) {
        $temp = array();
        array_push($temp, $row['task_id']);
        array_push($temp, $row['category_name']);
        array_push($temp, $row['parent_category']);
        array_push($temp, $row['priority_level']);
        array_push($temp, $row['task_desc']);
        array_push($temp, $row['due_date']);
        array_push($temp, $row['task_status']);
        array_push($temp, $row['complete_date']);
        array_push($data, $temp);
        
    }
    
    //close connection
    mysqli_close($con);
    return $data;
}

//function to display category table
function get_categories()
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con, "SELECT * FROM CATEGORY ORDER BY category_name ASC;");
    $data   = array();
    
    while ($row = mysqli_fetch_array($result)) {
        $temp = array();
        array_push($temp, $row['category_id']);
        array_push($temp, $row['category_name']);
        array_push($temp, $row['parent_category']);
        array_push($temp, $row['category_desc']);
        array_push($data, $temp);
        
    }
    
    //close connection
    mysqli_close($con);
    return $data;
}

//function to show task completed view - View 2
function task_completed_view($arg_date)
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    
    $stmt = mysqli_prepare($con, 
        "SELECT 
            task_id, 
            (SELECT category_name FROM CATEGORY WHERE TASK.category_id=CATEGORY.category_id) AS category_name, 
            (SELECT parent_category FROM CATEGORY WHERE TASK.category_id=CATEGORY.category_id) AS parent_category,
            priority_level, 
            task_desc, 
            due_date, 
            task_status, 
            complete_date 
        FROM TASK 
        WHERE task_status = 'Complete' AND complete_date= ? ORDER BY due_date DESC;");
    mysqli_stmt_bind_param($stmt, "s", $arg_date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $data = array();
    
    while ($row = mysqli_fetch_array($result)) {
        $temp = array();
        array_push($temp, $row['task_id']);
        array_push($temp, $row['category_name']);
        array_push($temp, $row['parent_category']);
        array_push($temp, $row['priority_level']);
        array_push($temp, $row['task_desc']);
        array_push($temp, $row['due_date']);
        array_push($temp, $row['task_status']);
        array_push($temp, $row['complete_date']);
        array_push($data, $temp);
        
    }
    
    //close connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $data;
}

/////////////////////////////////////////
//function to show weekly report - View 3
/////////////////////////////////////////
function task_weekly_report($arg_date)
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    
    $stmt = mysqli_prepare($con, "SELECT
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date =DATE_ADD(?, INTERVAL 0 DAY)) as 'Day 1',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date=DATE_ADD(?, INTERVAL 1 DAY)) as 'Day 2',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date=DATE_ADD(?, INTERVAL 2 DAY)) as 'Day 3',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date=DATE_ADD(?, INTERVAL 3 DAY)) as 'Day 4',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date =DATE_ADD(?, INTERVAL 4 DAY)) as 'Day 5',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date=DATE_ADD(?, INTERVAL 5 DAY)) as 'Day 6',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date=DATE_ADD(?, INTERVAL 6 DAY)) as 'Day 7',
    (SELECT COUNT(*) FROM TASK
    WHERE complete_date BETWEEN ? and DATE_ADD(?, INTERVAL 6 DAY)) as 'Total';");
    
    mysqli_stmt_bind_param($stmt, "sssssssss", $arg_date, $arg_date, $arg_date, $arg_date, $arg_date, $arg_date, $arg_date, $arg_date, $arg_date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $data = array();
    
    while ($row = mysqli_fetch_array($result)) {
        $temp = array();
        array_push($temp, $row['Day 1']);
        array_push($temp, $row['Day 2']);
        array_push($temp, $row['Day 3']);
        array_push($temp, $row['Day 4']);
        array_push($temp, $row['Day 5']);
        array_push($temp, $row['Day 6']);
        array_push($temp, $row['Day 7']);
        array_push($temp, $row['Total']);
        array_push($data, $temp);
        
    }
    
    //close connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
    return $data;
}

//function to add a task - Functionality - 1
function add_task($arg_category_name, $arg_priority_level, $arg_task_desc, $arg_due_date, $arg_task_status)
{
    
    global $server, $userName, $pass, $db;
    
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    
    if ($arg_category_name == NULL) {
        if ($arg_task_status == 'Active') {
            $stmt = mysqli_prepare($con, "INSERT INTO TASK (priority_level, task_desc, due_date, task_status) VALUES(?,?,?,?);");
            mysqli_stmt_bind_param($stmt, "isss", $arg_priority_level, $arg_task_desc, $arg_due_date, $arg_task_status);
            mysqli_stmt_execute($stmt);
        } else {
            $stmt = mysqli_prepare($con, "INSERT INTO TASK (priority_level, task_desc, due_date, task_status, complete_date) VALUES(?,?,?,?, CURDATE());");
            mysqli_stmt_bind_param($stmt, "isss", $arg_priority_level, $arg_task_desc, $arg_due_date, $arg_task_status);
            mysqli_stmt_execute($stmt);
        }
        
    } else {
        if ($arg_task_status == 'Active') {
            $stmt = mysqli_prepare($con, "INSERT INTO TASK (category_id, priority_level, task_desc, due_date, task_status) VALUES((SELECT category_id FROM CATEGORY WHERE category_name = ?),?,?,?,?);");
            if (!mysqli_stmt_bind_param($stmt, "sisss", $arg_category_name, $arg_priority_level, $arg_task_desc, $arg_due_date, $arg_task_status))
                echo var_dump($stmt);
            mysqli_stmt_execute($stmt);
        } else {
            $stmt = mysqli_prepare($con, "INSERT INTO TASK (category_id, priority_level, task_desc, due_date, task_status, complete_date) VALUES((SELECT category_id FROM CATEGORY WHERE category_name = ?),?,?,?,?, CURDATE());");
            mysqli_stmt_bind_param($stmt, "sisss", $arg_category_name, $arg_priority_level, $arg_task_desc, $arg_due_date, $arg_task_status);
            mysqli_stmt_execute($stmt);
        }
    }
    
    //close connection
    mysqli_close($con);
}

//function to mark task as complete - Functionality 2
function mark_complete($arg_taskid)
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    $stmt = mysqli_prepare($con, "UPDATE TASK SET task_status = 'Complete', complete_date = CURDATE() WHERE task_id=?;");
    mysqli_stmt_bind_param($stmt, "i", $arg_taskid);
    mysqli_stmt_execute($stmt);
    
    //close connection
    mysqli_close($con);
}

//function to add categories - Functionality 3
function add_category($arg_category_name, $arg_parent_category, $arg_category_desc)
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    if($arg_parent_category == '') $arg_parent_category = NULL;
    $stmt = mysqli_prepare($con, "INSERT INTO CATEGORY (category_name, parent_category,category_desc) 
        VALUES(?,?,?);");
    mysqli_stmt_bind_param($stmt, "sss", $arg_category_name, $arg_parent_category, $arg_category_desc);
    mysqli_stmt_execute($stmt);
    
    
    
    //close connection
    mysqli_close($con);
}

//function to edit category - Functionality 3
function edit_category($arg_category_id, $arg_category_name, $arg_parent_category, $arg_category_desc)
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    if ($arg_category_name != NULL) {
        $stmt = mysqli_prepare($con, "UPDATE CATEGORY SET category_name = ? WHERE category_id = ?;");
        mysqli_stmt_bind_param($stmt, "si", $arg_category_name, $arg_category_id);
        mysqli_stmt_execute($stmt);
    }
    if ($arg_parent_category != '' && $arg_parent_category != NULL) {
        $stmt4 = mysqli_prepare($con, "SELECT COUNT(*) FROM CATEGORY WHERE parent_category = (SELECT category_name FROM CATEGORY WHERE category_id = ?);");
        mysqli_stmt_bind_param($stmt4, "s", $arg_category_id);
        mysqli_stmt_execute($stmt4);
        $result = mysqli_stmt_get_result($stmt4);
        $row    = mysqli_fetch_array($result);
        if ($row[0] == 0) {
            $stmt2 = mysqli_prepare($con, "UPDATE CATEGORY SET parent_category = ? WHERE category_id = ?;");
            mysqli_stmt_bind_param($stmt2, "si", $arg_parent_category, $arg_category_id);
            mysqli_stmt_execute($stmt2);
        }
    }
    else {
        $stmt4 = mysqli_prepare($con, "UPDATE CATEGORY SET parent_category = NULL WHERE category_id = ?;");
        mysqli_stmt_bind_param($stmt4, "s", $arg_category_id);
        mysqli_stmt_execute($stmt4);
    }
    if ($arg_category_desc != NULL) {
        $stmt3 = mysqli_prepare($con, "UPDATE CATEGORY SET category_desc = ? WHERE category_id = ?;");
        mysqli_stmt_bind_param($stmt3, "si", $arg_category_desc, $arg_category_id);
        mysqli_stmt_execute($stmt3);
    }
    
    
    
    //close connection
    mysqli_close($con);
}

// function to retrieve category names for adding a task
function get_category_names()
{
    global $server, $userName, $pass, $db;
    
    //create connection
    $con = mysqli_connect($server, $userName, $pass, $db);
    
    //check connection is valid
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL : " . mysqli_connect_error();
    }
    
    $result = mysqli_query($con, "SELECT category_name, parent_category FROM CATEGORY");
    $data   = array();
    
    while($row = mysqli_fetch_array($result)) {
        $temp = array();
        array_push($temp, $row['category_name']);
        array_push($temp, $row['parent_category']);
        array_push($data, $temp);
    }

    //close connection
    mysqli_close($con);
    return $data;
}
?>