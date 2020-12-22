<?php

function run($argv)
{
    $count = 0;
    $content = file_get_contents($argv[2]);
    $content = str_replace($argv[0], $argv[1], $content, $count);
    $content = str_replace(ucfirst($argv[0]), ucfirst($argv[1]), $content, $count);
    $content = str_replace(mb_strtoupper($argv[0]), mb_strtoupper($argv[1]), $content, $count);
    file_put_contents($argv[2], $content);
}
