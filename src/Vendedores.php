<?php

namespace EvLimma\OmieIntegrate;

class Vendedores extends General
{
    protected $endpoint = 'geral/vendedores/';
    
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
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, int $nCodigo = 0, bool $somenteAtivos = true): ?\stdClass
    {
        $render = parent::list('ListarVendedores', $nRegPorPagina, $nPagina, $nCodigo, $this->endpoint);
        
        if (!$somenteAtivos) {
            return $render;
        }
        
        if (empty($render->cadastro)) {
            return null;
        }

        foreach ($render->cadastro as $key => $value) {
            if ($value->inativo === "S") {
                unset($render->cadastro[$key]);
            }
        }
        
        return $render;
    }
}
