<?php

include  __DIR__ . '/../functions.php';


$file = __DIR__ . '/../assets/data.csv';

// Export the file
$data = import_csv_to_array($file);

var_dump($data);