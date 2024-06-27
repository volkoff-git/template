<?php



spl_autoload_register(function ($class_name) {


    if (strpos($class_name, '\\') !== false) {
        $class_name_arr = explode('\\', $class_name);
        $class_name = $class_name_arr[count($class_name_arr) - 1];
    }

    if (file_exists( __DIR__.'/app/' . $class_name . '.php')) {
        require_once __DIR__.'/app/' . $class_name . '.php';
    }
    if (file_exists( __DIR__.'/app/lib/' . $class_name . '.php')) {
        require_once __DIR__.'/app/lib/' . $class_name . '.php';
    }
    if (file_exists( __DIR__.'/app/modules/' . $class_name . '.php')) {
        require_once __DIR__.'/app/modules/' . $class_name . '.php';
    }
});