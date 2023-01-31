<?php

namespace EvLimma\OmieIntegrate;

class Usuarios extends General
{
    protected $endpoint = 'crm/usuarios/';
    
    /**
     * 
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }

    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, ?int $nCodigo = 0): ?\stdClass
    {
        $call = 'ListarUsuarios';

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

        if ($nCodigo) {
            foreach ($render->cadastros as $key => $value) {
                if ($value->nCodigo !== $nCodigo) {
                    unset($render->cadastros[$key]);
                }
            }
        }
        
        return $render;
    }
}
