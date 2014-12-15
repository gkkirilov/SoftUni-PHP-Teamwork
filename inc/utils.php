<?php

function getSearchUrl($file)
{
    return 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . DIRECTORY_SEPARATOR . $file;
}