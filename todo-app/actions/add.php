<?php
session_start();
include "../config.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title'])) {

   
    $title = trim(htmlspecialchars($_POST['title']));

  
   

    if (empty($title)) {
        $_SESSION['errors'] = "Task is required ❗";
    } elseif (strlen($title) < 3) {
        $_SESSION['errors'] = "Task must be at least 3 characters ❗";
    }

  
    if (empty($_SESSION['errors'])) {

        $sql = "INSERT INTO tasks (title) VALUES ('$title')";
        mysqli_query($conn, $sql);

       
        if (mysqli_affected_rows($conn) == 1) {
            $_SESSION['success'] = "Task added successfully ✅";
        }
    }


    header("Location: ../index.php");
    exit;
}
?>