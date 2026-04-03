<?php

namespace EvLimma\OmieIntegrate;

class Servicos extends General
{
    protected $endpoint = 'servicos/servico/';
    protected $call = 'ListarCadastroServico';
    
    public function __construct(string $apiKey, string $apiSecret)
    {
        parent::__construct($apiKey, $apiSecret);
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, $totalPages = false): \stdClass|int|string|null
    {
        $post = [
            'call' => $this->call,
            'param' => [[
                'nPagina' => $nPagina,
                'nRegPorPagina' => $nRegPorPagina
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (!empty($render->faultstring)) {
            return $render->faultstring;
        }

        if (empty($render->cadastros)) {
            return null;
        }
        
        return $totalPages ? $render->nTotPaginas : $render;
    }

    public function consultar(int $nCodigo = 0): ?\stdClass
    {
        $post = [
            'call' => $this->call,
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
