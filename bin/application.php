<?php

require __DIR__.'/../vendor/autoload.php';

use Sainsburys\Command\HelloCommand;
use Sainsburys\Command\ScrapeCommand;
use Symfony\Component\Console\Application;

$application = new Application('Sainsburys', '0.1-dev');
$application->add(new HelloCommand());
$application->add(new ScrapeCommand());
$application->run();
