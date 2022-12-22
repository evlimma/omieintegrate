<?php
require __DIR__ . '../../vendor/autoload.php';

$omie = new \EvLimma\OmieIntegrate\Solucoes("apiKey-xxxxxxxxxxxx", "apiSecret-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx");

var_dump($omie->listar());

