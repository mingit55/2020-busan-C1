<?php
session_start();

define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(__DIR__));
define("SRC", ROOT.DS."src");
define("VIEW", SRC.DS."View");
define("PUB", ROOT.DS."public");
define("UPLOAD", PUB.DS."uploads");

require SRC.DS."autoload.php";
require SRC.DS."helper.php";
require SRC.DS."web.php";