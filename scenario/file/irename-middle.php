<?php

function searchWordInMiddle($argv, &$count) {
    return str_replace ( $argv[0] , $argv[1], $argv[2], $count );
}

function searchWordInMiddleUcase($argv, &$count) {
    return str_replace ( ucfirst($argv[0]) , ucfirst($argv[1]), $argv[2], $count );
}

function run($argv)
{
    $count = 0;
    $result = searchWordInMiddle($argv,$count);

    if ($count > 1) {
        exit;
    }

    if ($count === 1) {
        rename($argv[2], $result);
    }

    $result = searchWordInMiddleUcase($argv,$count);

    if ($count > 1) {
        exit;
    }

    if ($count === 1) {
        rename($argv[2], $result);
    }
}

