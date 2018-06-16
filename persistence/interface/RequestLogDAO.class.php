<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/16/2018
 * Time: 2:51 PM
 */

interface RequestLogDAO {
    public static function save(RequestLog $log);
}