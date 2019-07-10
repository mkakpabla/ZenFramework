<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


$database  =  require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'config', 'database.php']);


$capsule = new Capsule;

$capsule->addConnection($database['mysql']);


// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Set the event dispatcher used by Eloquent models... (optional)
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

