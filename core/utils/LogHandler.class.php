<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/15/2018
 * Time: 9:11 PM
 */

class LogHandler {
    private static function toString (array $array) {
        $tmp = array();
        foreach ($array as $key => $value) {
            $tmp[] = $key . "=" . $value;
        }
        $output = "[" . implode(", ", $tmp) . "]";
        return $output;
    }

    public static function logResponse ( $response ) {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $currentDateTime = date("d-m-Y, H\h i\m\\n s\s");
        $data = LogHandler::toString($_REQUEST);
        $log = $method .",". $uri .",". $data .",". $currentDateTime .",". $response;
        $file = fopen(ROOT_DIR . "/core/logs.txt", 'a');
        fwrite($file, $log . PHP_EOL);
    }
}