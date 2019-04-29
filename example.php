<?php

require(__DIR__."/vendor/autoload.php");
require(__DIR__."/config.php");

$flatFinder = FlatFinder\Client::create($settings["slack"]["webhook_url"], $settings["slack"]);