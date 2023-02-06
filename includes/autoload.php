<?php 
spl_autoload_register('autoload');

function autoload ($class_name) {
    $url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    if (strpos($url, 'includes') !== false) {
        $path = '../Classes/';
        if (strpos($url, 'post') !== false) {
            $path = '../../Classes/';
        }
        if (strpos($url, 'user/auth') !== false) {
            $path = '../../../Classes/';
        }
    }else if (strpos($url, 'admin') !== false) {
        $path = '../Classes/';
        if (strpos($url, 'admin/post') !== false) {
            $path = '../../Classes/';
        }
    }else if (strpos($url, 'category') !== false) {
        $path = '../Classes/';
    }else {
        $path = "Classes/";
    }
    
    $class_name = str_replace("\\","/",$class_name);
    $extension = ".php";

    $full_path = $path . $class_name . $extension;

    if (!file_exists($full_path)) {
        return false;
    }

    include_once $full_path;
}
