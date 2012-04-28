<?php

$notifier = new Sismo\Notifier\DBusNotifier();
$notifierWP = new Sismo\Contrib\WallpaperNotifier();

// add a project with custom settings
$computer = new Sismo\Project('computer');
$computer->setRepository('/home/cordoval/sites-2/computer');
$computer->setBranch('master');

$longCommand = 'composer install; phpunit';

// sets command, slug, commit links and notifier
$computer->setCommand($longCommand);
$computer->setSlug('computer');
$computer->setUrlPattern('http://localhost:8000/?p=.git;a=commitdiff;h=%commit%');
$computer->addNotifier($notifier);
$computer->addNotifier($notifierWP);

return $computer;
