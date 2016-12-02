<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$databaseConfig = include(__DIR__."/../config/database.php");

$capsule = new Capsule;

$capsule->addConnection($databaseConfig);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();