<?php
$container = new \Framework\Container\Container();

$dependencies = require ROOT.'/../config/containerDependencies.php';

$container->fill($dependencies);


return $container;
