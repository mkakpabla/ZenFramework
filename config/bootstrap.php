<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

include 'database.php';

$capsule = new Capsule;

$capsule->addConnection($database[getenv('DB_CONNECTION')]);


// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Set the event dispatcher used by Eloquent models... (optional)
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
