<?php
/**
 * Created by PhpStorm.
 * User: sndsabin
 * Date: 9/26/18
 * Time: 12:54 PM
 */

namespace ObjectsWithCsvBundle\Service;


class CsvParser
{
    public function parseFile($file)
    {

        if (!is_file($file)) {
            return false;
        }

        $csvData = array_map('str_getcsv', file($file));

        $header = [];
        foreach ($csvData[0] as $value) {
            $header[] =  preg_replace('/\s+/', '', $value);
        }


        array_walk($csvData, function (&$row) use ($header) {
           $row = array_combine($header, $row);
        });
        array_shift($csvData);

        return $csvData;
    }
}