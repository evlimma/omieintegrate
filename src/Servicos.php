<?php

namespace EvLimma\OmieIntegrate;

class Servicos extends General
{
    protected $endpoint = 'servicos/servico/';
    protected $call = 'ListarCadastroServico';
    
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
            'call' => $this->call,
            'param' => [[
                'nPagina' => 1,
                'nRegPorPagina' => 500
            ]]
        ];
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->nTotPaginas)) {
            return null;
        }

        return $render->nTotPaginas;
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1): ?\stdClass
    {
        $post = [
            'call' => $this->call,
            'param' => [[
                'nPagina' => $nPagina,
                'nRegPorPagina' => $nRegPorPagina
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
