<?php

namespace EvLimma\OmieIntegrate;

class Clientes extends General
{
    protected $endpoint = 'geral/clientes/';
    
    /**
     * 
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, bool $somenteAtivos = true): ?\stdClass
    {
        $post = [
            'call' => 'ListarClientes',
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina,
                'apenas_importado_api' => 'N'
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->clientes_cadastro)) {
            return null;
        }

        if ($somenteAtivos) {
            foreach ($render->clientes_cadastro as $key => $value) {
                if ($value->inativo === "S") {
                    unset($render->clientes_cadastro[$key]);
                }
            }
        }
        
        return $render;
    }
    
    public function consultar(int $nCodigo = 0, bool $somenteAtivos = true): ?\stdClass
    {
        $post = [
            'call' => 'ConsultarCliente',
            'param' => [[
                'codigo_cliente_omie' => $nCodigo
            ]]
        ];

        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->codigo_cliente_omie)) {
            return null;
        }

        if ($somenteAtivos && $render->inativo === "S") {
            return null;
        }
        
        return $render;
    }
}
