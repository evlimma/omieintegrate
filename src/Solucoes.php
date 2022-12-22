<?php

namespace EvLimma\OmieIntegrate;

class Solucoes extends General
{
    /**
     * 
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }

    /**
     * 
     * @param int $nRegPorPagina
     * @param int $nPagina
     * @param array $arrayFiltros
     * @return \stdClass|null
     */
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, array $arrayFiltros = []): ?\stdClass
    {
        $render = parent::list('ListarSolucoes', $nRegPorPagina, $nPagina, $arrayFiltros, 'crm/solucoes/');
        return $render;
    }
}
