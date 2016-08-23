<?php
//simplest autoloader 
spl_autoload_register(function ($class) {
    $s = DIRECTORY_SEPARATOR;
    $class = str_replace("\\", $s, $class);
    $class = preg_replace("#^\\".$s."#",'',$class);
    $currentDir = dirname(__FILE__);
    require_once "{$currentDir}{$s}{$class}.php";
});

// In the following example we have an API which can load different implementations of User interface
// Implementation can be changed by changing the namespace to correct version
ApplicationAPI::changeNamespace("version2");
// class ApplicationAPI doesn't know which class it actually loads
ApplicationAPI::login("Charlize", "Theron");
ApplicationAPI::postMessage("AAAAAAAAA");