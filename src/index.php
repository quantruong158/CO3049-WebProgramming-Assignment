<?php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

if ($url === '/' || $url === '/home') {
    require_once('controllers/home.php');
} else if ($url === '/login') {
    require_once('controllers/login.php');
} else if ($url === '/register') {
    require_once('controllers/register.php');
} else if ($url === '/schedule') {
    require_once('controllers/schedule.php');
} else if ($url === '/history') {
    require_once('controllers/history.php');
} else if ($url === '/change') {
    require_once('controllers/change.php');
} else {
    http_response_code(404);
    require_once('views/not_found.php');
    die();
}
