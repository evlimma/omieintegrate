<?php

namespace EvLimma\OmieIntegrate;

class Tipos extends General
{
    protected $endpoint = 'crm/tipos/';
    
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1): ?\stdClass
    {
        $post = [
            'call' => 'ListarTipos',
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
