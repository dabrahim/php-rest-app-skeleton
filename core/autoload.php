<?php
/**
 * Created by PhpStorm.
 * User.class: user
 * Date: 6/15/2018
 * Time: 5:05 PM
 */

spl_autoload_register(function ($class) {
    if ( preg_match('/Service$/', $class) ) {
        require("./persistence/service/" . $class . ".class.php");

    } else if ( preg_match('/DAO$/', $class) ) {
        require("./persistence/interface/" . $class . ".class.php");

    } else {
        require ("./persistence/model/".$class.".class.php");
    }
});