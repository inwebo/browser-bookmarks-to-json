<?php

include('./vendor/autoload.php');

use Symfony\Component\Console\Application;
use Inwebo\Browser\Model\ExportCommand;

$application = new Application();

$application->add(new ExportCommand());

$application->run();
