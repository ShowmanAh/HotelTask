<?php
require "vendor/autoload.php";
use Acme\Controllers\HotelController;
use Acme\Adapter\MysqlAdapter;
use Acme\View\ViewData;
error_reporting(E_ALL);
ini_set('display_errors', '1');

$config = array(
    'localhost',
    'showman',
    'root',
    'task1'
);
$adapter = new MysqlAdapter($config);
$adapter->connect();
$view = new ViewData();
$contr = new HotelController($view);
var_dump($contr->index());

