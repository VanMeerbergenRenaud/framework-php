<?php

const BASE_PATH = __DIR__ . '/..';
require BASE_PATH . '/vendor/autoload.php';

require __DIR__ . '/./migration.php';

if ($argc === 2 && $argv[1] === 'seed') {
    require __DIR__ . '/./seed.php';
}