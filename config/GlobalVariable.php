<?php

if (! defined("URL")) {
    define("URL", "http://localhost:9090");
}

if (! defined("ROOT")) {
    define("ROOT", dirname(__DIR__));
}

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (! defined('PAGES_PATH')) {
    define('PAGES_PATH', ROOT . DS . "theme" . DS . "pages");
}
