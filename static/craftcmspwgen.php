<?php

$pass = isset($argv[1]) ? $argv[1] : false;
$cost = isset($argv[2]) ? $argv[2] : 13;

if (!$pass)
  die('No password sent');

echo password_hash($pass, PASSWORD_DEFAULT, ['cost' => $cost]) . PHP_EOL;
