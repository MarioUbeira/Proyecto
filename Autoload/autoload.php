<?php
spl_autoload_register(function ($class_name) {
    $dirs = array(
        'Config/',
        'Controller/',
        'Models/'
    );
    foreach ($dirs as $dir) {
        $file = $dir . 'class.' . strtolower($class_name) . '.php';
        if (file_exists($file)) {
            require_once($file);
            return;
        }
    }
});