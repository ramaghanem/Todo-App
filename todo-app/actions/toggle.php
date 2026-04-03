<?php
include "../config.php";

$id = $_GET['id'];

$query = "SELECT is_completed FROM tasks WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$newStatus = $row['is_completed'] ? 0 : 1;


$update = "UPDATE tasks SET is_completed = $newStatus WHERE id = $id";
mysqli_query($conn, $update);


header("Location: ../index.php");
exit;
?>