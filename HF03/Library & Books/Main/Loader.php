<?php

namespace Main;

spl_autoload_register(function ($className) {
    $inputString = $className;
    $parts = explode("\\", $inputString);
    $name = end($parts);

    $file = __DIR__ . "\\" . $name . ".php";
    if (file_exists($file)) {
        include $file;
    } else {
        throw new \Exception("Missing file!");
    }
});