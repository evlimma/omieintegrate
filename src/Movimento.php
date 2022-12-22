<?php

namespace BeeDelivery\Omie;


use BeeDelivery\Omie\Connection;

class Movimento
{

    public $http;

    public function __construct($apiKey = null, $apiSecret = null)
    {
        $this->http = new Connection($apiKey, $apiSecret);
    }

    /**
     * Lista os movimentos financeiros cadastrados.
     *
     * @see https://app.omie.com.br/api/v1/financas/mf/#ListarMovimentos
     * @param Integer $nRegPorPagina Número de registro por página
     * @param Integer $nPagina Número da página
     * @param Array $arrayFiltros Array de filtros
     * @return json
     */
    public function listar($nRegPorPagina = 500, $nPagina = 1, $arrayFiltros = [])
    {
        $requestBody = array_merge([
            'nPagina'        => $nPagina,
            'nRegPorPagina'  => $nRegPorPagina,
        ], $arrayFiltros);

        return $this->http->post(
            '/financas/mf/',
            $requestBody,
            'ListarMovimentos'
        );
    }
}
