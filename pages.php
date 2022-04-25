<?php

require('../dbh/connection.php')

$page = '';

echo $_POST['function']();

function about(){
    global $connection;
    $page .= '
        <h1>About page</h1>
    ';
}

echo $page;