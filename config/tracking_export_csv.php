<?php

require_once "get_inquiry.php";

$filename = "export.csv";
$delimiter = ";";

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');

// clean output buffer
ob_end_clean();

$handle = fopen('php://output', 'w');

// use keys as column titles
fputcsv($handle, array_keys($inquiry['result']['0']), $delimiter);

foreach ($inquiry['result'] as $value) {
    foreach ($value['groups'] as $v) {
        fputcsv($handle, $v, $delimiter);
    }
}

fclose($handle);

// flush buffer
ob_flush();

// use exit to get rid of unexpected output afterward
exit();
?>