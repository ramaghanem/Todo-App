

<?php

session_start();
include "../config.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $title = trim(htmlspecialchars($_POST['title']));
     
    if (empty($title)) {
        $_SESSION['errors'] = ["Task is required ❗"];
    }
    elseif (strlen($title) < 3) {
        $_SESSION['errors'] = "Task must be at least 3 characters ❗";
    

    }
     else {

        $sql = "UPDATE tasks SET title='$title' WHERE id=$id";
        mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn) == 1) {
            $_SESSION['success'] = "Task updated successfully ✏️";
        }
    }

    header("Location: ../index.php");
    exit;
}


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['errors'] = "Task not found ❌";
        header("Location: ../index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card p-4 shadow-sm">
        <h3 class="mb-3 text-center">✏️ Edit Task</h3>

        <form method="POST">

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="mb-3">
                <label class="form-label">Task Title</label>
                <input 
                    type="text" 
                    name="title" 
                    class="form-control" 
                    value="<?php echo $row['title']; ?>" 
                    placeholder="Edit your task..."
                >
            </div>

            <div class="d-flex justify-content-between">
                <a href="../index.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

        </form>
    </div>

</div>

</body>
</html>