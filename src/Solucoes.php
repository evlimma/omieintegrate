<?php

namespace EvLimma\OmieIntegrate;

class Solucoes extends General
{
    protected $endpoint = 'crm/solucoes/';
    
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
     * @param int $nCodigo
     * @return \stdClass|null
     */
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, int $nCodigo = 0): ?\stdClass
    {
        $render = parent::list('ListarSolucoes', $nRegPorPagina, $nPagina, $nCodigo, $this->endpoint);
        return $render;
    }
}
