<?php

function getSearchUrl($file)
{
    $dir = dirname($_SERVER['REQUEST_URI']);
    if (strpos($dir, 'admin') !== false)
        return 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['REQUEST_URI'])) . '/' . $file;
    else
        return 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $file;
}

function isLogged()
{
    return isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true;
}