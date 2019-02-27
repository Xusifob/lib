<?php


/**
 *
 * Exports an associative array into a CSV file using PHP.
 *
 * @see https://stackoverflow.com/questions/21988581/write-utf-8-characters-to-file-with-fputcsv-in-php
 *
 * @param array     $data       The table you want to export in CSV
 * @param string    $delimiter  The CSV delimiter you wish to use. The default ";" is used for a compatibility with microsoft excel
 * @param string    $enclosure  The
 * @param string    $filename
 */
function export_data_to_csv($data,$delimiter = ';',$enclosure = '"',$filename='export')
{
    // Tells to the browser that a file is returned, with its name : $filename.csv
    header("Content-disposition: attachment; filename=$filename.csv");
    // Tells to the browser that the content is a csv file
    header("Content-Type: text/csv");

    // I open PHP memory as a file
    $fp = fopen("php://output", 'w');

    // Insert the UTF-8 BOM in the file
    fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));

    // I add the array keys as CSV headers
    fputcsv($fp,array_keys($data[0]),$delimiter,$enclosure);

    // Add all the data in the file
    foreach ($data as $fields) {
        fputcsv($fp, $fields,$delimiter,$enclosure);
    }

    // Close the file
    fclose($fp);

    // Stop the script
    die();
}