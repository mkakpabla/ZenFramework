<?php

use Dotenv\Dotenv;

$env = dirname(__DIR__)."/.env";

if(file_exists($env)) {
    // Initialisation du .env
    $dotenv = Dotenv::create(dirname(__DIR__));
    $dotenv->load();
}