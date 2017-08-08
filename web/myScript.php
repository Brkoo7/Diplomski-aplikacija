<?php

// use Symfony\Component\HttpFoundation\Request;

// /** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
include_once __DIR__.'/../var/bootstrap.php.cache';
Kint::dump($GLOBALS, $_SERVER); // pass any number of parameters
$polje = ["Ivan", "Matej", "fafa"];

foreach ($polje as $p) {
	d($p);
}
