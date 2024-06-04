<?php

const BASE_PATH = __DIR__.'/..';

require BASE_PATH.'/vendor/autoload.php';

require 'migration.php';
if ($argc === 2 && $argv[1] === 'seed') {
    require 'seed.php';
}
