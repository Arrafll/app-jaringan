<?php


require_once "db.php";

$conn = new Database();
$conn = $conn->connect();


$sql = "SELECT * FROM pdf_uploads ORDER BY created_at DESC LIMIT 1";
$result = $conn->query($sql);
$pdf = $result->fetch_assoc();
$pdf_id = 1;

if(isset($pdf)) {
    $pdf_id = $pdf['pdf_id'];
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://api.doc-check.web.id/inquiry/' . $pdf_id,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET'
));

$response = curl_exec($curl);
curl_close($curl);
$inquiry = json_decode($response, true);