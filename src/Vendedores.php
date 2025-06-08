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
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, bool $somenteAtivos = false): ?\stdClass
    {
        $post = [
            'call' => 'ListarVendedores',
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina,
                'apenas_importado_api' => 'N'
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->cadastro)) {
            return null;
        }

        if ($somenteAtivos) {
            foreach ($render->cadastro as $key => $value) {
                if ($value->inativo === "S") {
                    unset($render->cadastro[$key]);
                }
            }
        }
        
        return $render;
    }
    
    public function consultar(int $nCodigo = 0, bool $somenteAtivos = true): ?\stdClass
    {
        $post = [
            'call' => 'ConsultarVendedor',
            'param' => [[
                'codigo' => $nCodigo
            ]]
        ];

        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->codigo)) {
            return null;
        }

        if ($somenteAtivos && $render->inativo === "S") {
            return null;
        }
        
        return $render;
    }
}
