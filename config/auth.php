<?php
session_start();
require_once "db.php";


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.php");
}


$username = trim($_POST['username']);
$password = trim($_POST['password']);


// Validasi kosong
if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Username dan password tidak boleh kosong!";
    header("Location: ../login.php");
    exit;
}


$conn = new Database();
$conn = $conn->connect();
// Cegah SQL Injection
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Cek user
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../upload.php");
    } else {
        $_SESSION['error'] = "Username atau password tidak valid!";
        header("Location: ../login.php");
    }
} else {
    $_SESSION['error'] = "Username atau password tidak valid!";
    header("Location: ../login.php");
}

