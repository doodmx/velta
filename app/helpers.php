<?php


function clean_file_name($name)
{
    $name = str_replace(' ', '-', $name);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $name);
}

function value_instead($array, $key, $valueInstead)
{

    if (is_array($array)) {
        return array_key_exists($key, $array) ? $array[$key] : $valueInstead;

    }

    return property_exists($array, $key) ? $array[$key] : $valueInstead;


}

if (!function_exists('listMonths')) {
    function listMonths()
    {
        return ['01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12'];
    }
}
