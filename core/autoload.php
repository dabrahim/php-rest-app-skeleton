<?php

spl_autoload_register(function ($class) {
    if ( preg_match('/Service$/', $class) ) {
        require("./persistence/service/" . $class . ".class.php");

    } else if ( preg_match('/DAO$/', $class) ) {
        require("./persistence/interface/" . $class . ".class.php");

    } else {
        require ("./persistence/model/".$class.".class.php");
    }
});