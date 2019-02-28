<?php


/**
 *
 * This function allows you to import a CSV file and export it into a PHP array
 *
 * @param string $file      The file you want to import the data from
 * @param string $enclosure The type of enclosure used in the CSV file
 *
 * @return array            The array containing the CSV infos
 */
function import_csv_to_array($file,$enclosure = '"')
{

    // Let's get the content of the file and store it in the string
    $csv_string = file_get_contents($file);

    // Let's detect what is the delimiter of the CSV file
    $delimiter = detect_delimiter($csv_string);

    // Get all the lines of the CSV string
    $lines = explode("\n", $csv_string);

    // The first line of the CSV file is the headers that we will use as the keys
    $head = str_getcsv(array_shift($lines),$delimiter,$enclosure);

    $array = array();

    // For all the lines within the CSV
    foreach ($lines as $line) {

        // Sometimes CSV files have an empty line at the end, we try not to add it in the array
        if(empty($line)) {
            continue;
        }

        // Get the CSV data of the line
        $csv = str_getcsv($line,$delimiter,$enclosure);

        // Combine the header and the lines data
        $array[] = array_combine( $head, $csv );

    }

    // Returning the array
    return $array;
}

/**
 *
 * This function detects the delimiter inside the CSV file.
 *
 * It allows the function to work with different types of delimiters, ";", "," "\t", or "|"
 *
 *
 *
 * @param string $csv_string    The content of the CSV file
 * @return string               The delimiter used in the CSV file
 */
function detect_delimiter($csv_string)
{

    // List of delimiters that we will check for
    $delimiters = array(';' => 0,',' => 0,"\t" => 0,"|" => 0);

    // For every delimiter, we count the number of time it can be found within the csv string
    foreach ($delimiters as $delimiter => &$count) {
        $count = substr_count($csv_string,$delimiter);
    }

    // The delimiter used is probably the one that has the more occurrence in the file
    return array_search(max($delimiters), $delimiters);
}