<?php
function connection() {
    $serverName = 'laradock_mysql_1';
    $userName = 'root';
    $password = 'root';
    $database = 'curso-php-mysqli';
    return new mysqli($serverName, $userName, $password, $database);
}