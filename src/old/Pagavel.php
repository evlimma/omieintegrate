<?php

namespace BeeDelivery\Omie;

use BeeDelivery\Omie\Connection;

class Pagavel
{

    public $http;
    protected $pagavel;

    public function __construct($apiKey = null, $apiSecret = null)
    {
        $this->http = new Connection($apiKey, $apiSecret);
    }

    /**
     * Lista as contas a pagar cadastradas.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#ListarContasPagar
     * @param Integer $nRegPorPagina Número de registro por página
     * @param Integer $nPagina Número da página
     * @param Array $arrayFiltros Array de filtros
     * @return json
     */
    public function listar($nRegPorPagina = 200, $nPagina = 1, $arrayFiltros = [])
    {
        $requestBody = array_merge([
            'pagina'                => $nPagina,
            'registros_por_pagina'  => $nRegPorPagina,
        ], $arrayFiltros);

        return $this->http->post(
            '/financas/contapagar/',
            $requestBody,
            'ListarContasPagar'
        );
    }


    /**
     * Consulta uma Conta a Pagar.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#ConsultarContaPagar
     * @param String $idOmie
     * @param String $idInterno
     * @return json
     */
    public function consultar($idOmie = '', $idInterno = '')
    {
        return $this->http->post('/financas/contapagar/', [

            'codigo_lancamento_omie'        => $idOmie,
            'codigo_lancamento_integracao'  => $idInterno,

        ], 'ConsultarContaPagar');
    }



    /**
     * Altera uma conta a pagar.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#AlterarContaPagar
     * @param Array $pagavel
     * @return json
     */
    public function alterar($pagavel)
    {
        return $this->http->post(

            '/financas/contapagar/',
            $pagavel,
            'AlterarContaPagar'

        );
    }

    /**
     * Exclui uma conta a pagar.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#ExcluirContaPagar
     * @param String $idOmie
     * @param String $idInterno
     * @return json
     */
    public function excluir($idOmie = '', $idInterno = '')
    {
        return $this->http->post('/financas/contapagar/', [

            'codigo_lancamento_omie'        => $idOmie,
            'codigo_lancamento_integracao'  => $idInterno,

        ], 'ExcluirContaPagar');
    }

    /**
     * Lança um pagamento.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#LancarPagamento
     * @param Array $pagamento
     * @return json
     */
    public function lancarPagamento($pagamento)
    {
        return $this->http->post(

            '/financas/contapagar/',
            $pagamento,
            'LancarPagamento'
        );
    }

    /**
     * Efetua o cancelamento de um pagamento de Contas a Pagar.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#CancelarPagamento
     * @param String $idOmie
     * @param String $idInterno
     * @return json
     */
    public function cancelarPagamento($idOmie = '', $idInterno = '')
    {
        return $this->http->post('/financas/contapagar/', [

            'codigo_baixa'              => $idOmie,
            'codigo_baixa_integracao'   => $idInterno,

        ], 'CancelarPagamento');
    }

    /**
     * Inclui uma conta a Pagar.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#IncluirContaPagar
     * @param Array $pagavel
     * @return json
     */
    public function incluir($pagavel)
    {
        return $this->http->post(

            '/financas/contapagar/',
            $pagavel,
            'IncluirContaPagar'

        );
    }

    /**
     * Altera se existir ou adiciona uma conta a Pagar.
     *
     * @see https://app.omie.com.br/api/v1/financas/contapagar/#UpsertContaPagar
     * @param Array $pagavel
     * @return json
     */
    public function upsert($pagavel)
    {
        return $this->http->post(

            '/financas/contapagar/',
            $pagavel,
            'UpsertContaPagar'
        );
    }
}
