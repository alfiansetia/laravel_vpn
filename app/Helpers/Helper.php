<?php

function isAdmin()
{
    if (strtolower(auth()->user()->role) == 'admin') {
        return true;
    } else {
        return false;
    }
}

function formatBytes($size, $decimals = 0)
{
    $unit = array(
        '0' => 'Byte',
        '1' => 'KiB',
        '2' => 'MiB',
        '3' => 'GiB',
        '4' => 'TiB',
        '5' => 'PiB',
        '6' => 'EiB',
        '7' => 'ZiB',
        '8' => 'YiB'
    );

    for ($i = 0; $size >= 1024 && $i <= count($unit); $i++) {
        $size = $size / 1024;
    }

    return round($size, $decimals) . ' ' . $unit[$i];
}

function formatInterval($dtm)
{
    $val_convert = $dtm;
    $new_format = str_replace("s", "", str_replace("m", "m ", str_replace("h", "h ", str_replace("d", "d ", str_replace("w", "w ", $val_convert)))));
    return $new_format;
}

function formatDTM($dtm)
{
    $day = '';
    if (substr($dtm, 1, 1) == "d" || substr($dtm, 2, 1) == "d") {
        $day = explode("d", $dtm)[0] . "d";
        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
        $dtm = explode("d", $dtm)[1];
    } elseif (substr($dtm, 1, 1) == "w" && substr($dtm, 3, 1) == "d" || substr($dtm, 2, 1) == "w" && substr($dtm, 4, 1) == "d") {
        $day = explode("d", $dtm)[0] . "d";
        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
        $dtm = explode("d", $dtm)[1];
    } elseif (substr($dtm, 1, 1) == "w" || substr($dtm, 2, 1) == "w") {
        $day = explode("w", $dtm)[0] . "w";
        $day = str_replace("d", "d ", str_replace("w", "w ", $day));
        $dtm = explode("w", $dtm)[1];
    }

    // secs
    if (strlen($dtm) == "2" && substr($dtm, -1) == "s") {
        $format = $day . " 00:00:0" . substr($dtm, 0, -1);
    } elseif (strlen($dtm) == "3" && substr($dtm, -1) == "s") {
        $format = $day . " 00:00:" . substr($dtm, 0, -1);
        //minutes
    } elseif (strlen($dtm) == "2" && substr($dtm, -1) == "m") {
        $format = $day . " 00:0" . substr($dtm, 0, -1) . ":00";
    } elseif (strlen($dtm) == "3" && substr($dtm, -1) == "m") {
        $format = $day . " 00:" . substr($dtm, 0, -1) . ":00";
        //hours
    } elseif (strlen($dtm) == "2" && substr($dtm, -1) == "h") {
        $format = $day . " 0" . substr($dtm, 0, -1) . ":00:00";
    } elseif (strlen($dtm) == "3" && substr($dtm, -1) == "h") {
        $format = $day . " " . substr($dtm, 0, -1) . ":00:00";

        //minutes -secs
    } elseif (strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm, 1, -2) == "m") {
        $format = $day . " " . "00:0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 1, -3) == "m") {
        $format = $day . " " . "00:0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 2, -2) == "m") {
        $format = $day . " " . "00:" . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -1);
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 2, -3) == "m") {
        $format = $day . " " . "00:" . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -1);

        //hours -secs
    } elseif (strlen($dtm) == "4" && substr($dtm, -1) == "s" && substr($dtm, 1, -2) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":00:0" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 1, -3) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":00:" . substr($dtm, 2, -1);
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "s" && substr($dtm, 2, -2) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":00:0" . substr($dtm, 3, -1);
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 2, -3) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":00:" . substr($dtm, 3, -1);

        //hours -secs
    } elseif (strlen($dtm) == "4" && substr($dtm, -1) == "m" && substr($dtm, 1, -2) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -1) . ":00";
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm, 1, -3) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -1) . ":00";
    } elseif (strlen($dtm) == "5" && substr($dtm, -1) == "m" && substr($dtm, 2, -2) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -1) . ":00";
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "m" && substr($dtm, 2, -3) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -1) . ":00";

        //hours minutes secs
    } elseif (strlen($dtm) == "6" && substr($dtm, -1) == "s" && substr($dtm, 3, -2) == "m" && substr($dtm, 1, -4) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -3) . ":0" . substr($dtm, 4, -1);
    } elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 3, -3) == "m" && substr($dtm, 1, -5) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":0" . substr($dtm, 2, -4) . ":" . substr($dtm, 4, -1);
    } elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 4, -2) == "m" && substr($dtm, 1, -5) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -3) . ":0" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 4, -3) == "m" && substr($dtm, 1, -6) == "h") {
        $format = $day . " 0" . substr($dtm, 0, 1) . ":" . substr($dtm, 2, -4) . ":" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "7" && substr($dtm, -1) == "s" && substr($dtm, 4, -2) == "m" && substr($dtm, 2, -4) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -3) . ":0" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 4, -3) == "m" && substr($dtm, 2, -5) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":0" . substr($dtm, 3, -4) . ":" . substr($dtm, 5, -1);
    } elseif (strlen($dtm) == "8" && substr($dtm, -1) == "s" && substr($dtm, 5, -2) == "m" && substr($dtm, 2, -5) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -3) . ":0" . substr($dtm, 6, -1);
    } elseif (strlen($dtm) == "9" && substr($dtm, -1) == "s" && substr($dtm, 5, -3) == "m" && substr($dtm, 2, -6) == "h") {
        $format = $day . " " . substr($dtm, 0, 2) . ":" . substr($dtm, 3, -4) . ":" . substr($dtm, 6, -1);
    } else {
        $format = $dtm;
    }
    return $format;
}



