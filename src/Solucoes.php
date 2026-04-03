<?php

namespace EvLimma\OmieIntegrate;

class Solucoes extends General
{
    protected $endpoint = 'crm/solucoes/';
    
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }

    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, ?int $nCodigo = 0, bool $somenteAtivos = false): ?\stdClass
    {
        $post = [
            'call' => 'ListarSolucoes',
            'param' => [[
                'pagina' => $nPagina,
                'registros_por_pagina' => $nRegPorPagina
            ]]
        ];

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
