<?php
function classLoader($className){
    $className = stR_replace("/", DS, $className);
    $classPath = SRC.DS.$className.".php";
    if(is_file($classPath)) require $classPath;
}

spl_autoload_register("classLoader");