<?php
session_start();

require_once "db.php";


$pdf = $_FILES['file'];
$tmpFilePath = $pdf['tmp_name'];
$fileName = $pdf['name'];
$size = $pdf['size'];

// Prepare file for CURL (for PHP 5.5+)
$cfile = new CURLFile($tmpFilePath, mime_content_type($tmpFilePath), $fileName);
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://api.doc-check.web.id/analyze',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('file' => $cfile),
));

$response = curl_exec(handle: $curl);
curl_close($curl);
$response = json_decode($response, true);

$conn = new Database();
$conn = $conn->connect();

$pdf_id = $response['pdf_id'];
$user_id = $_SESSION['user']['id'];

$sql = "INSERT INTO pdf_uploads (name, size, pdf_id, user_id) VALUES ('$fileName', '$size', '$pdf_id', '$user_id')";

mysqli_query($conn, $sql);
echo "success";






