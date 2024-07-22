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
    
    /**
     * 
     * @return int|null
     */
    public function usuariosPages(): ?int
    {
        $post = [
            'call' => 'ListarUsuarios',
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
     * @param int|null $nCodigo
     * @return \stdClass|null
     */
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, ?int $nCodigo = 0): ?\stdClass
    {
        $post = [
            'call' => 'ListarUsuarios',
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
