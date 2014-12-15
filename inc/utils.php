<?php

function getSearchUrl($tagName)
{
    return 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '/index.php?tag=' . $tagName;
}