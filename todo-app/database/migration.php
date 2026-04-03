<?php

$conn = mysqli_connect("localhost", "root", "");

// إنشاء database
$sql = "CREATE DATABASE IF NOT EXISTS todo_app";
mysqli_query($conn, $sql);

// اختيار الداتابيز
mysqli_select_db($conn, "todo_app");

// إنشاء الجدول
$table = "CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    is_completed TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

mysqli_query($conn, $table);

echo "Database & Table created successfully!";