function randN($length)
{
    $chars = "23456789";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}

function randUC($length)
{
    $chars = "ABCDEFGHJKLMNPRSTUVWXYZ";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}
function randLC($length)
{
    $chars = "abcdefghijkmnprstuvwxyz";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}

function randULC($length)
{
    $chars = "ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnprstuvwxyz";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}

function randNLC($length)
{
    $chars = "23456789abcdefghijkmnprstuvwxyz";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}

function randNUC($length)
{
    $chars = "23456789ABCDEFGHJKLMNPRSTUVWXYZ";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}

function randNULC($length)
{
    $chars = "23456789ABCDEFGHJKLMNPRSTUVWXYZabcdefghijkmnprstuvwxyz";
    $charArray = str_split($chars);
    $charCount = strlen($chars);
    $result = "";
    for ($i = 1; $i <= $length; $i++) {
        $randChar = rand(0, $charCount - 1);
        $result .= $charArray[$randChar];
    }
    return $result;
}

function cek_package($packages, $package)
{
    try {
        $search = array_search($package, array_column($packages, 'name'));
        if ($search == false && $packages[$search]['disabled'] == 'true') {
            return false;
        }
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function handle_no_package($name)
{
    return ['status' => false, 'message' => "No Package! $name found on Router", 'data' => []];
}

function handle_not_found()
{
    return  ['status' => false, 'message' => 'Data Not Found', 'data' => []];
}


function handle_fail_login($api)
{
    if ($api->error_str == "") {
        $api->error_str = "User/Password Wrong!";
    }
    $data = ['status' => false, 'message' => 'Router Not Connect!  ' . $api->error_str, 'data' => []];
    // return ['status' => false, 'message' => 'Router Not Connect!', 'data' => []];
    return $data;
}


function is_error($response)
{
    try {
        if (isset($response['!trap'])) {
            return true;
        }
        return false;
    } catch (Exception $e) {
        return  true;
    }
}

function handle_data($response, $message = '')
{
    try {
        if (isset($response['!trap'])) {
            return  ['status' => false, 'message' => $response['!trap'][0]['message'], 'data' => []];
        }
        return ['status' => true, 'message' => $message, 'data' => $response];
    } catch (Exception $e) {
        return  ['status' => false, 'message' => 'Server Error', 'data' => $response];
    }
}

function handle_data_edit($response)
{
    try {
        if (isset($response['!trap'])) {
            return  ['status' => false, 'message' => $response['!trap'][0]['message'], 'data' => []];
        }
        if (count($response) < 1) {
            return  ['status' => false, 'message' => 'Data Not Found', 'data' => []];
        }
        return ['status' => true, 'message' => '', 'data' => $response[0]];
    } catch (Exception $e) {
        return  ['status' => false, 'message' => 'Server Error', 'data' => $response];
    }
}
