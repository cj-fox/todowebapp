<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Weekly Summary (Date Selection)</title>
    <style type="text/css">
        <?php include "../mainstyle.css" ?>
    </style>
</head>

<body>
    <header>
        <h1>View 3: Weekly Summary - Date Selection</h1>
        <!--Site Navigation-->
        <nav role="navigation">
            <div class="navlist">
                <a href="../index.html">Home</a>
                <a href="../authors.html">Authors</a>
                <a href="reports.html" id="current">Reports</a>
                <a href="../task/task_main.php">Tasks</a>
                <a href="../category/category_main.php">Categories</a>
            </div>
            <hr>
        </nav>
    </header>
    <!-- Application Section Section -->
    <section>
        <div class="taskform">
            <h1>Select a Week</h1>
            <h3>Summary Will Be Shown For the 7 Days Starting With the Selected Date</h3>
            <form method="POST" action="../db/view3_db.php">
                <ul class="form-item">
                    <li>
                        <label for="date">Date:</label>
                        <input required type="date" id="date" name="date">
                    </li>
                    <li>
                        <input type="submit" value="Continue">
                        <input type="reset">
                    </li>
                </ul>
            </form>
        </div>
    </section>
    <hr>
</body>
</html>