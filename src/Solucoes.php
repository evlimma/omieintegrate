<?php

namespace EvLimma\OmieIntegrate;

class Solucoes extends General
{
    protected $endpoint = 'crm/solucoes/';
    
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
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, ?int $nCodigo = 0, bool $somenteAtivos = true): ?\stdClass
    {
        $call = 'ListarSolucoes';

        $post = [
            'call' => $call,
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina,
                'apenas_importado_api' => 'N'
            ]]
        ];

        // Adiciona o paramentro para filtro o código
        if ($nCodigo) {
            $post['param'][0]['nCodigo'] = $nCodigo;
        }
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->cadastros)) {
            return null;
        }

        if ($somenteAtivos) {
            foreach ($render->cadastros as $key => $value) {
                if ($value->cInativo === "S") {
                    unset($render->cadastros[$key]);
                }
            }
        }
        
        return $render;
    }
}
