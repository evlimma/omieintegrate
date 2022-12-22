<?php
require __DIR__ . '../../vendor/autoload.php';

$omie = new \EvLimma\OmieIntegrate\Solucoes("1681068318930", "d99121d466fddd58b233df0254d75a8a");

echo $omie->listar();

