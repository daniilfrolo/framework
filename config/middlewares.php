<?php
/** @var \Framework\Http\Pipeline\Pipeline $pipeline */
$pipeline = $container->get(\Framework\Http\Pipeline\Pipeline::class);

//$pipeline->pipe("Simple");

return $pipeline;