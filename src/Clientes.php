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
    
    public function clientesPages(): ?int
    {
        $post = [
            'call' => 'ListarClientesResumido',
            'param' => [[
                'pagina' => 1,
                'registros_por_pagina' => 500,
                'apenas_importado_api' => 'N'
            ]]
        ];
        
        $render = parent::list($post, $this->endpoint);
        
        if (empty($render->total_de_paginas)) {
            return null;
        }
        
        return $render->total_de_paginas;
    }
    
    public function listar(int $nRegPorPagina = 500, int $nPagina = 1, bool $somenteAtivos = false): ?\stdClass
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
    
	public function listarPages(int $pagActual, int $pagesQtd = 2): ?array
    {
        $result = [];
        for ($i = $pagActual; $i < $pagActual + $pagesQtd; $i++) {
            if (empty($this->listar(nPagina: $i)->clientes_cadastro)) {
                return $result;
            }
            
            $result = array_merge($result, $this->listar(nPagina: $i)->clientes_cadastro);
        }
        
        return $result;
    }
    
    public function listarTotal(): ?\stdClass
    {
        $arrayData = $this->listar();
        
        if (empty($arrayData->clientes_cadastro)) {
            return null;
        }
        
        if ($arrayData->total_de_paginas === 1) {
            return $arrayData->clientes_cadastro;
        }
        
        $result = $arrayData->clientes_cadastro;
        for ($i = 2; $i <= $arrayData->total_de_paginas; $i++) {
            $result = array_merge($result, $this->listar(nPagina: $i)->clientes_cadastro);
        }
        
        return $result;
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
