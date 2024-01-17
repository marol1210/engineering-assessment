<?php

/**
 * get csv data
 * @param String $path_to_csv_file
 * @return Array
 */
function getCsvData($path_to_csv_file): Array{
    $row = 1;
    $header = [];
    $list  = [];
    if (($handle = fopen($path_to_csv_file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if($row++==1){
                $header = $data;
            }else{
                array_push($list,$data);
            }
        }
        fclose($handle);
    }
    return compact('header','list');
}

