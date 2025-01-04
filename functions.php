<?php

function filter($items, $fn)
{
    $searchedItem = [];
    foreach ($items as $item) {
        if ($fn($item)) {
            $searchedItem[] = $item;
        }
    }
    return $searchedItem;
}

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    die();
    echo "</pre>";
}
function getURI($uri){
    return $_SERVER["REQUEST_URI"] == $uri;
}