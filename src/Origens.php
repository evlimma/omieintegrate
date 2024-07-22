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
     * @return int|null
     */
    public function origensPages(): ?int
    {
        $post = [
            'call' => 'ListarOrigens',
            'param' => [[
                'pagina' => 1,
                'registros_por_pagina' => 500
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->total_de_paginas)) {
            return null;
        }
        
        return $render->total_de_paginas;
    }

    /**
     * 
     * @param int $nRegPorPagina
     * @param int $nPagina
     * @return \stdClass|null
     */
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1): ?\stdClass
    {
								

        $post = [
            'call' => 'ListarOrigens',
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
