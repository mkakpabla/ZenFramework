<?php

// Fichier de configuration de la ligne de commande pour doctrine

use Doctrine\ORM\Tools\Console\ConsoleRunner;

$entityManager = require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), "src", "bootstrap.php"]);

return ConsoleRunner::createHelperSet($entityManager);

