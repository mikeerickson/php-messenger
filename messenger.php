<?php

require __DIR__.'/vendor/autoload.php';

use Codedungeon\PHPMessenger\Messenger;

$messenger = new Messenger();

$messenger->info("\nPHP Messenger Demo\n");

$messenger->success("Success Message w/ Label\n", "SUCCESS");
$messenger->success("Success Message w/o Label\n");

$messenger->error("Error Message w/ Label\n", "ERROR");
$messenger->error("Error Message w/o Label\n");

$messenger->info("Info Message w/ Label\n", "INFO");
$messenger->info("Info Message w/o Label\n");

$messenger->warning("Warning Message w/ Label\n", "WARNING");
$messenger->warning("Warning Message w/o Label\n");

$messenger->warn("Warn Message w/ Label\n", "WARN");
$messenger->warn("Warn Message w/o Label\n");

$messenger->log("Log Message w/ Label\n", "LOG");
$messenger->log("Log Message w/o Label\n");

$messenger->debug("Debug Message w/ Label\n", "DEBUG");
$messenger->debug("Debug Message w/o Label\n");

$messenger->note("Note Message w/ Label\n", "NOTE");
$messenger->note("Note Message w/o Label\n");

$messenger->notice("Notice Message w/ Label\n", "NOTICE");
$messenger->notice("Notice Message w/o Label\n");

echo "\n";

