<?php
session_start();
require_once "db.php";


if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../upload.php");
}


$id = $_POST['user_id'];
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$handphone = trim($_POST['handphone']);
$telephone = trim($_POST['telephone']);
$address = trim($_POST['address']);
// $pic = $_FILES['pic'];


$conn = new Database();
$conn = $conn->connect();

$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);

$user = $result->fetch_assoc();


$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);
$uploadDir = "../uploads/";

if (!empty($_FILES['pic']['name'])) {

    unlink($uploadDir . $user['pic']);

    $extension = pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION);
    $filename = "PIC" . $user['id'] . date('ymdhis') . "." . $extension;

    $up = $conn->prepare("UPDATE users SET name = ?, email = ?, handphone = ?, telephone = ?, address = ?, pic = ? WHERE id = ?");
    $up->bind_param('ssssssi', $name, $email, $handphone, $telephone, $address, $filename, $id);


    move_uploaded_file($_FILES['pic']['tmp_name'], $uploadDir . $filename);

} else {

    $up = $conn->prepare("UPDATE users SET name = ?, email = ?, handphone = ?, telephone = ?, address = ? WHERE id = ?");
    $up->bind_param('sssssi', $name, $email, $handphone, $telephone, $address, $id);
}


if ($up->execute()) {
    $success = "Profil berhasil diperbarui.";
    $_SESSION['profile_update'] = ['status' => 'success', 'message' => $success];

    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();


    unset($_SESSION['user']);
    $_SESSION['user'] = $user;
} else {
    $error = "Gagal memperbarui profil.";
    $_SESSION['profile_update'] = ['status' => 'error', 'message' => $error];
}

header("Location: ../profile.php");


