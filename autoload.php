<?php



spl_autoload_register(function ($class_name) {

    $root = $_SERVER['DOCUMENT_ROOT'].'/..';


    if (strpos($class_name, '\\') !== false) {
        $class_name_arr = explode('\\', $class_name);
        $class_name = $class_name_arr[count($class_name_arr) - 1];
    }

    if (file_exists( $root.'/app/' . $class_name . '.php')) {
        require_once $root.'/app/' . $class_name . '.php';
    }
    if (file_exists( $root.'/app/lib/' . $class_name . '.php')) {
        require_once $root.'/app/lib/' . $class_name . '.php';
    }
    if (file_exists( $root.'/app/modules/' . $class_name . '.php')) {
        require_once $root.'/app/modules/' . $class_name . '.php';
    }
});