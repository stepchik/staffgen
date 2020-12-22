<?php

//TODO Class and History
function init()
{

    $commands = [];

    //Parse command
    $basePath = '/Users/stepchik/WebProject/staffgen/scenario/';
    $scenarios = scandir($basePath);
    foreach ($scenarios as $group) {
        if (($group === '.') || ($group === '..')) {
            continue;
        }

        $path = $basePath . $group . DIRECTORY_SEPARATOR;
        $scenarios = scandir($path);
        foreach ($scenarios as $scenario) {
            if (($scenario === '.') || ($scenario === '..')) {
                continue;
            }

            list($command, $extension) = explode('.', $scenario);
            $commands[$command] = [
                'command' => str_replace("\n", '', file_get_contents($path . DIRECTORY_SEPARATOR . $scenario)),
                'extension' => $extension,
                'path' => $path . DIRECTORY_SEPARATOR . $scenario
            ];
        }
    }
    return $commands;
}

$commands = init();

function handle($argv, $commands)
{

    $output = '';
    $firstArg = $argv[1];
    $consoleARGV = array_slice($argv, 2);
    if (isset($firstArg)) {
        if (array_key_exists($firstArg, $commands)) {

            if ($commands[$firstArg]['extension'] === 'sc') {
                $commandBody = $commands[$firstArg]['command'];

                if (!replaceScenarioParamsWithActual($commandBody, $consoleARGV)) {
                    if (count($consoleARGV) > 0) {
                        $commandBody = $commandBody . ' ' . implode(' ', $consoleARGV);
                    }
                }

                exec($commandBody, $output);
            }

            if ($commands[$firstArg]['extension'] === 'php') {
                require_once $commands[$firstArg]['path'];
                run($consoleARGV);
            }
        }
    }
    print_r($output);
}

function replaceScenarioParamsWithActual(&$commandBody, $consoleARGV): bool
{
    $isText = false;
    $i = 0;
    foreach ($consoleARGV as $argument) {
        $i++;
        $count = 0;
        $commandBody = str_replace('<argv' . $i . '>', $argument, $commandBody, $count);
        if ($count > 0) {
            $isText = true;
        }
    }
    return  $isText;
}

handle($argv, $commands);
