<?php


require_once "db.php";

$conn = new Database();
$conn = $conn->connect();

$user_id = $_SESSION['user']['id'];

$sql = "SELECT * FROM pdf_uploads WHERE user_id='$user_id' ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);

$pdf = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pdf[] = $row;
}