<?php

namespace EvLimma\OmieIntegrate;

class Origens extends General
{
    protected $endpoint = 'crm/origens/';
    
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
     * @return \stdClass|null
     */
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1): ?\stdClass
    {
        $call = 'ListarOrigens';

        $post = [
            'call' => $call,
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->cadastros)) {
            return null;
        }
        
        return $render;
    }
}
