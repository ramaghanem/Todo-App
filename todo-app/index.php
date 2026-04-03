 <?php
include "config.php";

$query = "SELECT * FROM tasks ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4 text-center">Todo App</h2>

    <div class="card p-3 mb-4">
        <form action="actions/add.php" method="POST" class="d-flex gap-2">
            <input type="text" name="title" class="form-control" placeholder="Enter task">
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <div class="card p-3">
        <h5>All Tasks</h5>
        <?php
            session_start();

            // success
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                unset($_SESSION['success']);
            }

            // errors
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger">' . $_SESSION['errors'] . '</div>';
                unset($_SESSION['errors']);
            }

        ?>
        <table class="table table-bordered mt-3">
            <th>#</th>
            <th>Task</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>

                   <td>
                    <a href="actions/toggle.php?id=<?php echo $row['id']; ?>" class="btn btn-sm <?php echo $row['is_completed'] ? 'btn-success' : 'btn-secondary'; ?>">
                        <?php echo $row['is_completed'] ? 'Done ✅' : 'Pending ⏳'; ?>
                    </a>
                    </td>

                    <td><?php echo $row['created_at']; ?></td>

                    <td>
                        <a href="actions/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="actions/update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>