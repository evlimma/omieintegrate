<?php

namespace EvLimma\OmieIntegrate;

class Contas extends General
{
    protected $endpoint = 'crm/contas/';
    
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, $totalPages = false): \stdClass|int|string|null
    {
        $post = [
            'call' => 'ListarContas',
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina,
                'apenas_importado_api' => 'N'
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (!empty($render->faultstring)) {
            return $render->faultstring;
        }

        if (empty($render->cadastros)) {
            return null;
        }
        
        return $totalPages ? $render->total_de_paginas : $render;
    }
    
    public function consultar(int $nCodigo = 0): ?\stdClass
    {
        $post = [
            'call' => 'ConsultarConta',
            'param' => [[
                'nCod' => $nCodigo
            ]]
        ];

        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->identificacao)) {
            return null;
        }
        
        return $render;
    }
}
