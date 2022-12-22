<?php

namespace Evlimma\OmieIntegrate;

class Solucoes
{
    public $apiKey;
    public $apiSecret;

    public function __construct($apiKey = null, $apiSecret = null)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    /**
     * Recupera todos os clientes
     *
     * @see https://app.omie.com.br/api/v1/geral/clientes/#ListarClientes
     * @param Integer $nRegPorPagina Número de registro por página
     * @param Integer $nPagina Número da página
     * @param Array $arrayFiltros Array de filtros
     * @return json
     */
    public function listar($nRegPorPagina = 200, $nPagina = 1, $arrayFiltros = [])
    {
        return $this->apiKey . "-" . $this->apiSecret . "-" . $nRegPorPagina . "-" . $nPagina . "-" . $arrayFiltros;

//        $requestBody = array_merge([
//            'pagina' => $nPagina,
//            'registros_por_pagina' => $nRegPorPagina,
//                ], $arrayFiltros);
//
//        return $this->http->post(
//                        '/geral/clientes/',
//                        $requestBody,
//                        'ListarClientes'
//        );
    }

}
