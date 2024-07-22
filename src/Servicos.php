<?php

namespace EvLimma\OmieIntegrate;

class Servicos extends General
{
    protected $endpoint = 'crm/servicos/';
    
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
     * @return int|null
     */
    public function servicosPages(): ?int
    {
        $post = [
            'call' => 'ListarServicos',
            'param' => [[
                'pagina' => 1,
                'registros_por_pagina' => 500
            ]]
        ];
        $render = parent::list($post, $this->endpoint);
        

        var_dump($render); exit;


        
        if (empty($render->total_de_paginas)) {
            return null;
        }
        
        return $render->total_de_paginas;
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1): ?\stdClass
    {
        $post = [
            'call' => 'ListarServicos',
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina,
                'apenas_importado_api' => 'N'
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->cadastros)) {
            return null;
        }
        
        return $render;
    }
    
    public function consultar(int $nCodigo = 0): ?\stdClass
    {
        $post = [
            'call' => 'ListarServicos',
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
